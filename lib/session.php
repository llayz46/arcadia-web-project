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