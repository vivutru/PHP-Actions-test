<?php
declare(strict_types=1);
$title  = 'Blue Peak Coffee Tours | Blue Mountain tours from Kingston';
$active = '';
require __DIR__ . '/../src/header.php';
$tours = tours();
?>

<section class="hero">
  <div class="wrap hero__content">
    <p class="hero__kicker">Coffee and hiking tours from Kingston</p>
    <h1>Sunrise at 7,000 feet, coffee in hand.</h1>
    <p class="hero__lead">Climb above the clouds, meet the farmers behind the world-famous beans, and be back in Kingston by evening.</p>
    <div class="hero__actions">
      <a class="btn btn--sun" href="/book.php">Book a tour</a>
      <a class="btn btn--ghost" href="#tours">See the tours</a>
    </div>
    <ul class="facts">
      <li>Pickup in New Kingston</li>
      <li>Eight guests, no more</li>
      <li>Lunch and tastings included</li>
    </ul>
  </div>

  <svg class="hero__art" viewBox="0 250 1440 350" preserveAspectRatio="xMidYMax slice" aria-hidden="true">
    <defs>
      <radialGradient id="glow" cx="50%" cy="50%" r="50%">
        <stop offset="0" stop-color="#FFE27A" stop-opacity=".95"/>
        <stop offset="1" stop-color="#FFE27A" stop-opacity="0"/>
      </radialGradient>
    </defs>
    <g class="sun">
      <circle cx="900" cy="340" r="200" fill="url(#glow)"/>
      <circle cx="900" cy="340" r="72" fill="#FFD24A"/>
    </g>
    <g class="ridge r1"><path d="M0 420 L180 330 L320 400 L520 290 L700 410 L900 320 L1100 420 L1300 340 L1440 400 L1440 600 L0 600Z" fill="#1F7457"/></g>
    <g class="ridge r1"><ellipse cx="420" cy="430" rx="360" ry="22" fill="#fff" opacity=".28"/><ellipse cx="1100" cy="448" rx="300" ry="18" fill="#fff" opacity=".22"/></g>
    <g class="ridge r2"><path d="M0 485 L200 405 L380 475 L600 375 L820 485 L1040 405 L1240 495 L1440 430 L1440 600 L0 600Z" fill="#0B4F3A"/></g>
    <g class="ridge r3"><path d="M0 545 L240 495 L460 545 L700 485 L960 555 L1200 505 L1440 550 L1440 600 L0 600Z" fill="#072B25"/></g>
  </svg>
</section>

<section class="section" id="tours">
  <div class="wrap">
    <div class="section__head">
      <h2>Pick your mountain morning</h2>
      <p>Three ways up. Each one ends with a proper cup of coffee.</p>
    </div>
    <div class="tours">
      <?php foreach ($tours as $i => $tour): ?>
        <article class="tour<?= $i === 0 ? ' tour--featured' : '' ?>">
          <p class="tour__tag"><?= e($tour['tag']) ?></p>
          <h3><?= e($tour['name']) ?></h3>
          <p class="tour__blurb"><?= e($tour['blurb']) ?></p>
          <dl class="tour__meta">
            <div><dt>Length</dt><dd><?= e($tour['duration']) ?></dd></div>
            <div><dt>Group</dt><dd><?= e($tour['group']) ?></dd></div>
          </dl>
          <div class="tour__foot">
            <p class="tour__price"><?= e(jmd($tour['price'])) ?> <span>per guest</span></p>
            <a class="btn <?= $i === 0 ? 'btn--sun' : 'btn--dark' ?>" href="/book.php?tour=<?= e($tour['slug']) ?>">Book this tour</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section--tint" id="how">
  <div class="wrap">
    <div class="section__head">
      <h2>From booking to first sip</h2>
      <p>Three steps, and we handle the driving.</p>
    </div>
    <ol class="steps">
      <li>
        <span class="steps__n">1</span>
        <h3>Choose a tour</h3>
        <p>Pick the hike, the tasting, or the full day. Prices are per guest in Jamaican dollars.</p>
      </li>
      <li>
        <span class="steps__n">2</span>
        <h3>Pick a date</h3>
        <p>Send your details through the booking form. You get a reference code straight away.</p>
      </li>
      <li>
        <span class="steps__n">3</span>
        <h3>Be in New Kingston</h3>
        <p>Your guide collects you at the agreed time. Bring a light jacket, because it is cold up there.</p>
      </li>
    </ol>
  </div>
</section>

<section class="section">
  <div class="wrap quote">
    <blockquote>
      <p>I've lived in Kingston all my life and never tasted coffee like that at the source. We were back home before dark.</p>
      <footer>Shanice R., Half Way Tree</footer>
    </blockquote>
    <div class="quote__side">
      <p class="quote__big">8</p>
      <p>guests per tour at most, so you always get time with the farmer and the guide.</p>
    </div>
  </div>
</section>

<section class="section section--tint" id="faq">
  <div class="wrap faq">
    <div class="section__head">
      <h2>Good to know</h2>
    </div>
    <div class="faq__list">
      <details>
        <summary>What should I bring?</summary>
        <p>Closed shoes, a light jacket, water and sun protection. Mornings in the hills are cool, even in summer.</p>
      </details>
      <details>
        <summary>Can I change my date?</summary>
        <p>Yes. Contact us at least 48 hours before the tour and we will move you to another day at no cost.</p>
      </details>
      <details>
        <summary>Is it suitable for children?</summary>
        <p>The Farm to Cup Tasting suits all ages. The Sunrise Summit Hike is best for teenagers and adults who are comfortable walking uphill.</p>
      </details>
      <details>
        <summary>What happens if it rains?</summary>
        <p>We run in light rain. If conditions are unsafe, we move your tour to another date or refund you in full.</p>
      </details>
    </div>
  </div>
</section>

<section class="cta">
  <div class="wrap cta__inner">
    <h2>Your next sunrise is waiting.</h2>
    <a class="btn btn--dark" href="/book.php">Book a tour</a>
  </div>
</section>

<?php require __DIR__ . '/../src/footer.php'; ?>
