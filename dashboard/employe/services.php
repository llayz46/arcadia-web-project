<?php

require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/services.php';

if (isset($_GET['delete'])) {
  $serviceDeleteId = $_GET['delete'];
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

if (isset($_GET['modified'])) {
  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'dashboard/employe/services.php';

  if (strpos($referer, 'dashboard/employe/services.php') !== false) {
    $backLink = 'services.php';
  } else {
    $backLink = 'services.php';
  }

  $serviceId = (int)$_GET['modified'];

  $service = getServiceById($pdo, $serviceId);

  if (!$service) {
    $_SESSION['errors'][] = 'Le service n\'existe pas';
    header('Location: services.php');
    exit;
  }

  if (isset($_POST['modifiedService'])) {

    if (empty($_POST['service-name']) || empty($_POST['service-about']) || empty($_POST['service-content'])) {
      $_SESSION['errors'][] = 'Veuillez remplir tous les champs';
    } else {
      $name = htmlspecialchars(trim($_POST['service-name']));
      $about = htmlspecialchars(trim($_POST['service-about']));
      $content = htmlspecialchars(trim($_POST['service-content']));

      if ($name === $service['title'] && $about === $service['about'] && $content === $service['content']) {
        $_SESSION['errors'][] = 'Aucune modification n\'a été apportée';
      } else {
        if (updateService($pdo, $serviceId, $name, $about, $content)) {
          if ($name !== $service['title']) {
            for ($i = 1; $i <= 3; $i++) {
              foreach (_ALLOWED_EXTENSIONS_ as $ext) {
                $file = '../..' . _PATH_UPLOADS_ . 'services/service-' . str_replace(' ', '_', strtolower($service['title'])) . '-0' . $i . '.' . $ext;
                if (file_exists($file)) {
                  $newFile = '../..' . _PATH_UPLOADS_ . 'services/service-' . str_replace(' ', '_', strtolower($name)) . '-0' . $i . '.' . $ext;
                  rename($file, $newFile);
                }
              }
            }
          }

          if (!empty($_FILES['service-images']['tmp_name'][0]) && !empty($_FILES['service-images']['tmp_name'][1]) && !empty($_FILES['service-images']['tmp_name'][2])){
            $serviceImages = [];
            $serviceImagesDir = '../..' . _PATH_UPLOADS_ . 'services/';
            $files = scandir($serviceImagesDir);
            $serviceFiles = preg_grep('/service-' . str_replace(' ', '_', strtolower($name)) . '-0[1-3]\.(jpg|jpeg|png|gif)/', $files);

            foreach ($serviceFiles as $serviceFile) {
              unlink($serviceImagesDir . $serviceFile);
            }

            foreach ($_FILES['service-images']['tmp_name'] as $index => $tmp_name) {
              $imagePath = $serviceImagesDir . 'service-' . str_replace(' ', '_', strtolower($name)) . '-0' . ($index + 1) . '.jpg';
              if (move_uploaded_file($tmp_name, $imagePath)) {
                $serviceImages[] = $imagePath;
                var_dump($serviceImages);
              }
            }
          }

          $_SESSION['success'][] = 'Le service a été modifié avec succès';
          header('Location: ' . $_SERVER['PHP_SELF'] . '?modified=' . $serviceId);
          exit();
        } else {
          $_SESSION['errors'][] = 'Erreur lors de la modification du service';
        }
      }
    }
  }
}

require_once '../templates/aside-nav.php';
?>

<main class="dashboard__main">
  <h2 class="dashboard__title">Gestion des services</h2>
  <?php if (!isset($_GET['modified'])) { ?>
    <div class="dashboard__container">
      <div class="dashboard__card-wrapper">
        <h3 class="dashboard__card-title">Liste des services</h3>
        <ul class="dashboard__service-list">
          <?php foreach ($services as $service) { ?>
            <li class="dashboard__service-item">
              <h4 class="dashboard__service-title"><?= ucfirst($service['title']) ?></h4>
              <a class="dashboard__service-link" href="?modified=<?= $service['id'] ?>">Modifier</a>
              <div class="dashboard__service-separator"></div>
              <a class="dashboard__service-link" href="?delete=<?= $service['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?')">Supprimer</a>
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
  <?php } else { ?>
    <div class="dashboard__flex-container">
      <a href="<?= $backLink ?>" class="dashboard__backlink">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M14 7.45H3.32502L7.57502 3.125C7.80002 2.9 7.80002 2.55 7.57502 2.325C7.35002 2.1 7.00002 2.1 6.77502 2.325L1.60002 7.575C1.37502 7.8 1.37502 8.15 1.60002 8.375L6.77502 13.625C6.87502 13.725 7.02502 13.8 7.17502 13.8C7.32502 13.8 7.45002 13.75 7.57502 13.65C7.80002 13.425 7.80002 13.075 7.57502 12.85L3.35002 8.575H14C14.3 8.575 14.55 8.325 14.55 8.025C14.55 7.7 14.3 7.45 14 7.45Z" fill="#121212" />
        </svg>
        back
      </a>
      <div class="dashboard__card-wrapper">
        <h3 class="dashboard__card-title">Modifier un service</h3>
        <form method="post" class="dashboard__service-form" enctype="multipart/form-data">
          <label for="service-name" class="dashboard__account-label">
            Nom du service
            <input class="dashboard__account-input" type="text" name="service-name" id="service-name" value="<?= htmlentities(ucfirst($service['title'])) ?>" required>
          </label>
          <label for="service-about" class="dashboard__account-label">
            A propos du service
            <input class="dashboard__account-input" type="text" name="service-about" id="service-about" value="<?= htmlentities($service['about']) ?>" required>
          </label>
          <label for="service-content" class="dashboard__account-label">
            Description du service
            <textarea class="dashboard__service-textarea" name="service-content" id="service-content" required><?= htmlentities($service['content']) ?></textarea>
          </label>
          <label for="service-images" class="dashboard__account-label">
            <?php for ($i = 0; $i < 3; $i++) { ?>
              <div class="dashboard__input-container">
                <input class="dashboard__form-file" type="file" name="service-images[]" id="service-images" accept="image/*">
              </div>
            <?php } ?>
          </label>
          <input class="dashboard__account-submit" type="submit" value="Modifier le service" name="modifiedService">
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
  <?php } ?>
</main>
</body>

</html>