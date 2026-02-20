<?php
require_once BASE_PATH . "/backend/config/session.php";
require_once BASE_PATH . "/backend/helpers/ui_helper.php";
$page = $page ?? ($_GET['page'] ?? 'index');
$isLoggedIn = isLoggedIn();
?>

<!-- header/navigation -->
<nav class="bg-white shadow-sm py-4 px-4 mobile-padding">
  <div class="container mx-auto flex justify-between items-center mobile-padding">
    <!-- logo -->
    <div class="flex items-center space-x-2">
      <div class="bg-blue-gradient rounded-2xl flex items-center w-12 h-12 justify-center shadow-lg lg:w-14 lg:h-14">
        <i class="fa-solid fa-clock text-2xl text-white lg:text-3xl "></i>
      </div>
      <span class="text-xl font-bold text-blue-600">Oclock</span>
    </div>
    <!-- login button -->
    <div>
      <?php renderHeaderButton($page, $isLoggedIn); ?>
    </div>
  </div>
</nav>