<?php
require_once __DIR__ . '/lib/menu.php';

$currentPage = basename($_SERVER['SCRIPT_NAME']);
?>

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
      <h2 class="login__title">Connexion</h2>
      <form class="login__form" action="../index.html" method="post">
        <input class="login__form-input" placeholder="Email" type="email" id="email" name="email" required>
        <input class="login__form-input" placeholder="Mot de passe" type="password" id="password" name="password" required>
        <button class="login__form-submit button-light" type="submit">Se connecter</button>
      </form>
    </div>
  </section>
  <!-- END : login -->
</body>
</html>