<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Oclock - Manajemen Tugas Prioritas</title>
  <!-- tailwindcss -->
  <link rel="stylesheet" href="/frontend/src/css/styles.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="font-sans">
  <!-- Main container -->
  <main class="min-h-screen flex flex-col">
    <!-- header/navigation -->
    <nav class="bg-white shadow-sm py-4 px-6 ">
      <div class="container mx-auto flex justify-between items-center">
        <!-- logo -->
        <div class="flex items-center space-x-2">
          <i class="fa-solid fa-clock text-3xl text-blue-600"></i>
          <span class="text-xl font-bold text-blue-600">Oclock</span>
        </div>
        <!-- login button -->
        <a href=" login.php"
          class="text-blue-600 hover:text-blue-800 font-medium px-3 py-2 text-sm sm:text-base button-responsive">
          <i class="fas fa-sign-in-alt mr-1 sm:mr-2"></i>
          <span class="hidden sm:inline">Masuk</span>
          <span class="sm:hidden">Login</span>
        </a>
      </div>
    </nav>