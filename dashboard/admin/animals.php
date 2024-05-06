<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/animals.php';
require_once __DIR__ . '/../../lib/habitats.php';

$habitats = getHabitats($pdo);
$animals = getAnimals($pdo);

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
  if (empty($_POST['animal-name']) || empty($_POST['animal-habitat'])) {
    $_SESSION['errors'][] = 'Veuillez remplir tous les champs';
  } else {
    $name = $_POST['animal-name'];

    $res = addAnimal($pdo, $name, $_POST['animal-habitat']);

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
            $serviceName = strtolower(str_replace(' ', '_', $_POST['service-name']));
            $fileNameNew = 'animal-' . $name . '.' . $fileActualExt;
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

require_once '../templates/aside-nav.php';
?>

<main class="dashboard__main">
  <h2 class="dashboard__title">Gestion des animaux</h2>
  <div class="dashboard__container">
    <div class="dashboard__card-wrapper">
      <h3 class="dashboard__card-title">Liste des animaux</h3>
      <ul class="dashboard__animal-list">
        <?php foreach ($animals as $animal) { ?>
          <li class="dashboard__animal-item">
            <h4 class="dashboard__animal-title"><?= mb_ucfirst($animal['name']) ?></h4>
            <a class="dashboard__animal-link" href="">Modifier</a>
            <div class="dashboard__animal-separator"></div>
            <a class="dashboard__animal-link" href="?animal-delete-id=<?= $animal['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?')">Supprimer</a>
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
</main>

</body>

</html>