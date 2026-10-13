<?php
declare(strict_types=1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Handle the small form: PHP runs on the server, then sends back plain HTML.
$name = trim((string) ($_POST['name'] ?? ''));

$facts = [
    'PHP version'      => PHP_VERSION,
    'Web server'       => $_SERVER['SERVER_SOFTWARE'] ?? 'unknown',
    'Operating system' => PHP_OS_FAMILY,
    'Container name'   => gethostname() ?: 'unknown',
    'Server time'      => date('Y-m-d H:i:s T'),
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP on Render: deployment test</title>
  <style>
    :root {
      --paper: #f3f5f7;
      --ink: #14202b;
      --muted: #5b6b79;
      --line: #d5dce2;
      --accent: #0f766e;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      padding: 3rem 1.25rem;
      background: var(--paper);
      color: var(--ink);
      font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
      line-height: 1.5;
    }
    main { max-width: 38rem; margin: 0 auto; }
    h1 { font-size: 2.5rem; line-height: 1.1; margin: 0 0 0.5rem; }
    p.lead { color: var(--muted); margin: 0 0 2rem; }
    h2 { font-size: 1.1rem; margin: 2.5rem 0 0.75rem; }
    dl { margin: 0; border-top: 1px solid var(--line); }
    .row {
      display: flex;
      justify-content: space-between;
      gap: 1rem;
      padding: 0.65rem 0;
      border-bottom: 1px solid var(--line);
    }
    dt { color: var(--muted); }
    dd { margin: 0; font-weight: 600; text-align: right; overflow-wrap: anywhere; }
    form { display: flex; gap: 0.5rem; flex-wrap: wrap; }
    input[type="text"] {
      flex: 1 1 12rem;
      padding: 0.6rem 0.75rem;
      border: 1px solid var(--line);
      border-radius: 6px;
      font: inherit;
      background: #fff;
    }
    button {
      padding: 0.6rem 1rem;
      border: 0;
      border-radius: 6px;
      background: var(--accent);
      color: #fff;
      font: inherit;
      font-weight: 600;
      cursor: pointer;
    }
    :focus-visible { outline: 3px solid var(--accent); outline-offset: 2px; }
    .result { margin-top: 1rem; font-weight: 600; color: var(--accent); }
  </style>
</head>
<body>
  <main>
    <h1>This page is running PHP.</h1>
    <p class="lead">If you can read this on a Render URL, your Dockerfile built and the container started.</p>

    <h2>What the server reports</h2>
    <dl>
      <?php foreach ($facts as $label => $value): ?>
        <div class="row">
          <dt><?= e($label) ?></dt>
          <dd><?= e((string) $value) ?></dd>
        </div>
      <?php endforeach; ?>
    </dl>

    <h2>Try a form</h2>
    <form method="post">
      <input type="text" name="name" placeholder="Your name" aria-label="Your name" value="<?= e($name) ?>">
      <button type="submit">Say hello</button>
    </form>
    <?php if ($name !== ''): ?>
      <p class="result">Hello, <?= e($name) ?>. PHP processed this on the server.</p>
    <?php endif; ?>
  </main>
</body>
</html>
