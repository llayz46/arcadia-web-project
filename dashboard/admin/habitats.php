<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/habitats.php';
require_once __DIR__ . '/../../lib/azure.php';

use MicrosoftAzure\Storage\Blob\Models\DeleteBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\CopyBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

if (isset($_GET['habitat-delete-id'])) {
  $habitatDeleteId = $_GET['habitat-delete-id'];
  $habitatToDelete = getHabitatById($pdo, $habitatDeleteId);

  if ($habitatDeleteId) {
    if (deleteHabitat($pdo, $habitatDeleteId)) {
      for ($i = 1; $i <= 3; $i++) {
        foreach (_ALLOWED_EXTENSIONS_ as $ext) {
          $blobName = 'habitats/habitat-' . str_replace(' ', '_', $habitatToDelete['title']) . '-0' . $i . '.' . $ext;

          try {
            $options = new DeleteBlobOptions();
            $blobClient->deleteBlob($containerName, $blobName, $options);
          } catch (ServiceException $e) {
          }
        }
      }

      $_SESSION['successHabitat'][] = 'L\'habitat a été supprimé avec succès';
      header('Location: habitats.php');
      exit;
    } else {
      $_SESSION['errorsHabitat'][] = 'Erreur lors de la suppression de l\'habitat';
    }
  } else {
    $_SESSION['errorsHabitat'][] = 'L\'habitat n\'existe pas';
  }
}

$habitats = getHabitats($pdo);

if (isset($_POST['createHabitat'])) {
  if (empty($_POST['habitat-name']) || empty($_POST['habitat-content']) || empty($_FILES['habitat-images'])) {
    $_SESSION['errorsHabitat'][] = 'Veuillez remplir tous les champs';
  } else {
    $res = createHabitat($pdo, $_POST['habitat-name'], $_POST['habitat-content']);

    if ($res) {
      $files = $_FILES['habitat-images'];

      if (count($files['name']) === 3) {
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
              if ($fileSize < 10000000) {
                $habitatName = strtolower(str_replace(' ', '_', $_POST['habitat-name']));
                $fileNameNew = 'habitat-' . $habitatName . '-0' . $i . '.' . $fileActualExt;
                $fileDestination = 'habitats/' . $fileNameNew;

                $content = fopen($fileTmpName, 'r');

                if ($content) {
                  $blobClient->createBlockBlob($containerName, $fileDestination, $content);
                  $i++;
                } else {
                  $_SESSION['errorsHabitat'][] = 'Erreur lors de l\'envoi de votre fichier';
                }
              } else {
                $_SESSION['errorsHabitat'][] = 'Votre fichier est trop volumineux';
              }
            } else {
              $_SESSION['errorsHabitat'][] = 'Erreur lors de l\'envoi de votre fichier';
            }
          } else {
            $_SESSION['errorsHabitat'][] = 'Vous ne pouvez pas envoyer ce type de fichier';
          }
        }
      }

      $_SESSION['successHabitat'][] = 'L\'habitat a été créé avec succès';
      header('Location: ' . $_SERVER['PHP_SELF']);
      exit();
    } else {
      $_SESSION['errorsHabitat'][] = 'Erreur lors de la création de l\'habitat';
    }
  }
}

