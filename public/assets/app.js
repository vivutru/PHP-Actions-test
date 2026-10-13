// Mobile menu
const toggle = document.querySelector('.nav__toggle');
const menu = document.getElementById('menu');
if (toggle && menu) {
  toggle.addEventListener('click', () => {
    const open = menu.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', String(open));
  });
}

// Live price estimate on the booking form (the server recalculates the real total)
const tour = document.getElementById('tour');
const guests = document.getElementById('guests');
const estimate = document.getElementById('estimate');
function updateEstimate() {
  if (!tour || !guests || !estimate) return;
  const option = tour.options[tour.selectedIndex];
  const price = Number(option && option.dataset.price);
  const count = Number(guests.value);
  if (!price || !count) {
    estimate.textContent = 'choose a tour';
    return;
  }
  estimate.textContent = 'J$' + (price * count).toLocaleString('en-JM');
}
if (tour && guests) {
  tour.addEventListener('change', updateEstimate);
  guests.addEventListener('input', updateEstimate);
  updateEstimate();
}
