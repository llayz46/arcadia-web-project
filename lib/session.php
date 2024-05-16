<?php

session_set_cookie_params([
  'lifetime' => 3600,
  'path' => '/',
  'domain' => _DOMAIN_,
  'httponly' => true,
  'sameSite' => 'lax',
]);

session_start();

function roleOnly(string $role): void {
  if (!isset($_SESSION['user'])) {
    header('Location: ../../login.php');
    exit;
  } else if ($_SESSION['user']['name'] !== $role) {
    header('Location: ../../index.php');
    exit;
  }
}