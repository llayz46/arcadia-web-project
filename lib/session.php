<?php

session_set_cookie_params([
  'lifetime' => 3600,
  'path' => '/',
  'domain' => _DOMAIN_,
  'httponly' => true,
]);

session_start();

// if (!isset($_SESSION['csrf_token'])) {
//   $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
// }

function roleOnly(string $role): void {
  if (!isset($_SESSION['user'])) {
    header('Location: ../../login.php');
    exit;
  } else if ($_SESSION['user']['name'] !== $role) {
    header('Location: ../../index.php');
    exit;
  }
}