<?php

require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/habitats.php';

$errors = [];
$success = [];

if (isset($_GET['habitat-delete-id'])) {
  $habitatDeleteId = $_GET['habitat-delete-id'];
  $habitatToDelete = getHabitatById($pdo, $habitatDeleteId);

  if ($habitatDeleteId) {
    if (deleteHabitat($pdo, $habitatDeleteId)) {
      for ($i = 1; $i <= 3; $i++) {
        foreach (_ALLOWED_EXTENSIONS_ as $ext) {
          $file = '../..' . _PATH_UPLOADS_ . 'habitats/habitat-' . $habitatToDelete['title'] . '-0' . $i . '.' . $ext;
          if (file_exists($file)) {
            unlink($file);
          }
        }
      }
      $success[] = 'L\'habitat a été supprimé avec succès';
    } else {
      $errors[] = 'Erreur lors de la suppression de l\'habitat';
    }
  } else {
    $errors[] = 'L\'habitat n\'existe pas';
  }
}

$habitats = getHabitats($pdo);

if (isset($_POST['createHabitat'])) {
  if (empty($_POST['habitat-name']) || empty($_POST['habitat-content']) || empty($_FILES['habitat-images'])) {
    $errors[] = 'Veuillez remplir tous les champs';
  } else {
    $res = createHabitat($pdo, $_POST['habitat-name'], $_POST['habitat-content']);

    if ($res) {
      $files = $_FILES['habitat-images'];

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
              $fileNameNew = 'habitat-' . $_POST['habitat-name'] . '-0' . $i . '.' . $fileActualExt;
              $fileDestination = '../..' . _PATH_UPLOADS_ . 'habitats/' . $fileNameNew;
              move_uploaded_file($fileTmpName, $fileDestination);
              $i++;
            } else {
              $errors[] = 'Votre fichier est trop volumineux';
            }
          } else {
            $errors[] = 'Erreur lors de l\'envoi de votre fichier';
          }
        } else {
          $errors[] = 'Vous ne pouvez pas envoyer ce type de fichier';
        }
      }

      header('Refresh: 0');
      $success[] = 'L\'habitat a été créé avec succès';
    } else {
      $errors[] = 'Erreur lors de la création de l\'habitat';
    }
  }
}

require_once 'templates/aside-nav.php';
?>

<main class="dashboard__main">
  <h2 class="dashboard__title">Gestion des habitats</h2>
  <div class="dashboard__container">
    <div class="dashboard__card-wrapper">
      <h3 class="dashboard__card-title">Liste des habitats</h3>
      <ul class="dashboard__habitat-list">
        <?php foreach ($habitats as $habitat) { ?>
          <li class="dashboard__habitat-item">
            <h4 class="dashboard__habitat-title"><?= ucfirst($habitat['title']) ?></h4>
            <a class="dashboard__habitat-link" href="">Modifier</a>
            <div class="dashboard__habitat-separator"></div>
            <a class="dashboard__habitat-link" href="?habitat-delete-id=<?= $habitat['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet habitat ?')">Supprimer</a>
          </li>
        <?php } ?>
      </ul>
    </div>
    <div class="dashboard__card-wrapper">
      <h3 class="dashboard__card-title">Ajouter un habitat</h3>
      <form method="post" class="dashboard__habitat-form" enctype="multipart/form-data">
        <label for="habitat-name" class="dashboard__account-label">
          Nom de l'habitat
          <input class="dashboard__account-input" type="text" name="habitat-name" id="habitat-name" required>
        </label>
        <label for="habitat-content" class="dashboard__account-label">
          Description de l'habitat
          <textarea class="dashboard__habitat-textarea" name="habitat-content" id="habitat-content" required></textarea>
        </label>
        <label for="habitat-images" class="dashboard__account-label">
          <input class="dashboard__form-file" type="file" name="habitat-images[]" id="habitat-images" accept="image/*" required>
          <input class="dashboard__form-file" type="file" name="habitat-images[]" id="habitat-images" accept="image/*" required>
          <input class="dashboard__form-file" type="file" name="habitat-images[]" id="habitat-images" accept="image/*" required>
        </label>
        <input class="dashboard__account-submit" type="submit" value="Créer l'habitat" name="createHabitat">
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