document.addEventListener("DOMContentLoaded", () => {
  console.log("Hello from custom.js");
  const burgerBtn = document.getElementById('burger-btn');
  const mobileMenuUser = document.getElementById('mobile-menu');
  const closeMenu = document.getElementById('close-menu');

  // Ouvrir le volet
  if (burgerBtn && mobileMenuUser) {
      burgerBtn.addEventListener('click', () => {
          mobileMenuUser.classList.remove('translate-x-full');
      });
  }

  // Fermer le volet
  if (closeMenu && mobileMenuUser) {
      closeMenu.addEventListener('click', () => {
          mobileMenuUser.classList.add('translate-x-full');
      });
  }

  const parallaxBg = document.getElementById("parallaxBg");
  const heroText = document.querySelectorAll("#hero h1, #hero p, #hero button");

  // Parallax Effect - seulement si l'élément existe
  if (parallaxBg) {
      window.addEventListener("scroll", () => {
          const scrollY = window.scrollY;
          parallaxBg.style.transform = `translateY(${scrollY * 0.4}px)`;
      });
  }
  
    // Fade-in Animations
    let delay = 0.2;
    heroText.forEach((element) => {
      element.style.opacity = 0;
      element.style.transform = "translateY(20px)";
      setTimeout(() => {
        element.style.transition = `opacity 0.6s ease, transform 0.6s ease`;
        element.style.opacity = 1;
        element.style.transform = "translateY(0)";
      }, delay * 1000);
      delay += 0.2;
    });
  
    // Parallax effect on the div and image
    document.addEventListener("scroll", () => {
      const elements = document.querySelectorAll(".parallax-container");
      const scrollPosition = window.scrollY;
  
      elements.forEach((el) => {
        const img = el.querySelector(".parallax-img");
        if (!img) return; // Skip if image not found
  
        const offset = el.getBoundingClientRect().top + window.scrollY;
  
        // Parallax effect for the image
        const movement = (scrollPosition - offset) * 0.08;
        img.style.transform = `translateY(${movement}px)`;
  
        // Scale effect on the div
        const scaleFactor = 1 + Math.min((scrollPosition - offset) * 0.0002, 0.1);
        el.style.transform = `scale(${scaleFactor})`;
      });
    });
  
    // Script to toggle mobile menu visibility
    const mobileMenuButton = document.getElementById("mobileMenuButton");
    const mobileMenu = document.getElementById("mobileMenu");
    const closeMobileMenu = document.getElementById("closeMobileMenu");
  
    mobileMenuButton.addEventListener("click", () => {
      mobileMenu.classList.toggle("translate-x-full");
    });
  
    closeMobileMenu.addEventListener("click", () => {
      mobileMenu.classList.add("translate-x-full");
    });
    
  });