<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
roleOnly('admin');

require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/templates/aside-nav.php';
require_once __DIR__ . '/../../lib/services.php';

$service = false;
$errors = [];
$success = [];

if (isset($_GET['id'])) {
  $service = getServiceById($pdo, $_GET['id']);
}

if ($service) {
  if (deleteService($pdo, $service['id'])) {
    $success[] = 'Le service a été supprimé avec succès';
  } else {
    $errors[] = 'Erreur lors de la suppression du service';
  }
} else {
  $errors[] = 'Le service n\'existe pas';
}
?>

<main class="dashboard__main">
<div class="dashboard__card-wrapper">
  <h3 class="dashboard__card-title">Supression d'un service</h3>
  <?php if ($errors) {
    foreach ($errors as $error) { ?>
      <div class="dashboard__account-info">
        <h3 class="dashboard__account-message--error"><?= $error ?></h3>
      </div>
  <?php }
  } ?>
  <?php if ($success) {
    foreach ($success as $message) { ?>
      <div class="dashboard__account-info">
        <h3 class="dashboard__account-message--success"><?= $message ?></h3>
      </div>
  <?php }
  } ?>
</div>
</main>
</body>
</html>