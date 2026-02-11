// Add hover effect to feature cards
document.querySelectorAll(".feature-card").forEach((card) => {
  card.addEventListener("mouseenter", () => {
    card.style.transform = "translateY(-8px)";
  });

  card.addEventListener("mouseleave", () => {
    card.style.transform = "translateY(0)";
  });
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  });
});

// Mobile menu toggle (if needed in future)
let mobileMenuButton = null;
let mobileMenu = null;

// Responsive font size adjustments
function adjustFontSizes() {
  const width = window.innerWidth;
  const elements = document.querySelectorAll(".text-responsive");

  elements.forEach((el) => {
    if (width < 640) {
      el.classList.add("text-sm");
    } else {
      el.classList.remove("text-sm");
    }
  });
}

// Run on load and resize
window.addEventListener("load", adjustFontSizes);
window.addEventListener("resize", adjustFontSizes);

// Touch device detection
const isTouchDevice = "ontouchstart" in window || navigator.maxTouchPoints;
if (isTouchDevice) {
  document.body.classList.add("touch-device");
}
