<?php

function getGuestButtons()
{
  return [
    'index' => [
      'text_full' => 'Masuk',
      'text_mobile' => 'Login',
      'icon' => 'fa-sign-in-alt',
      'link' => '?page=login'
    ],
    'login' => [
      'text_full' => 'Daftar',
      'text_mobile' => 'Register',
      'icon' => 'fa-user-plus',
      'link' => '?page=register'
    ],
    'register' => [
      'text_full' => 'Masuk',
      'text_mobile' => 'Login',
      'icon' => 'fa-sign-in-alt',
      'link' => '?page=login'
    ],
  ];
}

function getAuthButtons()
{
  return [
    'dashboard' => [
      'text_full' => 'Keluar',
      'icon' => 'fa-sign-out-alt',
      'link' => '?page=logout'
    ],
    'default' => [
      'text_full' => 'Dashboard',
      'icon' => 'fa-home',
      'link' => '?page=dashboard'
    ]
  ];
}

function renderHeaderButton($page, $isLoggedIn)
{

  if (!$isLoggedIn) {
    $guestButtons = getGuestButtons();

    if (isset($guestButtons[$page])) {
      $btn = $guestButtons[$page];

      echo "
            <a href='{$btn['link']}' class='text-blue-600 hover:text-blue-800 font-medium px-4 py-2 sm:text-base button-responsive'>
                <i class='fas {$btn['icon']} mr-1 sm:mr-2'></i>
                <span class='hidden sm:inline'>{$btn['text_full']}</span>
                <span class='sm:hidden'>{$btn['text_mobile']}</span>
            </a>
            ";
    }

  } else {
    $authButtons = getAuthButtons();

    $btn = ($page === 'dashboard')
      ? $authButtons['dashboard']
      : $authButtons['default'];

    echo "
        <a href='{$btn['link']}' class='text-blue-600 hover:text-blue-800 font-medium px-4 py-2 sm:text-base button-responsive'>
            <i class='fas {$btn['icon']} mr-1 sm:mr-2'></i>
            <span>{$btn['text_full']}</span>
        </a>
        ";
  }
}