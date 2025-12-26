const hamburger = document.getElementById("hamburger");
const navbarMenu = document.getElementById("navbarMenu");

if (hamburger && navbarMenu) {
  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navbarMenu.classList.toggle("open");
  });
}
// JOIN POPUP
const joinPopup = document.getElementById("joinPopup");
const openJoin = document.getElementById("openJoin");
const closeJoin = document.getElementById("closeJoin");

if (openJoin && joinPopup) {
  openJoin.onclick = () => (joinPopup.style.display = "flex");
}

if (closeJoin && joinPopup) {
  closeJoin.onclick = () => (joinPopup.style.display = "none");
}

// LOGIN POPUP
const loginModal = document.getElementById("loginModal");
const openLogin = document.getElementById("openLogin");
const mobileOpenLogin = document.getElementById("mobileLoginBtn");
const closeLogin = document.getElementById("closeLogin");
if (openLogin && loginModal) {
  openLogin.onclick = () => (loginModal.style.display = "flex");
}
if (closeLogin && loginModal) {
  closeLogin.onclick = () => (loginModal.style.display = "none");
}
if (mobileOpenLogin && loginModal) {
  mobileOpenLogin.onclick = () => (loginModal.style.display = "flex");
}

//Click outside to close
window.onclick = (e) => {
  if (joinPopup && e.target === joinPopup) joinPopup.style.display = "none";

  if (loginModal && e.target === loginModal) loginModal.style.display = "none";
};

// CAROUSEL AUTO SLIDE
let index = 0;
const slides = document.querySelectorAll(".slide");
const dotsContainer = document.getElementById("carouselDots");

// CREATE DOTS
slides.forEach((_, i) => {
  const dot = document.createElement("span");
  dot.dataset.index = i;
  dot.addEventListener("click", () => {
    index = i;
    rotate();
  });
  dotsContainer.appendChild(dot);
});

const dots = document.querySelectorAll("#carouselDots span");

function rotate() {
  slides.forEach((s, i) => {
    s.style.display = i === index ? "block" : "none";
  });
  dots.forEach((d, i) => {
    d.classList.toggle("active", i === index);
  });
  index = (index + 1) % slides.length;
}
setInterval(rotate, 3000);
rotate();

// COOKIE CONSENT
const cookieBar = document.getElementById("cookieConsent");
const acceptBtn = document.getElementById("acceptCookieBtn");
function hasAcceptedCookies() {
  return sessionStorage.getItem("cookiesAccepted") === "true";
}

document.addEventListener("DOMContentLoaded", function () {
  if (hasAcceptedCookies()) {
    cookieBar.style.display = "none";
  } else {
    cookieBar.style.display = "block";
  }
});

acceptBtn.addEventListener("click", function () {
  sessionStorage.setItem("cookiesAccepted", "true");
  cookieBar.style.opacity = "1";
  const fadeOut = () => {
    cookieBar.style.opacity = String(parseFloat(cookieBar.style.opacity) - 0.1);
    if (parseFloat(cookieBar.style.opacity) > 0) {
      requestAnimationFrame(fadeOut);
    } else {
      cookieBar.style.display = "none";
      cookieBar.style.opacity = "1";
    }
  };
  fadeOut();
});

function resetCookieConsent() {
  sessionStorage.removeItem("cookiesAccepted");
  cookieBar.style.display = "block";
  cookieBar.style.opacity = "1";
}

function showCookieBanner() {
  sessionStorage.removeItem("cookiesAccepted");
  cookieBar.style.display = "block";
}
