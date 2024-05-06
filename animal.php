<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/animals.php';
require_once __DIR__ . '/lib/habitats.php';

require_once __DIR__ . '/templates/header.php';

if (isset($_GET['habitat'])) {
  $habitat = $_GET['habitat'];

  if (!empty($habitat)) {
    $animals = getAnimalsByHabitat($pdo, $habitat); ?>

    <main class="animal-main">
      <h1 class="animal__title"><?= ucfirst($animals[0]['title']) ?></h1>
      <div class="animal__container">
        <?php foreach ($animals as $animal) { ?>
          <div class="animal__card animal__card--page">
            <img src="<?=_PATH_UPLOADS_?>animals/animal-<?=strtolower($animal['name'])?>.jpg" alt="" class="animal__image">
            <h3 class="animal__card-name"><?= ucfirst($animal['name']) ?></h3>
            <button class="animal__card-button button-dark">En savoir plus</button>
          </div>
        <?php } ?>
      </div>
    </main>

<?php } else {
    $habitats = getHabitats($pdo);
    header('Location: /animal.php?habitat=' . array_keys($habitats)[0]);
  }
} ?>

</body>

</html>