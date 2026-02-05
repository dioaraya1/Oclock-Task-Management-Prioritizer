<!-- Footer -->
<footer class="bg-blue-900 text-white py-8 mt-8">
  <div class="container mx-auto px-6 mobile-padding">
    <div class="flex flex-col md:flex-row justify-between items-center">
      <!-- Logo & Brand -->
      <div class="mb-4 md:mb-0">
        <div class="flex items-center space-x-3">
          <i class="fas fa-clock text-3xl md:text-4xl"></i>
          <div>
            <h3 class="text-xl font-bold">O'Clock</h3>
            <p class="text-blue-200 text-sm">Manajemen Tugas Prioritas</p>
          </div>
        </div>
      </div>

      <!-- Social Media Links -->
      <div class="flex space-x-4 md:space-x-6 mb-4 md:mb-0">
        <a href="#" class="hover:text-blue-300 transition-colors duration-300" aria-label="Twitter">
          <i class="fab fa-twitter text-lg"></i>
        </a>
        <a href="#" class="hover:text-blue-300 transition-colors duration-300" aria-label="GitHub">
          <i class="fab fa-github text-lg"></i>
        </a>
        <a href="#" class="hover:text-blue-300 transition-colors duration-300" aria-label="Email">
          <i class="fas fa-envelope text-lg"></i>
        </a>
      </div>
    </div>

    <!-- Copyright -->
    <div class="border-t border-blue-800 mt-6 pt-6 text-center text-sm text-blue-300">
      <p>&copy; <?php echo date('Y'); ?> O'Clock. All rights reserved.</p>
    </div>
  </div>
</footer>
</main>

<!-- JavaScript -->
<script>
  // Add hover effect to feature cards
  document.querySelectorAll('.feature-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.style.transform = 'translateY(-8px)';
    });

    card.addEventListener('mouseleave', () => {
      card.style.transform = 'translateY(0)';
    });
  });

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
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
    const elements = document.querySelectorAll('.text-responsive');

    elements.forEach(el => {
      if (width < 640) {
        el.classList.add('text-sm');
      } else {
        el.classList.remove('text-sm');
      }
    });
  }

  // Run on load and resize
  window.addEventListener('load', adjustFontSizes);
  window.addEventListener('resize', adjustFontSizes);

  // Touch device detection
  const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints;
  if (isTouchDevice) {
    document.body.classList.add('touch-device');
  }
</script>
</body>

</html>