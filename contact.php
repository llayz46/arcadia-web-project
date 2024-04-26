<?php 
require_once __DIR__ . '/lib/menu.php';

$currentPage = basename($_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$mainMenu[$currentPage]['head_title'] ?> - Arcadia</title>
  <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body class="contact-body">
  <!-- START : header -->
  <header class="contact-header">
    <a class="header__logo" href="./index.php">Arcadia</a>
  </header>
  <!-- END : header -->

  <!-- START : main -->
  <main class="contact-main">
    <div class="contact__image"></div>
    <div class="contact__form-wrapper">
      <h1 class="contact__title">Nous contacter</h1>
      <p class="contact__text">Un problème ? Remplissez le formulaire ci-dessous pour nous contacter.</p>
      <form action="" class="contact__form">
        <div class="contact__form-group">
          <label for="name" class="contact__label">Objet</label>
          <input type="text" id="name" class="contact__input" required>
        </div>
        <div class="contact__form-group">
          <label for="email" class="contact__label">Email</label>
          <input type="email" id="email" class="contact__input" required>
        </div>
        <div class="contact__form-group">
          <label for="message" class="contact__label">Message</label>
          <textarea name="message" id="message" class="contact__textarea" required></textarea>
        </div>
        <button type="submit" class="contact__button button-dark">Envoyer</button>
      </form>
  </main>
  <!-- END : main -->
</body>
</html>