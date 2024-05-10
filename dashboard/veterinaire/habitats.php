<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/habitats.php';

if (isset($_GET['notation-id'])) {
  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'dashboard/veterinaire/habitats.php';

  if (strpos($referer, 'dashboard/veterinaire/habitats.php') !== false) {
    $backLink = 'habitats.php';
  } else {
    $backLink = 'habitats.php';
  }

  $habitatId = $_GET['notation-id'];

  if ($habitatId) {
    if(isset($_POST['noteHabitat'])) {
      $habitatNote = $_POST['habitat-review'];
      $habitatNoteStars = (int)$_POST['star_rating'];

      if ($habitatNoteStars < 1 || $habitatNoteStars > 5 && isset($habitatNote)) {
        $_SESSION['errors'][] = 'Veuillez remplir tous les champs';
      }
      if (noteHabitat($pdo, $habitatId, $habitatNote, $habitatNoteStars)) {
        $_SESSION['success'][] = 'L\'habitat a bien été noté';
        header('Location: habitats.php');
        exit;
      } else {
        $_SESSION['errors'][] = 'Erreur lors de la notation de l\'habitat';
      }
    }
  } else {
    $_SESSION['errors'][] = 'L\'habitat n\'existe pas';
  }
}

$habitats = getHabitats($pdo);

require_once '../templates/aside-nav.php';
?>
<main class="dashboard__main">
  <h2 class="dashboard__title">Gestion des habitats</h2>
  <?php if (!isset($_GET['notation-id'])) { ?>
    <div class="dashboard__container">
      <div class="dashboard__card-wrapper">
        <h3 class="dashboard__card-title">Liste des habitats</h3>
        <ul class="dashboard__habitat-list">
          <?php foreach ($habitats as $habitat) { ?>
            <li class="dashboard__habitat-item">
              <h4 class="dashboard__habitat-title"><?= ucfirst($habitat['title']) ?></h4>
              <a class="dashboard__habitat-link" href="../../habitat.php?habitat=<?= $habitat['title'] ?>">Voir l'habitat</a>
              <div class="dashboard__habitat-separator"></div>
              <a class="dashboard__habitat-link" href="?notation-id=<?= $habitat['id'] ?>">Noter l'habitat</a>
            </li>
          <?php } ?>
        </ul>
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
        <h3 class="dashboard__card-title">Noter un habitat</h3>
        <form method="post" class="dashboard__habitat-form" enctype="multipart/form-data">
          <label for="habitat-review" class="dashboard__account-label">
            Exprimez votre avis
            <textarea class="dashboard__habitat-textarea" name="habitat-review" id="habitat-review" required></textarea>
          </label>
          <label for="habitat-note" class="dashboard__account-label">
            <div class="star__container">
              <svg class="star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" />
              </svg>
              <svg class="star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" />
              </svg>
              <svg class="star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" />
              </svg>
              <svg class="star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" />
              </svg>
              <svg class="star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" />
              </svg>
            </div>
          </label>
          <input type="hidden" name="star_rating" id="star_rating" value="0" required>
          <input class="dashboard__account-submit" type="submit" value="Noter l'habitat" name="noteHabitat">
        </form>
      </div>
    </div>
  <?php } ?>
</main>
<script src="../../assets/scripts/reviewNotation.js"></script>
</body>

</html>