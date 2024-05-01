<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/services.php';

$services = getServices($pdo);

$errors = [];
$success = [];

if (isset($_POST['createService'])) {
  if (empty($_POST['service-name']) || empty($_POST['service-about']) || empty($_POST['service-content'])) {
    $errors[] = 'Veuillez remplir tous les champs';
  } else {
    $res = createService($pdo, $_POST['service-name'], $_POST['service-about'], $_POST['service-content']);

    if ($res) {
      header('Refresh: 0');
      $success[] = 'Le service a été créé avec succès';
    } else {
      $errors[] = 'Erreur lors de la création du service';
    }
  }
}

require_once 'templates/aside-nav.php';
?>

<main class="dashboard__main">
  <h2 class="dashboard__title">Gestion des services</h2>
  <div class="dashboard__container">
    <div class="dashboard__card-wrapper">
      <h3 class="dashboard__card-title">Liste des services</h3>
      <ul class="dashboard__service-list">
        <?php foreach ($services as $service) { ?>
          <li class="dashboard__service-item">
            <h4 class="dashboard__service-title"><?= ucfirst($service['title']) ?></h4>
            <a class="dashboard__service-link" href="">Modifier</a>
            <div class="dashboard__service-separator"></div>
            <a class="dashboard__service-link" href="service_delete.php?id=<?= $service['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a>
          </li>
        <?php } ?>
      </ul>
    </div>
    <div class="dashboard__card-wrapper">
      <h3 class="dashboard__card-title">Ajouter un service</h3>
      <form method="post" class="dashboard__service-form">
        <label for="service-name" class="dashboard__account-label">
          Nom du service
          <input class="dashboard__account-input" type="text" name="service-name" id="service-name" required>
        </label>
        <label for="service-about" class="dashboard__account-label">
          A propos du service
          <input class="dashboard__account-input" type="text" name="service-about" id="service-about" required>
        </label>
        <label for="service-content" class="dashboard__account-label">
          Description du service
          <textarea class="dashboard__service-textarea" name="service-content" id="service-content" required></textarea>
        </label>
        <input class="dashboard__account-submit" type="submit" value="Créer le service" name="createService">
      </form>
      <?php if ($errors) {
        foreach ($errors as $error) { ?>
          <div class="dashboard__account-info">
            <h3 class="dashboard__account-message--error"><?= $error ?></h3>
          </div>
        <?php }
      } else if ($success) {
        foreach ($success as $message) { ?>
          <div class="dashboard__account-info">
            <h3 class="dashboard__account-message--success"><?= $message ?></h3>
          </div>
      <?php }
      } ?>
    </div>
  </div>
</main>
</body>

</html>