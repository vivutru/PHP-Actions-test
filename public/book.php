<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/../src/helpers.php';
date_default_timezone_set('America/Jamaica');

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
}

$tours        = tours();
$errors       = [];
$confirmation = null;
$earliest     = date('Y-m-d', strtotime('+1 day'));
$old = [
    'name'   => '',
    'email'  => '',
    'tour'   => (string) ($_GET['tour'] ?? ''),
    'date'   => '',
    'guests' => '2',
    'notes'  => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (array_keys($old) as $field) {
        $old[$field] = trim((string) ($_POST[$field] ?? ''));
    }

    if (!hash_equals($_SESSION['csrf'], (string) ($_POST['csrf'] ?? ''))) {
        $errors[] = 'Your session expired. Please submit the form again.';
    }

    $tour = find_tour($old['tour']);
    if ($tour === null) {
        $errors[] = 'Choose a tour.';
    }
    if (mb_strlen($old['name']) < 2 || mb_strlen($old['name']) > 80) {
        $errors[] = 'Enter your name (2 to 80 characters).';
    }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }

    $parsed = DateTimeImmutable::createFromFormat('Y-m-d', $old['date']);
    if (!$parsed || $parsed->format('Y-m-d') !== $old['date'] || $old['date'] < $earliest) {
        $errors[] = 'Choose a date from tomorrow onwards.';
    }
    if (!ctype_digit($old['guests']) || (int) $old['guests'] < 1 || (int) $old['guests'] > 8) {
        $errors[] = 'Guests must be between 1 and 8.';
    }
    if (mb_strlen($old['notes']) > 300) {
        $errors[] = 'Keep notes under 300 characters.';
    }

    if (!$errors && $tour !== null) {
        $guests = (int) $old['guests'];
        $confirmation = [
            'ref'    => 'BP-' . strtoupper(bin2hex(random_bytes(3))),
            'tour'   => $tour['name'],
            'name'   => $old['name'],
            'email'  => $old['email'],
            'date'   => $parsed->format('l, j F Y'),
            'guests' => $guests,
            'total'  => $tour['price'] * $guests,
        ];
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
}

$title  = 'Book a tour | Blue Peak Coffee Tours';
$active = 'book';
require __DIR__ . '/../src/header.php';
?>

<section class="page-head">
  <div class="wrap">
    <h1><?= $confirmation ? 'You are booked.' : 'Book your tour' ?></h1>
    <p><?= $confirmation ? 'Keep your reference code handy.' : 'Tell us who is coming and when. We confirm by email.' ?></p>
  </div>
</section>

<section class="section">
  <div class="wrap form-wrap">

    <?php if ($confirmation): ?>
      <div class="receipt" role="status">
        <p class="receipt__ref"><?= e($confirmation['ref']) ?></p>
        <dl>
          <div><dt>Tour</dt><dd><?= e($confirmation['tour']) ?></dd></div>
          <div><dt>Date</dt><dd><?= e($confirmation['date']) ?></dd></div>
          <div><dt>Guests</dt><dd><?= e((string) $confirmation['guests']) ?></dd></div>
          <div><dt>Booked by</dt><dd><?= e($confirmation['name']) ?></dd></div>
          <div><dt>Email</dt><dd><?= e($confirmation['email']) ?></dd></div>
          <div class="receipt__total"><dt>Total</dt><dd><?= e(jmd($confirmation['total'])) ?></dd></div>
        </dl>
        <p class="receipt__note">This is a demo, so nothing was saved or emailed. PHP validated the form and worked out the total on the server.</p>
        <a class="btn btn--dark" href="/book.php">Make another booking</a>
      </div>

    <?php else: ?>
      <?php if ($errors): ?>
        <div class="alert" role="alert">
          <p>Please fix the following:</p>
          <ul>
            <?php foreach ($errors as $error): ?>
              <li><?= e($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form class="form" method="post" action="/book.php" novalidate>
        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">

        <label>Tour
          <select name="tour" id="tour" required>
            <option value="">Choose a tour</option>
            <?php foreach ($tours as $t): ?>
              <option value="<?= e($t['slug']) ?>" data-price="<?= (int) $t['price'] ?>"<?= $old['tour'] === $t['slug'] ? ' selected' : '' ?>>
                <?= e($t['name']) ?> (<?= e(jmd($t['price'])) ?> per guest)
              </option>
            <?php endforeach; ?>
          </select>
        </label>

        <div class="form__row">
          <label>Date
            <input type="date" name="date" min="<?= e($earliest) ?>" value="<?= e($old['date']) ?>" required>
          </label>
          <label>Guests
            <input type="number" name="guests" id="guests" min="1" max="8" value="<?= e($old['guests']) ?>" required>
          </label>
        </div>

        <label>Full name
          <input type="text" name="name" autocomplete="name" value="<?= e($old['name']) ?>" required>
        </label>

        <label>Email
          <input type="email" name="email" autocomplete="email" value="<?= e($old['email']) ?>" required>
        </label>

        <label>Notes <span class="optional">(optional)</span>
          <textarea name="notes" rows="3" maxlength="300"><?= e($old['notes']) ?></textarea>
        </label>

        <p class="estimate">Estimated total: <strong id="estimate">choose a tour</strong></p>

        <button class="btn btn--sun" type="submit">Confirm booking</button>
      </form>
    <?php endif; ?>

  </div>
</section>

<?php require __DIR__ . '/../src/footer.php'; ?>
