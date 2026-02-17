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

// login
function togglePassword() {
  const input = document.getElementById("password");
  const icon = document.getElementById("eye-icon");
  const isText = input.type === "text";

  input.type = isText ? "password" : "text";

  icon.innerHTML = isText
    ? `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
           <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`
    : `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
}
