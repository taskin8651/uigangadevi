
document.addEventListener("DOMContentLoaded", function () {
  const slides = document.querySelectorAll(".hero-slide");
  const dots = document.querySelectorAll(".hero-controls button");

  let current = 0;

  function showSlide(index) {
    slides.forEach(slide => slide.classList.remove("active"));
    dots.forEach(dot => dot.classList.remove("active"));

    slides[index].classList.add("active");
    dots[index].classList.add("active");

    current = index;
  }

  function nextSlide() {
    let next = current + 1;
    if (next >= slides.length) next = 0;
    showSlide(next);
  }

  dots.forEach((dot, index) => {
    dot.addEventListener("click", function () {
      showSlide(index);
    });
  });

  setInterval(nextSlide, 5500);

  const navLinks = document.querySelectorAll(".navbar-collapse .nav-link, .dropdown-item");
  const navbarCollapse = document.querySelector(".navbar-collapse");

  navLinks.forEach(link => {
    link.addEventListener("click", function () {
      if (window.innerWidth < 992 && navbarCollapse.classList.contains("show")) {
        bootstrap.Collapse.getInstance(navbarCollapse)?.hide();
      }
    });
  });
});


// HERO //

/* ================= HERO SLIDER PREMIUM CLEAN JS START ================= */

document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".hero-slider");
  const slides = document.querySelectorAll(".hero-slide");
  const dots = document.querySelectorAll(".hero-controls button");

  if (!slider || !slides.length) return;

  let current = 0;
  let timer = null;
  let isAnimating = false;
  const delay = 4500;
  const animationTime = 950;

  function goToSlide(next) {
    if (next === current || isAnimating) return;

    isAnimating = true;

    slides.forEach(function (slide) {
      slide.classList.remove("active", "prev-slide");
    });

    slides[current].classList.add("prev-slide");
    slides[next].classList.add("active");

    dots.forEach(function (dot, index) {
      dot.classList.toggle("active", index === next);
    });

    current = next;

    setTimeout(function () {
      slides.forEach(function (slide, index) {
        if (index !== current) {
          slide.classList.remove("prev-slide");
        }
      });

      isAnimating = false;
    }, animationTime);
  }

  function nextSlide() {
    const next = (current + 1) % slides.length;
    goToSlide(next);
  }

  function startSlider() {
    stopSlider();
    timer = setInterval(nextSlide, delay);
  }

  function stopSlider() {
    if (timer) {
      clearInterval(timer);
      timer = null;
    }
  }

  dots.forEach(function (dot, index) {
    dot.addEventListener("click", function () {
      goToSlide(index);
      startSlider();
    });
  });

  slides.forEach(function (slide, index) {
    slide.classList.remove("active", "prev-slide");

    if (index === 0) {
      slide.classList.add("active");
    }
  });

  dots.forEach(function (dot, index) {
    dot.classList.toggle("active", index === 0);
  });

  startSlider();
});

/* ================= HERO SLIDER PREMIUM CLEAN JS END ================= */







 // ================= ADMISSION POPUP START ================= //

    window.addEventListener("load", function () {
      const popup = document.getElementById("admissionPopup");
      const closeBtn = document.getElementById("admissionPopupClose");
      const overlay = document.getElementById("admissionPopupOverlay");

      if (!popup) return;

      setTimeout(function () {
        popup.classList.add("active");
        document.body.classList.add("popup-open");
      }, 500);

      function closePopup() {
        popup.classList.remove("active");
        document.body.classList.remove("popup-open");
      }

      if (closeBtn) {
        closeBtn.addEventListener("click", closePopup);
      }

      if (overlay) {
        overlay.addEventListener("click", closePopup);
      }

      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
          closePopup();
        }
      });
    });

    // ================= ADMISSION POPUP END ================= //