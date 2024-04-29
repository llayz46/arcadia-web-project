<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/user.php';
require_once __DIR__ . '/lib/session.php';
require_once __DIR__ . '/lib/menu.php';

$currentPage = basename($_SERVER['SCRIPT_NAME']);

$errors = [];

if (isset($_SERVER['user'])) {
  header('Location: /index.php');
}

if (isset($_POST['loginUser'])) {
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $user = verifyUserAndRoleByLoginPassword($pdo, $email, $password);

  if ($user) {
    session_regenerate_id(true);
    $_SESSION['user'] = $user;

    if ($user['role'] === 'admin') {
      header('Location: /admin/index.php');
    } else {
      header('Location: /index.php');
    }
  } else {
    $errors[] = 'Email ou mot de passe incorrect';
  }
} ?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $mainMenu[$currentPage]['head_title'] ?> - Arcadia</title>
  <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body class="login-body">
  <!-- START : header -->
  <header class="header flux">
    <a class="header__logo" href="/index.php">Arcadia</a>
  </header>
  <!-- END : header -->

  <!-- START : login -->
  <section class="login">
    <div class="login__container">
      <?php if($errors) { ?>
        <div class="login__errors">
          <?php foreach($errors as $error) { ?>
            <p class="login__error"><?= $error ?></p>
          <?php } ?>
        </div>
      <?php } ?>
      <h2 class="login__title">Connexion</h2>
      <form class="login__form" method="post">
        <input class="login__form-input" placeholder="Email" type="email" id="email" name="email" required>
        <input class="login__form-input" placeholder="Mot de passe" type="password" id="password" name="password" required>
        <input class="login__form-submit button-light" type="submit" name="loginUser" value="Se connecter"></input>
      </form>
    </div>
  </section>
  <!-- END : login -->
</body>
</html>
