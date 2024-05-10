<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/animals.php';
require_once __DIR__ . '/../../lib/reports.php';

$animals = getAnimalsAndBreed($pdo);

if (isset($_POST['addReport'])) {
  if(!isset($_POST['animal_reports-state']) || !isset($_POST['animal_reports-food']) || !isset($_POST['animal_reports-date']) || !isset($_POST['animal_reports-animal'])) {
    $_SESSION['errors'][] = 'Veuillez remplir tous les champs';
  } else {
    $state = htmlspecialchars(trim($_POST['animal_reports-state']));
    if (isset($_POST['animal_reports-detail'])) {
      $detail = htmlspecialchars(trim($_POST['animal_reports-detail']));
    }
    $food = htmlspecialchars(trim($_POST['animal_reports-food']));
    $date = new DateTime($_POST['animal_reports-date']);
    $animal = $_POST['animal_reports-animal'];

    if ($date > new DateTime()) {
      $_SESSION['errors'][] = 'La date ne peut pas être supérieure à la date du jour';
    } else {
      if (addReport($pdo, $state, $detail, $food, $date, $animal, $_SESSION['user']['id'])) {
        $_SESSION['success'][] = 'Le compte rendu a bien été ajouté';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
      } else {
        $_SESSION['errors'][] = 'Erreur lors de l\'ajout du compte rendu';
      }
    }
  }
}

$reports = getReports($pdo, 4);

require_once '../templates/aside-nav.php';
?>

<main class="dashboard__main">
  <h2 class="dashboard__title">Gestion des comptes-rendus</h2>
  <div class="dashboard__container">
    <div class="dashboard__card-wrapper">
      <h3 class="dashboard__card-title">Les derniers comptes rendus</h3>
      <ul class="dashboard__report-list">
      <?php foreach ($reports as $report) { ?>
        <li class="dashboard__report-wrapper">
          <?php $animal = getAnimalById($pdo, $report['animal_id']) ?>
          <div class="dashboard__report-item">
            <h4 class="report-name">Compte rendu de : <?= ucfirst($animal['name']) ?></h4>
            <div class="dashboard__report-text-container dashboard__report-item">
              <p class="report-content"><span class="report-content--bold">État :</span> <?= ucfirst($report['state']) ?></p>
              <?php if ($report['state_detail']) { ?>
                <p class="report-content"><span class="report-content--bold">Détail :</span> <?= ucfirst($report['state_detail']) ?></p>
              <?php } ?>
              <p class="report-content"><span class="report-content--bold">Alimentation proposé :</span> <?= ucfirst($report['food']) ?></p>
              <p class="report-content"><span class="report-content--bold">Date de passage : </span><?= ucfirst($report['date']) ?></p>
            </div>
          </div>
        </li>
      <?php } ?>
    </ul>
    </div>

    <div class="dashboard__card-wrapper">
      <h3 class="dashboard__card-title">Ajouter un compte rendu</h3>
      <form method="post" class="dashboard__service-form" enctype="multipart/form-data">
        <label for="animal_reports-state" class="dashboard__account-label">
          Etat de santé de l'animal
          <input class="dashboard__account-input" type="text" placeholder="Bonne santé" name="animal_reports-state" id="animal_reports-state" required>
        </label>
        <label for="animal_reports-detail" class="dashboard__account-label">
          Détail sur l'état de l'animal
          <textarea class="dashboard__service-textarea" placeholder="Boit beaucoup d'eau, a perdu l'appétit, etc" name="animal_reports-detail" id="animal_reports-detail"></textarea>
        </label>
        <label for="animal_reports-food" class="dashboard__account-label">
          Nourriture et grammage proposé pour l'animal
          <input class="dashboard__account-input" type="text" placeholder="Croquettes, 150 g par repas" name="animal_reports-food" id="animal_reports-food" required>
        </label>
        <label for="animal_reports-date" class="dashboard__account-label">
          Date de la visite
          <input class="dashboard__account-input dashboard__account-input--date" type="date" name="animal_reports-date" id="animal_reports-date" required>
        </label>
        <label for="animal_reports-animal" class="dashboard__account-label">
          Choisir un animal
          <select class="dashboard__account-input" name="animal_reports-animal" id="animal_reports-animal" required>
            <option value="">Choisir un animal</option>
            <?php foreach ($animals as $animal) { ?>
              <option value="<?= $animal['animal_id'] ?>"><?= ucfirst($animal['animal_name']) ?></option>
            <?php } ?>
          </select>
        </label>
        <input class="dashboard__account-submit" type="submit" value="Ajouter un compte rendu" name="addReport">
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
</main>
</body>

</html>