<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/animals.php';
require_once __DIR__ . '/../../lib/reports.php';

$animals = getAnimalsAndBreed($pdo);

if (isset($_GET['animal-feed'])) {
  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'dashboard/employe/animals.php';

  if (strpos($referer, 'dashboard/employe/animals.php') !== false) {
    $backLink = 'animals.php';
  } else {
    $backLink = 'animals.php';
  }

  if (isset($_POST['addFeed'])) {
    if (!isset($_POST['animal_feed'])) {
      $_SESSION['errors'][] = 'Veuillez saisir l\'alimentation du jour';
    } else if (!isset($_POST['animal_date'])) {
      $_SESSION['errors'][] = 'Veuillez saisir la date du repas';
    } else {
      $animalFeed = htmlspecialchars(trim($_POST['animal_feed']));
      $animalId = $_GET['animal-feed'];
      $date = new DateTime($_POST['animal_date']);
      $actualDate = new DateTime();

      if ($date > $actualDate->add(new DateInterval('P1D'))) {
        $_SESSION['errors'][] = 'La date ne peut pas être supérieure à la date du jour';
      } else {
        if (addAnimalFeed($pdo, $animalFeed, $animalId, $date)) {
          $_SESSION['success'][] = 'L\'alimentation a bien été ajoutée';
          header('Location: ' . $_SERVER['PHP_SELF']);
          exit();
        } else {
          $_SESSION['errors'][] = 'Erreur lors de l\'ajout de l\'alimentation';
        }
      }
    }
  }
}

require_once '../templates/aside-nav.php';
?>

<main class="dashboard__main">
  <h2 class="dashboard__title">Gestion de l'alimentation des animaux</h2>
  <?php if (!isset($_GET['animal-feed'])) { ?>
    <div class="dashboard__card-wrapper dashboard__card-wrapper--review">
      <h3 class="dashboard__card-title">Liste des animaux</h3>
      <ul class="dashboard__review-list">
        <?php foreach ($animals as $index => $animal) {
          $animalReport = getAnimalReportByAnimalId($pdo, $animal['animal_id']);
        ?>
          <li class="dashboard__review-wrapper">
            <div class="dashboard__review-item">
              <div class="dashboard__review-text-container">
                <h4 class="animal-name"><?= ucfirst($animal['animal_name']) ?></h4>
                <p class="animal-content"><span class="report-content--bold">Conseillé : </span><?php if ($animalReport !== false) {
                                                                                                  echo $animalReport['food'];
                                                                                                } else {
                                                                                                  echo 'Aucun repas conseillé';
                                                                                                } ?></p>
                <?php if ($animal['animal_feed']) { ?>
                  <p class="animal-content"><span class="report-content--bold">Repas du <?= $animal['animal_feedDate'] ?> : </span><?= $animal['animal_feed'] ?></p>
                <?php } ?>
              </div>
            </div>
            <a href="?animal-feed=<?= $animal['animal_id'] ?>" class="review-button review-one-button animal-button">Saisir l'alimentation</a>
          </li>
        <?php } ?>
      </ul>
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
    </div>
  <?php } else { ?>
    <div class="dashboard__flex-container">
      <a href="<?= $backLink ?>" class="dashboard__backlink">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M14 7.45H3.32502L7.57502 3.125C7.80002 2.9 7.80002 2.55 7.57502 2.325C7.35002 2.1 7.00002 2.1 6.77502 2.325L1.60002 7.575C1.37502 7.8 1.37502 8.15 1.60002 8.375L6.77502 13.625C6.87502 13.725 7.02502 13.8 7.17502 13.8C7.32502 13.8 7.45002 13.75 7.57502 13.65C7.80002 13.425 7.80002 13.075 7.57502 12.85L3.35002 8.575H14C14.3 8.575 14.55 8.325 14.55 8.025C14.55 7.7 14.3 7.45 14 7.45Z" fill="#121212" />
        </svg>
        back
      </a>
      <div class="dashboard__container dashboard__container--no-margin">
        <div class="dashboard__card-wrapper">
          <?php $animalName = getAnimalById($pdo, $_GET['animal-feed']) ?>
          <h3 class="dashboard__card-title"><?= $animalName['name'] ?></h3>
          <form method="post" class="dashboard__service-form" enctype="multipart/form-data">
            <label for="animal_feed" class="dashboard__account-label">
              Nourriture
              <input class="dashboard__account-input" type="text" placeholder="Steak, 200g" name="animal_feed" id="animal_feed" required>
            </label>
            <label for="animal_date" class="dashboard__account-label">
              Date du repas
              <input class="dashboard__account-input dashboard__account-input--date" type="datetime-local" name="animal_date" id="animal_date" required>
            </label>
            <input class="dashboard__account-submit" type="submit" value="Ajouter l'alimentation du jour" name="addFeed">
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
        </div>
      </div>
    </div>
  <?php } ?>
</main>

</body>

</html>