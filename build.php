<?php
/**
 * Static build script — renders the PHP templates to plain HTML for Netlify.
 *
 *   php build.php
 *
 * Every .php file in the project root (except this one) is rendered in its own
 * PHP subprocess and written to dist/<name>.html, then assets/ is copied across.
 * Netlify serves dist/ as a static site; no PHP runs at request time.
 */

$ROOT = __DIR__;
$DIST = $ROOT . '/dist';

/* The canonical URL the built pages should refer to. Netlify exposes URL and
   DEPLOY_PRIME_URL during a build; SITE_URL overrides both if you set it. */
$SITE_URL = rtrim(
    getenv('SITE_URL') ?: getenv('URL') ?: getenv('DEPLOY_PRIME_URL') ?: 'https://interpsychaz.com',
    '/'
);
$SITE_HOST   = parse_url($SITE_URL, PHP_URL_HOST) ?: 'interpsychaz.com';
$SITE_SECURE = str_starts_with($SITE_URL, 'https://');

/* Extra root-level files to ship if they exist (Netlify config, SEO, etc). */
$EXTRA_FILES = ['_redirects', '_headers', 'robots.txt', 'sitemap.xml', 'favicon.ico'];

/* ── helpers ─────────────────────────────────────────────────────────────── */

/** Recursively delete a directory. Refuses to touch anything outside the project. */
function wipe(string $path, string $root): void {
    $real = realpath($path);
    if ($real === false) return;
    if (!str_starts_with($real, realpath($root)) || $real === realpath($root)) {
        fwrite(STDERR, "Refusing to delete outside the project: $path\n");
        exit(1);
    }
    foreach (scandir($real) as $entry) {
        if ($entry === '.' || $entry === '..') continue;
        $child = $real . '/' . $entry;
        is_dir($child) && !is_link($child) ? wipe($child, $root) : unlink($child);
    }
    rmdir($real);
}

function copyDir(string $src, string $dst): int {
    if (!is_dir($src)) return 0;
    if (!is_dir($dst)) mkdir($dst, 0755, true);
    $count = 0;
    foreach (scandir($src) as $entry) {
        if ($entry === '.' || $entry === '..') continue;
        $from = "$src/$entry";
        $to   = "$dst/$entry";
        $count += is_dir($from) ? copyDir($from, $to) : (int) copy($from, $to);
    }
    return $count;
}

/** Run a PHP script in its own process, returning [stdout, stderr, exitCode]. */
function runPhp(string $script, string $cwd): array {
    $spec = [1 => ['pipe', 'w'], 2 => ['pipe', 'w']];
    $proc = proc_open([PHP_BINARY, $script], $spec, $pipes, $cwd);
    if (!is_resource($proc)) return ['', 'Could not start ' . PHP_BINARY, 1];
    $out = stream_get_contents($pipes[1]);
    $err = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    return [$out, $err, proc_close($proc)];
}

/** Rewrite .php links to .html, but only inside href/src/action attributes. */
function rewriteLinks(string $html): string {
    return preg_replace(
        '/\b(href|src|action)=(["\'])(?!https?:|\/\/)([^"\']*?)\.php((?:[?#][^"\']*)?)\2/i',
        '$1=$2$3.html$4$2',
        $html
    );
}

function humanSize(int $bytes): string {
    return $bytes >= 1048576
        ? round($bytes / 1048576, 2) . ' MB'
        : round($bytes / 1024) . ' KB';
}

/* ── discover pages ──────────────────────────────────────────────────────── */

chdir($ROOT);
$pages = array_values(array_filter(glob('*.php'), fn($f) => $f !== basename(__FILE__)));

if (!$pages) {
    fwrite(STDERR, "No PHP pages found to build.\n");
    exit(1);
}

echo "Building " . count($pages) . " page(s) for $SITE_URL\n\n";

/* ── clean output ────────────────────────────────────────────────────────── */

if (is_dir($DIST)) wipe($DIST, $ROOT);
mkdir($DIST, 0755, true);

/* ── render each page ────────────────────────────────────────────────────── */

$failed = [];

foreach ($pages as $src) {
    $out = preg_replace('/\.php$/', '.html', $src);

    /* A tiny bootstrap gives the page the request context it would have had on a
       web server — without it, absolute URLs in meta tags fall back to guesses. */
    $bootstrap = tempnam(sys_get_temp_dir(), 'build_') . '.php';
    file_put_contents($bootstrap, sprintf(
        "<?php\n"
        . "\$_SERVER['HTTP_HOST']   = %s;\n"
        . "\$_SERVER['SERVER_NAME'] = %s;\n"
        . "\$_SERVER['HTTPS']       = %s;\n"
        . "\$_SERVER['REQUEST_URI'] = %s;\n"
        . "\$_SERVER['PHP_SELF']    = %s;\n"
        . "\$_SERVER['SCRIPT_NAME'] = %s;\n"
        . "\$_SERVER['REQUEST_METHOD'] = 'GET';\n"
        . "require %s;\n",
        var_export($GLOBALS['SITE_HOST'], true),
        var_export($GLOBALS['SITE_HOST'], true),
        var_export($GLOBALS['SITE_SECURE'] ? 'on' : 'off', true),
        var_export('/' . $out, true),
        var_export('/' . $out, true),
        var_export('/' . $out, true),
        var_export($ROOT . '/' . $src, true)
    ));

    [$html, $stderr, $code] = runPhp($bootstrap, $ROOT);
    @unlink($bootstrap);

    if ($code !== 0 || trim($html) === '') {
        $failed[] = $src;
        echo "  [FAILED]   $src\n";
        if (trim($stderr) !== '') echo '             ' . trim($stderr) . "\n";
        continue;
    }
    if (trim($stderr) !== '') {
        echo "  [warning]  $src — " . trim(strtok($stderr, "\n")) . "\n";
    }

    $html = rewriteLinks($html);
    file_put_contents("$DIST/$out", $html);
    echo "  [compiled] $src → $out (" . humanSize(strlen($html)) . ")\n";
}

/* ── copy static files ───────────────────────────────────────────────────── */

echo "\n";
if (is_dir($ROOT . '/assets')) {
    $n = copyDir($ROOT . '/assets', "$DIST/assets");
    echo "  [copied]   assets/ → dist/assets/ ($n files)\n";
} else {
    echo "  [warning]  assets/ not found — the page will render without images.\n";
}

foreach ($EXTRA_FILES as $file) {
    if (is_file($ROOT . '/' . $file)) {
        copy($ROOT . '/' . $file, "$DIST/$file");
        echo "  [copied]   $file\n";
    }
}

/* ── report ──────────────────────────────────────────────────────────────── */

if ($failed) {
    fwrite(STDERR, "\nBuild FAILED — " . count($failed) . " page(s) did not render: "
        . implode(', ', $failed) . "\n");
    exit(1);
}

echo "\nBuild complete — dist/ is ready to deploy.\n";