if (isset($_GET['modified'])) {
  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'dashboard/admin/habitats.php';

  if (strpos($referer, 'dashboard/admin/habitats.php') !== false) {
    $backLink = 'habitats.php';
  } else {
    $backLink = 'habitats.php';
  }

  $habitatId = (int)$_GET['modified'];

  $habitat = getHabitatById($pdo, $habitatId);

  if (!$habitat) {
    $_SESSION['errorsHabitat'][] = 'L\'habitat n\'existe pas';
    header('Location: habitats.php');
    exit;
  }

  if (isset($_POST['modifiedHabitat'])) {

    if (empty($_POST['habitat-title']) || empty($_POST['habitat-content'])) {
      $_SESSION['errorsHabitat'][] = 'Veuillez remplir tous les champs';
    } else {
      $title = strtolower(htmlspecialchars(trim($_POST['habitat-title'])));
      $content = htmlspecialchars(trim($_POST['habitat-content']));

      if ($title === $habitat['title'] && $content === $habitat['content'] && empty($_FILES['habitat-images']['name'][0])) {
        $_SESSION['errorsHabitat'][] = 'Aucune modification n\'a été apportée';
      } else {
        if (updateHabitat($pdo, $habitatId, $title, $content)) {
          if ($title !== $habitat['title']) {
            for ($i = 1; $i <= 3; $i++) {
              $oldBlobName = '';
              foreach (_ALLOWED_EXTENSIONS_ as $ext) {
                $potentialBlobName = 'habitats/habitat-' . str_replace(' ', '_', strtolower($habitat['title'])) . '-0' . $i . '.' . $ext;
                try {
                  if ($blobClient->getBlob($containerName, $potentialBlobName)) {
                    $oldBlobName = $potentialBlobName;
                    break;
                  }
                } catch (ServiceException $e) {
                }
              }

              if ($oldBlobName !== '') {
                $newBlobName = 'habitats/habitat-' . str_replace(' ', '_', strtolower($title)) . '-0' . $i . '.' . $ext;

                try {
                  $optionsCopy = new CopyBlobOptions();
                  $blobClient->copyBlob($containerName, $newBlobName, $containerName, $oldBlobName, $optionsCopy);

                  if ($blobClient->getBlob($containerName, $newBlobName)) {
                    $optionsDelete = new DeleteBlobOptions();
                    $blobClient->deleteBlob($containerName, $oldBlobName, $optionsDelete);
                  }
                } catch (ServiceException $e) {
                }
              }
            }
          }

          $newImagesUploaded = !empty($_FILES['habitat-images']['tmp_name'][0]) && !empty($_FILES['habitat-images']['tmp_name'][1]) && !empty($_FILES['habitat-images']['tmp_name'][2]);
          if ($newImagesUploaded) {
            for ($i = 1; $i <= 3; $i++) {
              $oldBlobName = '';
              foreach (_ALLOWED_EXTENSIONS_ as $ext) {
                $potentialBlobName = 'habitats/habitat-' . str_replace(' ', '_', strtolower($habitat['title'])) . '-0' . $i . '.' . $ext;
                try {
                  if ($blobClient->getBlob($containerName, $potentialBlobName)) {
                    $oldBlobName = $potentialBlobName;
                    break;
                  }
                } catch (ServiceException $e) {
                }
              }

              if ($oldBlobName !== '') {
                try {
                  $options = new DeleteBlobOptions();
                  $blobClient->deleteBlob($containerName, $oldBlobName, $options);
                } catch (ServiceException $e) {
                }
              }

              $tmp_name = $_FILES['habitat-images']['tmp_name'][$i - 1];

              $ext = pathinfo($_FILES['habitat-images']['name'][$i - 1], PATHINFO_EXTENSION);
              $newBlobName = 'habitats/habitat-' . str_replace(' ', '_', $title) . '-0' . $i . '.' . $ext;

              try {
                $content = fopen($tmp_name, 'r');
                if ($content) {
                  $options = new CreateBlockBlobOptions();
                  $blobClient->createBlockBlob($containerName, $newBlobName, $content, $options);
                } else {
                  $_SESSION['errorsHabitat'][] = 'Erreur lors de l\'envoi de votre fichier';
                }
              } catch (ServiceException $e) {
              }
            }
          }

          $_SESSION['successHabitat'][] = 'L\'habitat a été modifié avec succès';
          header('Location: ' . $_SERVER['PHP_SELF'] . '?modified=' . $habitatId);
          exit();
        } else {
          $_SESSION['errorsHabitat'][] = 'Erreur lors de la modification de l\'habitatHabitat';
        }
      }
    }
  }
}

require_once '../templates/aside-nav.php';
?>

