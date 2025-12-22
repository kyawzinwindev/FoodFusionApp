document.addEventListener("DOMContentLoaded", () => {

  // NAVBAR
  const hamburger = document.getElementById("hamburger");
  const navbarMenu = document.getElementById("navbarMenu");

  if (hamburger && navbarMenu) {
    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("active");
      navbarMenu.classList.toggle("open");
    });
  }

  // LOGIN MODAL
  const loginModal = document.getElementById("loginModal");
  const openLogin = document.getElementById("openLogin");
  const mobileOpenLogin = document.getElementById("mobileLoginBtn");

  if (openLogin && loginModal) {
    openLogin.addEventListener("click", () => {
      loginModal.style.display = "flex";
    });
  }

  if (mobileOpenLogin && loginModal) {
    mobileOpenLogin.addEventListener("click", () => {
      loginModal.style.display = "flex";
    });
  }

  // CLICK OUTSIDE TO CLOSE
  window.addEventListener("click", (e) => {
    if (e.target.classList.contains("popup-overlay")) {
      e.target.style.display = "none";
    }
  });

});
