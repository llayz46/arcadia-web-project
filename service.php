<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/services.php';

$services = getServices($pdo);

$totalServices = count($services);

$currentService = null;

$servicesNumber = 1;

if (isset($_GET['service'])) {
  if (!empty($_GET['service'])) {
    if (array_key_exists($_GET['service'], $services)) {
      $currentService = $_GET['service'];
    } else {
      header('Location: /service.php?service=' . array_keys($services)[0]);
    }
  } else {
    header('Location: /service.php?service=' . array_keys($services)[0]);
  }
} else {
  header('Location: /service.php?service=' . array_keys($services)[0]);
}

require_once __DIR__ . '/templates/header.php';
?>

<!-- START : main -->
<main class="service-main">
  <nav class="service__nav-number">
    <ul class="service__num-list">
      <?php foreach ($services as $key => $service) { ?>
        <li class="service__num-item js-content <?php if($currentService === $key) { echo 'active'; } ?>">
          <a href="service.php?service=<?=$key?>" class="service__num-link <?php if($key === $currentService) { echo 'active'; } ?>"><?= '0'. $servicesNumber;?></a>
        </li>
      <?php $servicesNumber++; } ?>
    </ul>
  </nav>
  <div class="service__content">
    <nav class="service__nav-mobile">
      <ul class="service__mobile-list">
        <?php foreach ($services as $key => $service) { ?>
          <li class="service__mobile-item <?php if($key === $currentService) { echo 'active'; } ?>">
            <a href="service.php?service=<?=$key?>" class="service__mobile-link"><?= ucfirst($service['title']) ?></a>
          </li>
        <?php } ?>
      </ul>
    </nav>
    <h1 class="service__title js-service-title"><?= ucfirst($services[$currentService]['title']) ?></h1>
    <p class="service__about"><?= ucfirst($services[$currentService]['about']) ?></p>
    <p class="service__text js-service-content"><?= $services[$currentService]['content'] ?></p>
    <div class="service__bottom-nav js-line-parent">
      <h3 class="service__left">01</h3>
      <div class="service__line js-line"></div>
      <h3 class="service__right">03</h3>
    </div>
  </div>
  <nav class="service__nav-image">
    <ul class="service__img-list">
      <li class="service__img-item">
        <div class="service__img-images active js-service-images"></div>
        <button class="service__img-icon-wrapper active js-service-icon">
          <svg class="service__img-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M13.4686 6.49175H7.53135V0.531353C7.53135 0.254125 7.30033 0 7 0C6.72277 0 6.46865 0.231023 6.46865 0.531353V6.49175H0.531353C0.254125 6.49175 0 6.72277 0 7.0231C0 7.30033 0.231023 7.55446 0.531353 7.55446H6.49175V13.4686C6.49175 13.7459 6.72277 14 7.0231 14C7.30033 14 7.55446 13.769 7.55446 13.4686V7.53135H13.4686C13.7459 7.53135 14 7.30033 14 7C14 6.72277 13.7459 6.49175 13.4686 6.49175Z" fill="white" />
          </svg>
        </button>
      </li>
      <li class="service__img-item">
        <div class="service__img-images js-service-images"></div>
        <button class="service__img-icon-wrapper js-service-icon">
          <svg class="service__img-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M13.4686 6.49175H7.53135V0.531353C7.53135 0.254125 7.30033 0 7 0C6.72277 0 6.46865 0.231023 6.46865 0.531353V6.49175H0.531353C0.254125 6.49175 0 6.72277 0 7.0231C0 7.30033 0.231023 7.55446 0.531353 7.55446H6.49175V13.4686C6.49175 13.7459 6.72277 14 7.0231 14C7.30033 14 7.55446 13.769 7.55446 13.4686V7.53135H13.4686C13.7459 7.53135 14 7.30033 14 7C14 6.72277 13.7459 6.49175 13.4686 6.49175Z" fill="white" />
          </svg>
        </button>
      </li>
      <li class="service__img-item">
        <div class="service__img-images js-service-images"></div>
        <button class="service__img-icon-wrapper js-service-icon">
          <svg class="service__img-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M13.4686 6.49175H7.53135V0.531353C7.53135 0.254125 7.30033 0 7 0C6.72277 0 6.46865 0.231023 6.46865 0.531353V6.49175H0.531353C0.254125 6.49175 0 6.72277 0 7.0231C0 7.30033 0.231023 7.55446 0.531353 7.55446H6.49175V13.4686C6.49175 13.7459 6.72277 14 7.0231 14C7.30033 14 7.55446 13.769 7.55446 13.4686V7.53135H13.4686C13.7459 7.53135 14 7.30033 14 7C14 6.72277 13.7459 6.49175 13.4686 6.49175Z" fill="white" />
          </svg>
        </button>
      </li>
    </ul>
  </nav>
</main>
<!-- END : main -->

<!-- START : script -->
<script src="/assets/scripts/nav.js"></script>
<script src="/assets/scripts/loading.js"></script>
<!-- END : script -->
</body>

</html>