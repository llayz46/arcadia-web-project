<?php 
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/menu.php';

$currentPage = basename($_SERVER['SCRIPT_NAME']);

if (isset($_POST['contact'])) {
  $objet = htmlentities($_POST['objet']);
  $email = htmlentities($_POST['email']);
  $message = htmlentities($_POST['message']);

  $to = _CONTACT_MAIL_;

  $subject = 'Contact Arcadia';

  $body = "Objet : $objet\n";
  $body .= "Email : $email\n";
  $body .= "Message :\n$message";

  $headers = "From: $email\r\n";
  $headers .= "Reply-To: $email\r\n";

  if (mail($to, $subject, $body, $headers)) {
    echo 'Message envoyé';
  } else {
    echo 'Erreur lors de l\'envoi du message';
  }
}
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
      <p class="contact__text">Une question ? Remplissez le formulaire ci-dessous pour nous contacter.</p>
      <form method="post" class="contact__form">
        <div class="contact__form-group">
          <label for="objet" class="contact__label">Objet</label>
          <input type="text" id="objet" name="objet" class="contact__input" required>
        </div>
        <div class="contact__form-group">
          <label for="email" class="contact__label">Email</label>
          <input type="email" id="email" name="email" class="contact__input" required>
        </div>
        <div class="contact__form-group">
          <label for="message" class="contact__label">Message</label>
          <textarea name="message" id="message" name="message" class="contact__textarea" required></textarea>
        </div>
        <input type="submit" class="contact__button button-dark" value="Envoyer" name="contact">
      </form>
  </main>
  <!-- END : main -->
</body>
</html>
