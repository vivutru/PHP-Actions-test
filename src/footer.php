<?php
declare(strict_types=1);
?>
</main>
<footer class="footer">
  <div class="wrap footer__grid">
    <div>
      <p class="footer__brand">Blue Peak Coffee Tours</p>
      <p>Small-group tours from Kingston to the Blue Mountains.<br>Pickup from New Kingston, 8 guests at most.</p>
    </div>
    <div>
      <p class="footer__head">Explore</p>
      <ul>
        <li><a href="/#tours">Tours</a></li>
        <li><a href="/#how">How it works</a></li>
        <li><a href="/#faq">Questions</a></li>
        <li><a href="/book.php">Book a tour</a></li>
      </ul>
    </div>
    <div>
      <p class="footer__head">Live from the server</p>
      <ul class="status">
        <li>PHP <?= e(PHP_VERSION) ?></li>
        <li><?= e($_SERVER['SERVER_SOFTWARE'] ?? 'Web server') ?></li>
        <li>Container <?= e(gethostname() ?: 'unknown') ?></li>
        <li><a href="/status.php">View status JSON</a></li>
      </ul>
    </div>
  </div>
  <div class="wrap footer__legal">
    <p>Demo site built to test PHP deployment with Docker and Render. The business, prices and reviews are fictional, and bookings are not stored.</p>
  </div>
</footer>
<script src="/assets/app.js" defer></script>
</body>
</html>
