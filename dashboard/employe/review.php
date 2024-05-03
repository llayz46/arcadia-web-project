<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/pdo.php';
require_once __DIR__ . '/../../lib/reviews.php';

$pendingReviews = getReviews($pdo, 'pending');
$totalPendingReviews = count($pendingReviews);

$validateReviews = getReviews($pdo, 'published');
$totalValidateReviews = count($validateReviews);

if (isset($_POST['review_id'])) {
  $reviewId = $_POST['review_id'];

  if (isset($_POST['review_rejected'])) {
    setReviewStatus($pdo, $reviewId, 'rejected');
    $_SESSION['success'][] = 'L\'avis a bien été rejeté';
  } else if (isset($_POST['review_published'])) {
    setReviewStatus($pdo, $reviewId, 'published');
    $_SESSION['success'][] = 'L\'avis a bien été validé';
  } else {
    $_SESSION['errors'][] = 'Erreur lors de la vérification de l\'avis';
  }

  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}

require_once '../templates/aside-nav.php';
?>

<main class="dashboard__main">
  <h2 class="dashboard__title">Gestion des avis utilisateurs</h2>
  <?php if ($totalPendingReviews > 0) { ?>
  <div class="dashboard__card-wrapper dashboard__card-wrapper--review">
    <h3 class="dashboard__card-title">Liste des avis en attente de vérification</h3>
    <ul class="dashboard__review-list">
      <?php foreach ($pendingReviews as $review) { ?>
        <li class="dashboard__review-wrapper">
          <div class="dashboard__review-item">
            <div class="dashboard__review-text-container">
              <h4 class="review-name"><?= ucfirst($review['nickname']) ?></h4>
              <p class="review-content">"<?= $review['content'] ?>"</p>
            </div>
            <div class="review-note-container">
              <div class="review-stars-container">
                <?php for ($i = 0; $i < $review['note']; $i++) { ?>
                  <svg class="review-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                <?php } ?>
              </div>
              <?php
                $note = getReviewHapinness($review['note']);
                echo $note;
              ?>
            </div>
          </div>
          <form class="dashboard__review-buttons" method="post">
            <input type="hidden" name="review_id" value="<?= $review['id'] ?>">
            <input class="review-button review-button--valid" type="submit" name="review_published" value="Validé l'avis">
            <input class="review-button review-button--reject" type="submit" name="review_rejected" value="Rejeté l'avis">
          </form>
        </li>
      <?php } ?>
    </ul>
  </div>
  <?php } ?>
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
  <?php if ($totalValidateReviews > 0) { ?>
  <div class="dashboard__card-wrapper dashboard__card-wrapper--review">
    <h3 class="dashboard__card-title">Liste des avis validé</h3>
    <ul class="dashboard__review-list">
      <?php foreach ($validateReviews as $review) { ?>
        <li class="dashboard__review-wrapper">
          <div class="dashboard__review-item">
            <div class="dashboard__review-text-container">
              <h4 class="review-name"><?= ucfirst($review['nickname']) ?></h4>
              <p class="review-content">"<?= $review['content'] ?>"</p>
            </div>
            <div class="review-note-container">
              <div class="review-stars-container">
                <?php for ($i = 0; $i < $review['note']; $i++) { ?>
                  <svg class="review-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                <?php } ?>
              </div>
              <?php
                $note = getReviewHapinness($review['note']);
                echo $note;
              ?>
            </div>
          </div>
          <form class="dashboard__review-buttons" method="post">
            <input type="hidden" name="review_id" value="<?= $review['id'] ?>">
            <input class="review-button review-one-button review-button--reject" type="submit" name="review_rejected" value="Rejeté l'avis">
          </form>
        </li>
      <?php } ?>
    </ul>
  </div>
  <?php } ?>
</main>
</body>

</html>