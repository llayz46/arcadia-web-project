<?php
require_once 'lib/config.php';
require_once 'lib/pdo.php';
require_once 'lib/session.php';
require_once 'lib/reviews.php';

if (isset($_POST['createReview'])) {
  if (empty($_POST['name']) || empty($_POST['message'])) {
    $_SESSION['errors'][] = 'Veuillez remplir tous les champs';
  } else {
    if ($_POST['star_rating'] == 0) {
      $_SESSION['errors'][] = 'Veuillez sélectionner une note';
      header('Location: ' . $_SERVER['PHP_SELF']);
      exit();
    } else {
      $res = createReview($pdo, $_POST['name'], $_POST['message'], $_POST['star_rating']);

      if ($res) {
        $_SESSION['success'][] = 'Votre avis a bien été enregistré';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
      } else {
        $_SESSION['errors'][] = 'Erreur lors de l\'enregistrement de votre avis';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Votre avis compte - Arcadia</title>
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
      <h1 class="contact__title">Partagez votre expérience</h1>
      <p class="contact__text">Vous aussi, partagez votre expérience au Zoo Arcadia et faites partie de notre communauté ! Votre avis compte pour nous.</p>
      <form method="post" class="contact__form">
        <div class="contact__form-group">
          <label for="name" class="contact__label">Nom</label>
          <input type="text" id="name" name="name" class="contact__input" required>
        </div>
        <div class="contact__form-group">
          <label for="message" class="contact__label">Message</label>
          <textarea name="message" id="message" class="contact__textarea" required></textarea>
        </div>
        <div class="contact__form-group">
          <label for="star_rating" class="contact__label">Note</label>
          <div class="star__container">
            <svg class="star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" />
            </svg>
            <svg class="star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" />
            </svg>
            <svg class="star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" />
            </svg>
            <svg class="star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" />
            </svg>
            <svg class="star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" />
            </svg>
          </div>
        </div>
        <input type="hidden" name="star_rating" id="star_rating" value="0" required>
        <button type="submit" class="contact__button button-dark" name="createReview">Envoyer</button>
      </form>
      <?php if (isset($_SESSION['errors'])) { ?>
        <div class="dashboard__account-info">
          <?php foreach ($_SESSION['errors'] as $error) { ?>
            <p class="dashboard__account-message dashboard__account-message--error"><?= $error ?></p>
          <?php } ?>
        </div>
        <?php unset($_SESSION['errors']) ?>
      <?php } else if (isset($_SESSION['success'])) { ?>
        <div class="dashboard__account-info">
          <?php foreach ($_SESSION['success'] as $message) { ?>
            <p class="dashboard__account-message dashboard__account-message--success"><?= $message ?></p>
          <?php } ?>
        </div>
        <?php unset($_SESSION['success']) ?>
      <?php } ?>
  </main>
  <!-- END : main -->
  <script src="./assets/scripts/reviewNotation.js"></script>
</body>

</html>