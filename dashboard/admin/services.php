<?php

require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/services.php';

if (isset($_GET['service-delete-id'])) {
  $serviceDeleteId = $_GET['service-delete-id'];
  $serviceToDelete = getServiceById($pdo, $serviceDeleteId);

  if ($serviceDeleteId) {
    if (deleteService($pdo, $serviceDeleteId)) {
      for ($i = 1; $i <= 3; $i++) {
        foreach (_ALLOWED_EXTENSIONS_ as $ext) {
          $file = '../..' . _PATH_UPLOADS_ . 'services/service-' . str_replace(' ', '_', $serviceToDelete['title']) . '-0' . $i . '.' . $ext;
          if (file_exists($file)) {
            unlink($file);
          }
        }
      }

      $_SESSION['success'][] = 'Le service a été supprimé avec succès';

      header('Location: services.php');
      exit;
    } else {
      $_SESSION['errors'][] = 'Erreur lors de la suppression du service';
    }
  } else {
    $_SESSION['errors'][] = 'Le service n\'existe pas';
  }
}

$services = getServices($pdo);

if (isset($_POST['createService'])) {
  if (empty($_POST['service-name']) || empty($_POST['service-about']) || empty($_POST['service-content'])) {
    $_SESSION['errors'][] = 'Veuillez remplir tous les champs';
  } else {
    $res = createService($pdo, $_POST['service-name'], $_POST['service-about'], $_POST['service-content']);

    if ($res) {
      $files = $_FILES['service-images'];

      $i = 1;
      foreach ($files['name'] as $key => $file) {
        $fileName = $files['name'][$key];
        $fileTmpName = $files['tmp_name'][$key];
        $fileSize = $files['size'][$key];
        $fileError = $files['error'][$key];
        $fileType = $files['type'][$key];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = _ALLOWED_EXTENSIONS_;

        if (in_array($fileActualExt, $allowed)) {
          if ($fileError === 0) {
            if ($fileSize < 1000000) {
              $serviceName = strtolower(str_replace(' ', '_', $_POST['service-name']));
              $fileNameNew = 'service-' . $serviceName . '-0' . $i . '.' . $fileActualExt;
              $fileDestination = '../..' . _PATH_UPLOADS_ . 'services/' . $fileNameNew;
              move_uploaded_file($fileTmpName, $fileDestination);
              $i++;
            } else {
              $_SESSION['errors'][] = 'Votre fichier est trop volumineux';
            }
          } else {
            $_SESSION['errors'][] = 'Erreur lors de l\'envoi de votre fichier';
          }
        } else {
          $_SESSION['errors'][] = 'Vous ne pouvez pas envoyer ce type de fichier';
        }
      }

      $_SESSION['success'][] = 'Le service a été créé avec succès';
      header('Location: ' . $_SERVER['PHP_SELF']);
      exit();
    } else {
      $_SESSION['errors'][] = 'Erreur lors de la création du service';
    }
  }
}

require_once '../templates/aside-nav.php';
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
            <a class="dashboard__service-link" href="?service-delete-id=<?= $service['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?')">Supprimer</a>
          </li>
        <?php } ?>
      </ul>
    </div>
    <div class="dashboard__card-wrapper">
      <h3 class="dashboard__card-title">Ajouter un service</h3>
      <form method="post" class="dashboard__service-form" enctype="multipart/form-data">
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
        <label for="service-images" class="dashboard__account-label">
          <input class="dashboard__form-file" type="file" name="service-images[]" id="service-images" accept="image/*" required>
          <input class="dashboard__form-file" type="file" name="service-images[]" id="service-images" accept="image/*" required>
          <input class="dashboard__form-file" type="file" name="service-images[]" id="service-images" accept="image/*" required>
        </label>
        <input class="dashboard__account-submit" type="submit" value="Créer le service" name="createService">
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