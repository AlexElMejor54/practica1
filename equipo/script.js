// Animación de entrada para las secciones
function revealSections() {
  const sections = document.querySelectorAll('.section');
  const trigger = window.innerHeight * 0.85;
  sections.forEach(section => {
    const top = section.getBoundingClientRect().top;
    if (top < trigger) {
      section.classList.add('visible');
    }
  });
}
window.addEventListener('scroll', revealSections);
window.addEventListener('DOMContentLoaded', revealSections);

// Menú hamburguesa responsive
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');
if (hamburger && navLinks) {
  hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('open');
  });
  // Cerrar menú al hacer click en un enlace
  navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      navLinks.classList.remove('open');
    });
  });
}

// Carrusel de noticia principal
const slides = document.querySelectorAll('.carousel-slide');
const dots = document.querySelectorAll('.carousel-dot');
let currentSlide = 0;
let carouselInterval;

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.toggle('active', i === index);
    dots[i].classList.toggle('active', i === index);
  });
  currentSlide = index;
}
function nextSlide() {
  let next = (currentSlide + 1) % slides.length;
  showSlide(next);
}
function startCarousel() {
  carouselInterval = setInterval(nextSlide, 4000);
}
function stopCarousel() {
  clearInterval(carouselInterval);
}
dots.forEach((dot, i) => {
  dot.addEventListener('click', () => {
    showSlide(i);
    stopCarousel();
    startCarousel();
  });
});
window.addEventListener('DOMContentLoaded', () => {
  showSlide(0);
  startCarousel();
});

// Animar aparición de mini noticias al hacer scroll
function revealMiniNews() {
  const cards = document.querySelectorAll('.mini-news-card');
  const trigger = window.innerHeight * 0.88;
  cards.forEach((card, i) => {
    const top = card.getBoundingClientRect().top;
    if (top < trigger) {
      card.style.animationDelay = (i * 0.15) + 's';
      card.classList.add('animated');
    }
  });
}
window.addEventListener('scroll', revealMiniNews);
window.addEventListener('DOMContentLoaded', revealMiniNews);

// Sponsors efecto flotante al hacer hover
const sponsorImgs = document.querySelectorAll('.sponsor-logos img');
sponsorImgs.forEach(img => {
  img.addEventListener('mouseover',()=>{
    img.style.transform = 'scale(1.14) rotate(-5deg)';
    img.style.boxShadow = '0 9px 30px #bed6f3bb';
  });
  img.addEventListener('mouseout',()=>{
    img.style.transform = '';
    img.style.boxShadow = '';
  });
});

// Elimina cualquier active anterior y marca solo el clickado en el submenu
const submenuItems = document.querySelectorAll('.submenu-item');
submenuItems.forEach(item => {
  item.addEventListener('click', function(e) {
    submenuItems.forEach(it => it.classList.remove('active'));
    item.classList.add('active');
  });
});

// Contador próximo partido
(function initCountdown(){
  const targetDate = new Date('2025-11-01T18:30:00'); // ajusta a tu primer partido
  const elD = document.getElementById('cd-days');
  const elH = document.getElementById('cd-hours');
  const elM = document.getElementById('cd-mins');
  const elS = document.getElementById('cd-secs');
  if(!elD || !elH || !elM || !elS) return;
  function pad(n){ return String(n).padStart(2,'0'); }
  function tick(){
    const now = new Date();
    let diff = Math.max(0, Math.floor((targetDate - now) / 1000));
    const days = Math.floor(diff / 86400); diff -= days*86400;
    const hours = Math.floor(diff / 3600); diff -= hours*3600;
    const mins = Math.floor(diff / 60); diff -= mins*60;
    const secs = diff;
    elD.textContent = pad(days);
    elH.textContent = pad(hours);
    elM.textContent = pad(mins);
    elS.textContent = pad(secs);
  }
  tick();
  setInterval(tick, 1000);
})();

// Si quieres añadir menú responsive o despliegue después, aquí puedes poner el js
