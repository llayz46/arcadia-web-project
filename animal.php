<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/mongodb.php';
require_once __DIR__ . '/lib/animals.php';
require_once __DIR__ . '/lib/habitats.php';
require_once __DIR__ . '/lib/reports.php';

require_once __DIR__ . '/templates/header.php';

function mb_ucfirst($string, $encoding = 'UTF-8')
{
  $firstChar = mb_substr($string, 0, 1, $encoding);
  $rest = mb_substr($string, 1, mb_strlen($string, $encoding), $encoding);
  return mb_strtoupper($firstChar, $encoding) . $rest;
}

if (isset($_GET['habitat'])) {
  $habitat = $_GET['habitat'];
  $habitats = getHabitats($pdo);

  if (!empty($habitat) && array_key_exists($habitat, $habitats)) {
    $animals = getAnimalsByHabitat($pdo, $habitat);

    if (count($animals) !== 0) { ?>
      <main class="animal-main">
        <h1 class="animal__title animal__title--light"><?= ucfirst($animals[0]['habitat_title']) ?></h1>
        <div class="animal__container">
          <?php foreach ($animals as $index => $animal) {
            $report = getAnimalReportsByAnimalId($pdo, $animal['animal_id']) ?>
            <div class="animal__card animal__card--page">
              <img src="https://arcadiaweb.blob.core.windows.net/images/animals/animal-<?= str_replace(' ', '_', strtolower($animal['animal_name'])) ?>.jpg?<?= _AZURE_CONTAINER_KEY_ ?>" alt="<?= mb_ucfirst($animal['animal_name']) ?>" class="animal__image">
              <h3 class="animal__card-name"><?= mb_ucfirst($animal['animal_name']) ?></h3>
              <button class="animal__card-button js-modal-trigger button-dark js-animal-button" data-target="<?= $index ?>">En savoir plus</button>
            </div>

            <div class="animal__modal-container js-modal-container-<?= $index ?>" data-animal-id="<?= $animal['animal_id'] ?>">
              <div class="animal__modal-overlay js-modal-trigger" data-target="<?= $index ?>"></div>
              <div class="animal__modal">
                <button class="animal__modal-close js-modal-trigger" data-target="<?= $index ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M7.79222 6.99691L13.8329 0.958904C14.0557 0.736191 14.0557 0.389748 13.8329 0.167035C13.6101 -0.0556783 13.2635 -0.0556783 13.0407 0.167035L7 6.20504L0.959328 0.167035C0.736516 -0.0556783 0.38992 -0.0556783 0.167109 0.167035C-0.0557029 0.389748 -0.0557029 0.736191 0.167109 0.958904L6.20778 6.99691L0.167109 13.0349C-0.0557029 13.2576 -0.0557029 13.6041 0.167109 13.8268C0.266136 13.9258 0.414677 14 0.563218 14C0.71176 14 0.860301 13.9505 0.959328 13.8268L7 7.78878L13.0407 13.8268C13.1397 13.9258 13.2882 14 13.4368 14C13.5853 14 13.7339 13.9505 13.8329 13.8268C14.0557 13.6041 14.0557 13.2576 13.8329 13.0349L7.79222 6.99691Z" fill="#ffffff" />
                  </svg>
                </button>
                <p class="animal__modal-title">Nom : <?= mb_ucfirst($animal['animal_name']) ?></p>
                <p class="animal__modal-title">Espèce : <?= mb_ucfirst($animal['breed_name']) ?></p>
                <p class="animal__modal-title">Habitat : <?= mb_ucfirst($animal['habitat_title']) ?></p>
                <img src="https://arcadiaweb.blob.core.windows.net/images/animals/animal-<?= str_replace(' ', '_', strtolower($animal['animal_name'])) ?>.jpg?<?= _AZURE_CONTAINER_KEY_ ?>" alt="<?= mb_ucfirst($animal['animal_name']) ?>" class="animal__image">
                <?php if ($report) { ?>
                  <p class="animal__modal-title animal__modal-title--mt">État : <?= mb_ucfirst($report[0]['state']) ?></p>
                <?php } ?>
              </div>
            </div>
          <?php } ?>
        </div>
      </main>
    <?php } else { ?>
      <main class="animal-main">
        <h1 class="animal__title animal__title--light">Pour le moment, il n'y a malheureusement aucun animal dans cet habitat.</h1>
      </main>
    <?php }
  } else {
    header('Location: /animal.php?habitat=' . array_keys($habitats)[0]);
    exit();
  }
} ?>

<script src="./assets/scripts/animalView.js"></script>
<script src="./assets/scripts/nav.js"></script>
<script src="./assets/scripts/modal.js"></script>
</body>

</html>