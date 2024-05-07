<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/animals.php';
require_once __DIR__ . '/../../lib/habitats.php';

$habitats = getHabitats($pdo);
$animals = getAnimalsAndBreed($pdo);
$breeds = getBreeds($pdo);

if (isset($_GET['animal-delete-id'])) {
  $animalDeleteId = $_GET['animal-delete-id'];
  $animalToDelete = getAnimalById($pdo, $animalDeleteId);

  if ($animalDeleteId) {
    if (deleteAnimal($pdo, $animalDeleteId)) {
      foreach (_ALLOWED_EXTENSIONS_ as $ext) {
        $file = '../..' . _PATH_UPLOADS_ . 'animals/animal-' . str_replace(' ', '_', $animalToDelete['name']) . '.' . $ext;
        if (file_exists($file)) {
          unlink($file);
        }
      }

      $_SESSION['success'][] = 'L\'animal a été supprimé avec succès';

      header('Location: animals.php');
      exit();
    } else {
      $_SESSION['errors'][] = 'Erreur lors de la suppression de l\'animal';
    }
  } else {
    $_SESSION['errors'][] = 'L\'animal n\'existe pas';
  }
}

function mb_ucfirst($string, $encoding = 'UTF-8') {
  $firstChar = mb_substr($string, 0, 1, $encoding);
  $rest = mb_substr($string, 1, mb_strlen($string, $encoding), $encoding);
  return mb_strtoupper($firstChar, $encoding) . $rest;
}

if (isset($_POST['createAnimal'])) {
  if (empty($_POST['animal-name']) || empty($_POST['animal-habitat']) || empty($_POST['animal-breed'])) {
    $_SESSION['errors'][] = 'Veuillez remplir tous les champs';
  } else {
    $name = $_POST['animal-name'];

    $res = addAnimal($pdo, $name, $_POST['animal-habitat'], $_POST['animal-breed']);

    if ($res) {
      $file = $_FILES['animal-image'];

      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];
      $fileType = $file['type'];

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));

      $allowed = _ALLOWED_EXTENSIONS_;

      if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
          if ($fileSize < 1000000) {
            $animalName = strtolower(str_replace(' ', '_', $_POST['animal-name']));
            $fileNameNew = 'animal-' . $animalName . '.' . $fileActualExt;
            $fileDestination = '../..' . _PATH_UPLOADS_ . 'animals/' . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
          } else {
            $_SESSION['errors'][] = 'Votre fichier est trop volumineux';
          }
        } else {
          $_SESSION['errors'][] = 'Erreur lors de l\'envoi de votre fichier';
        }
      } else {
        $_SESSION['errors'][] = 'Vous ne pouvez pas envoyer ce type de fichier';
      }

      $_SESSION['success'][] = 'L\'animal a bien été ajouté';
      header('Location: ' . $_SERVER['PHP_SELF']);
      exit();
    } else {
      $_SESSION['errors'][] = 'Une erreur est survenue lors de l\'ajout de l\'animal';
    }
  }
}

