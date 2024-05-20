<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/habitats.php';

$habitats = getHabitats($pdo);

$totalHabitats = count($habitats);

$currentHabitat = null;

$habitatsNumber = 1;

if (isset($_GET['habitat'])) {
  if (!empty($_GET['habitat'])) {
    if (array_key_exists($_GET['habitat'], $habitats)) {
      $currentHabitat = $_GET['habitat'];
    } else {
      header('Location: /habitat.php?habitat=' . array_keys($habitats)[0]);
    }
  } else {
    header('Location: /habitat.php?habitat=' . array_keys($habitats)[0]);
  }
} else {
  header('Location: /habitat.php?habitat=' . array_keys($habitats)[0]);
}

require_once __DIR__ . '/templates/header.php';
?>

<!-- START : main -->
<main class="habitats-main">
  <nav class="habitats__nav-number">
    <ul class="habitats__num-list">
      <?php foreach ($habitats as $key => $habitat) { ?>
        <li class="habitats__num-item js-content <?php if ($currentHabitat === $key) {
                                                    echo 'active';
                                                  } ?>">
          <a href="habitat.php?habitat=<?= $key ?>" class="habitats__num-link <?php if ($key === $currentHabitat) {
                                                                              echo 'active';
                                                                            } ?>"><?= '0' . $habitatsNumber; ?></a>
        </li>
      <?php $habitatsNumber++;
      } ?>
    </ul>
  </nav>

  <div class="habitats__content">
    <nav class="habitats__nav-mobile">
      <ul class="habitats__mobile-list">
        <?php foreach ($habitats as $key => $habitat) { ?>
          <li class="habitats__mobile-item <?php if ($key === $currentHabitat) { echo 'active'; } ?>">
            <a href="habitat.php?habitat=<?= $key ?>" class="habitats__mobile-link <?php if($key === $currentHabitat) { echo 'active'; } ?>"><?= ucfirst($habitat['title']) ?></a>
          </li>
        <?php } ?>
      </ul>
    </nav>

    <div class="habitats__wrapper">
      <div class="habitats__container-text">
        <h1 class="habitats__title js-habitats-title"><?= ucfirst($habitats[$currentHabitat]['title']) ?></h1>
        <p class="habitats__about">À propos</p>
        <p class="habitats__text js-habitats-content"><?= $habitats[$currentHabitat]['content'] ?></p>
        <a href="animal.php?habitat=<?= strtolower($habitats[$currentHabitat]['title']) ?>" class="habitats__button button-accent">Les animaux</a>
        <div class="habitats__bottom-nav js-line-parent">
          <h3 class="habitats__left">01</h3>
          <div class="habitats__line js-line"></div>
          <h3 class="habitats__right"><?= '0' . $totalHabitats ?></h3>
        </div>
      </div>
      <nav class="habitats__nav-image">
        <ul class="habitats__img-list">
          <?php for ($i = 1; $i <= 3; $i++) { ?>
            <li class="habitats__img-item">
              <div class="habitats__img-images <?php if ($i === 1) { echo 'active'; } ?> js-habitats-images"></div>
              <button class="habitats__img-icon-wrapper <?php if ($i === 1) { echo 'active'; } ?> js-habitats-icon">
                <svg class="habitats__img-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                  <path d="M13.4686 6.49175H7.53135V0.531353C7.53135 0.254125 7.30033 0 7 0C6.72277 0 6.46865 0.231023 6.46865 0.531353V6.49175H0.531353C0.254125 6.49175 0 6.72277 0 7.0231C0 7.30033 0.231023 7.55446 0.531353 7.55446H6.49175V13.4686C6.49175 13.7459 6.72277 14 7.0231 14C7.30033 14 7.55446 13.769 7.55446 13.4686V7.53135H13.4686C13.7459 7.53135 14 7.30033 14 7C14 6.72277 13.7459 6.49175 13.4686 6.49175Z" fill="white" />
                </svg>
              </button>
            </li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</main>
<!-- END : main -->

<!-- START : script -->
<script src="/assets/scripts/nav.js"></script>
<script src="/assets/scripts/loading.js"></script>
<!-- END : script -->
</body>

</html>