<main class="dashboard__main">
  <h2 class="dashboard__title">Gestion des habitats</h2>
  <?php if (!isset($_GET['modified'])) { ?>
    <div class="dashboard__container">
      <?php if (isset($_GET['note'])) { ?>
        <?php if ($habitats[$_GET['note']]['note'] !== null) { ?>
          <div class="dashboard__modal-container js-modal-container">
            <a href="habitats.php" class="dashboard__modal-overlay"></a>
            <div class="dashboard__modal">
              <a href="habitats.php" class="dashboard__modal-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                  <path d="M7.79222 6.99691L13.8329 0.958904C14.0557 0.736191 14.0557 0.389748 13.8329 0.167035C13.6101 -0.0556783 13.2635 -0.0556783 13.0407 0.167035L7 6.20504L0.959328 0.167035C0.736516 -0.0556783 0.38992 -0.0556783 0.167109 0.167035C-0.0557029 0.389748 -0.0557029 0.736191 0.167109 0.958904L6.20778 6.99691L0.167109 13.0349C-0.0557029 13.2576 -0.0557029 13.6041 0.167109 13.8268C0.266136 13.9258 0.414677 14 0.563218 14C0.71176 14 0.860301 13.9505 0.959328 13.8268L7 7.78878L13.0407 13.8268C13.1397 13.9258 13.2882 14 13.4368 14C13.5853 14 13.7339 13.9505 13.8329 13.8268C14.0557 13.6041 14.0557 13.2576 13.8329 13.0349L7.79222 6.99691Z" fill="#ffffff" />
                </svg>
              </a>
              <p class="dashboard__modal-title">Note :</p>
              <?php for ($i = 1; $i <= $habitats[$_GET['note']]['note']; $i++) { ?>
                <svg class="star--habitat" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" />
                </svg>
                <?php } ?>
              <p class="dashboard__modal-title"><?= ucfirst($habitats[$_GET['note']]['note_detail']) ?></p>
            </div>
          </div>
        <?php } else {
          header('Location: habitats.php');
        } ?>
      <?php } ?>
      <div class="dashboard__card-wrapper">
        <h3 class="dashboard__card-title">Liste des habitats</h3>
        <ul class="dashboard__habitat-list">
          <?php foreach ($habitats as $habitat) { ?>
            <li class="dashboard__habitat-item">
              <h4 class="dashboard__habitat-title"><?= ucfirst($habitat['title']) ?></h4>
              <a class="dashboard__habitat-link" href="?modified=<?= $habitat['id'] ?>">Modifier</a>
              <div class="dashboard__habitat-separator"></div>
              <a class="dashboard__habitat-link" href="?habitat-delete-id=<?= $habitat['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet habitat ?')">Supprimer</a>
              <?php if ($habitat['note'] !== null) { ?>
                <div class="dashboard__habitat-separator"></div>
                <a class="dashboard__habitat-link" href="?note=<?= $habitat['title'] ?>">Note</a>
              <?php } ?>
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
        <?php if (isset($_SESSION['errorsHabitat'])) { ?>
          <div class="dashboard__account-info">
            <?php foreach ($_SESSION['errorsHabitat'] as $error) { ?>
              <p class="dashboard__account-message dashboard__account-message--error"><?= $error ?></p>
            <?php } ?>
          </div>
          <?php unset($_SESSION['errorsHabitat']) ?>
        <?php } else if (isset($_SESSION['successHabitat'])) { ?>
          <div class="dashboard__account-info">
            <?php foreach ($_SESSION['successHabitat'] as $message) { ?>
              <p class="dashboard__account-message dashboard__account-message--success"><?= $message ?></p>
            <?php } ?>
          </div>
          <?php unset($_SESSION['successHabitat']) ?>
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
        <h3 class="dashboard__card-title">Modifier un habitat</h3>
        <form method="post" class="dashboard__habitat-form" enctype="multipart/form-data">
          <label for="habitat-title" class="dashboard__account-label">
            Nom de l'habitat
            <input class="dashboard__account-input" type="text" name="habitat-title" id="habitat-title" value="<?= ucfirst($habitat['title']) ?>" required>
          </label>
          <label for="habitat-content" class="dashboard__account-label">
            Description de l'habitat
            <textarea class="dashboard__habitat-textarea" name="habitat-content" id="habitat-content" required><?= $habitat['content'] ?></textarea>
          </label>
          <label for="habitat-images" class="dashboard__account-label">
            <input class="dashboard__form-file" type="file" name="habitat-images[]" id="habitat-images" accept="image/*">
            <input class="dashboard__form-file" type="file" name="habitat-images[]" id="habitat-images" accept="image/*">
            <input class="dashboard__form-file" type="file" name="habitat-images[]" id="habitat-images" accept="image/*">
          </label>
          <input class="dashboard__account-submit" type="submit" value="Modifier l'habitat" name="modifiedHabitat">
        </form>
        <?php if (isset($_SESSION['errorsHabitat'])) { ?>
          <div class="dashboard__account-info">
            <?php foreach ($_SESSION['errorsHabitat'] as $error) { ?>
              <p class="dashboard__account-message dashboard__account-message--error"><?= $error ?></p>
            <?php } ?>
          </div>
          <?php unset($_SESSION['errorsHabitat']) ?>
        <?php } else if (isset($_SESSION['successHabitat'])) { ?>
          <div class="dashboard__account-info">
            <?php foreach ($_SESSION['successHabitat'] as $message) { ?>
              <p class="dashboard__account-message dashboard__account-message--success"><?= $message ?></p>
            <?php } ?>
          </div>
          <?php unset($_SESSION['successHabitat']) ?>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
</main>
</body>

</html>