if (isset($_GET['modified'])) {
  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'dashboard/admin/animals.php';

  if (strpos($referer, 'dashboard/admin/animals.php') !== false) {
    $backLink = 'animals.php';
  } else {
    $backLink = 'animals.php';
  }

  $animalId = (int)$_GET['modified'];

  $animal = getAnimalById($pdo, $animalId);

  if (!$animal) {
    $_SESSION['errors'][] = 'L\'animal n\'existe pas';
    header('Location: animals.php');
    exit;
  }

  if (isset($_POST['modifiedAnimal'])) {

    if (empty($_POST['animal-name']) || empty($_POST['animal-habitat']) || empty($_POST['animal-breed'])) {
      $_SESSION['errors'][] = 'Veuillez remplir tous les champs';
    } else {
      $name = htmlspecialchars(trim($_POST['animal-name']));

      if ($name === $animal['name'] && $_POST['animal-habitat'] === $animal['habitat_id'] && $_POST['animal-breed'] === $animal['breed_id']) {
        $_SESSION['errors'][] = 'Aucune modification n\'a été apportée';
      } else {
        if (updateAnimal($pdo, $animalId, $name, $_POST['animal-habitat'], $_POST['animal-breed'])) {
          if ($name !== $animal['name']) {
            foreach (_ALLOWED_EXTENSIONS_ as $ext) {
              $file = '../..' . _PATH_UPLOADS_ . 'animals/animal-' . str_replace(' ', '_', strtolower($animal['name'])) . '.' . $ext;
              if (file_exists($file)) {
                $newFile = '../..' . _PATH_UPLOADS_ . 'animals/animal-' . str_replace(' ', '_', strtolower($name)) . '.' . $ext;
                rename($file, $newFile);
              }
            }
          }

          if (!empty($_FILES['animal-image']['tmp_name'])){
            $animalImagesDir = '../..' . _PATH_UPLOADS_ . 'animals/';
            $animalFile = '/animal-' . str_replace(' ', '_', strtolower($name)) . '.jpg';

            if (file_exists($animalImagesDir . $animalFile)) {
              unlink($animalImagesDir . $animalFile);
            }

            $tmp_name = $_FILES['animal-image']['tmp_name'];
            $imagePath = $animalImagesDir . $animalFile;
            move_uploaded_file($tmp_name, $imagePath);
          }

          $_SESSION['success'][] = 'L\'animal a été modifié avec succès';
          header('Location: ' . $_SERVER['PHP_SELF'] . '?modified=' . $animalId);
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
  <h2 class="dashboard__title">Gestion des animaux</h2>
  <?php if (!isset($_GET['modified'])) { ?>
    <div class="dashboard__container">
      <div class="dashboard__card-wrapper">
        <h3 class="dashboard__card-title">Liste des animaux</h3>
        <ul class="dashboard__animal-list">
          <?php foreach ($animals as $animal) { ?>
            <li class="dashboard__animal-item">
              <h4 class="dashboard__animal-name"><?= mb_ucfirst($animal['animal_name']) ?></h4>
              <a class="dashboard__animal-link" href="?modified=<?= $animal['animal_id'] ?>">Modifier</a>
              <div class="dashboard__animal-separator"></div>
              <a class="dashboard__animal-link" href="?animal-delete-id=<?= $animal['animal_id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?')">Supprimer</a>
            </li>
          <?php } ?>
        </ul>
      </div>
      <div class="dashboard__card-wrapper">
        <h3 class="dashboard__card-title">Ajouter un animal</h3>
        <form method="post" class="dashboard__animal-form" enctype="multipart/form-data">
          <label for="animal-name" class="dashboard__account-label">
            Nom de l'animal
            <input class="dashboard__account-input" type="text" name="animal-name" id="animal-name" required>
          </label>
          <label for="animal-habitat" class="dashboard__account-label">
            Habitat de l'animal
            <div class="dashboard__list-wrapper">
              <?php foreach ($habitats as $habitat) { ?>
                <div class="dashboard__list">
                  <input type="radio" name="animal-habitat" id="animal-habitat-<?= $habitat['title'] ?>" value="<?= $habitat['title'] ?>">
                  <p><?= ucfirst($habitat['title']) ?></p>
                </div>
              <?php } ?>
            </div>
          </label>
          <label for="animal-breed" class="dashboard__account-label">
            Race de l'animal
            <div class="dashboard__list-wrapper">
              <?php foreach ($breeds as $breed) { ?>
                <div class="dashboard__list">
                  <input type="radio" name="animal-breed" id="animal-breed-<?= $breed['name'] ?>" value="<?= $breed['name'] ?>">
                  <p><?= mb_ucfirst($breed['name']) ?></p>
                </div>
              <?php } ?>
            </div>
          </label>
          <label for="animal-image" class="dashboard__account-label">
            Image de l'animal
            <input class="dashboard__form-file" type="file" name="animal-image" id="animal-image" accept="image/*" required>
          </label>
          <input class="dashboard__account-submit" type="submit" value="Créer l'animal" name="createAnimal">
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
        <h3 class="dashboard__card-title">Modifier un animal</h3>
        <form method="post" class="dashboard__animal-form" enctype="multipart/form-data">
          <label for="animal-name" class="dashboard__account-label">
            Nom de l'animal
            <input class="dashboard__account-input" type="text" name="animal-name" id="animal-name" value="<?= ucfirst($animal['name']) ?>" required>
          </label>
          <label for="animal-habitat" class="dashboard__account-label">
            Habitat de l'animal
            <div class="dashboard__list-wrapper">
              <?php foreach ($habitats as $habitat) { ?>
                <div class="dashboard__list">
                  <input type="radio" name="animal-habitat" <?php if ($habitat['id'] === $animal['habitat_id']) { echo 'checked'; } ?> id="animal-habitat-<?= $habitat['title'] ?>" value="<?= $habitat['id'] ?>">
                  <p><?= ucfirst($habitat['title']) ?></p>
                </div>
              <?php } ?>
            </div>
          </label>
          <label for="animal-breed" class="dashboard__account-label">
            Race de l'animal
            <div class="dashboard__list-wrapper">
              <?php foreach ($breeds as $breed) { ?>
                <div class="dashboard__list">
                  <input type="radio" name="animal-breed" <?php if ($breed['id'] === $animal['breed_id']) { echo 'checked'; } ?> id="animal-breed-<?= $breed['name'] ?>" value="<?= $breed['id'] ?>">
                  <p><?= mb_ucfirst($breed['name']) ?></p>
                </div>
              <?php } ?>
            </div>
          </label>
          <label for="animal-image" class="dashboard__account-label">
            <div class="dashboard__input-container">
              <input class="dashboard__form-file" type="file" name="animal-image" id="animal-image" accept="image/jpeg">
            </div>
          </label>
          <input class="dashboard__account-submit" type="submit" value="Modifier l'animal" name="modifiedAnimal">
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