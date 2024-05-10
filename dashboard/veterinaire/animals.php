<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/animals.php';
require_once __DIR__ . '/../../lib/reports.php';

$animals = getAnimalsAndBreed($pdo);

require_once '../templates/aside-nav.php';
?>

<main class="dashboard__main">
  <h2 class="dashboard__title">Visualisation de l'alimentation des animaux</h2>
  <div class="dashboard__card-wrapper dashboard__card-wrapper--review">
    <h3 class="dashboard__card-title">Liste des animaux</h3>
    <ul class="dashboard__review-list">
      <?php foreach ($animals as $index => $animal) {
        $animalReport = getAnimalReportByAnimalId($pdo, $animal['animal_id']) ?>
        <li class="dashboard__review-wrapper">
          <div class="dashboard__review-item">
            <div class="dashboard__review-text-container">
              <h4 class="animal-name"><?= ucfirst($animal['animal_name']) ?></h4>
              <p class="animal-content"><span class="report-content--bold">Conseillé : </span><?= $animalReport['food'] ?></p>
              <?php if ($animal['animal_feed']) { ?>
                <p class="animal-content"><span class="report-content--bold">Repas du <?=$animal['animal_feedDate']?> : </span><?= $animal['animal_feed'] ?></p>
              <?php } ?>
            </div>
          </div>
        </li>
      <?php } ?>
    </ul>
  </div>
</main>

</body>

</html>