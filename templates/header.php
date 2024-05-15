<?php
require_once __DIR__ . '/../lib/config.php';
require_once __DIR__ . '/../lib/session.php';
require_once __DIR__ . '/../lib/menu.php';

$currentPage = basename($_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $mainMenu[$currentPage]['head_title'] ?> - Arcadia</title>
  <link rel="shortcut icon" href="../assets/images/arcadia-favicon.svg" type="image/x-icon">
  <link rel="stylesheet" href="./node_modules/@splidejs/splide/dist/css/splide.min.css">
  <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body class="<?php if($currentPage === 'service.php') { echo 'js-service-body service-';} else if($currentPage === 'habitat.php') { echo 'js-habitats-body habitats-';} else if($currentPage === 'animal.php') { echo 'animal-'; } ?>body">
  <!-- START : header -->
  <header class="<?php if($currentPage === 'service.php') { echo 'service-header ';} else if($currentPage === 'habitat.php') { echo 'habitats-header ';} ?>header flux">
    <a class="header__logo" href="./index.php">Arcadia</a>
    <nav class="header__nav">
      <ul class="header__list">
        <?php foreach($mainMenu as $key => $menuItem) { 
          if (array_key_exists('role', $menuItem)) { ?>
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['name'] === $menuItem['role']) { ?>
              <li class="header__item">
                <a href="<?=$key?>" class="header__link <?php if($currentPage === $key) { echo 'active'; } ?>"><?=$menuItem['menu_title']?></a>
              </li>
            <?php } ?>
        <?php } else if(!array_key_exists('exclude', $menuItem) && !array_key_exists('role', $menuItem)) { ?>
          <li class="header__item">
            <a href="<?=$key?>" class="header__link <?php if($currentPage === $key) { echo 'active'; } ?>"><?=$menuItem['menu_title']?></a>
          </li>
        <?php } } ?>
      </ul>
    </nav>
    <?php if (isset($_SESSION['user'])) { ?>
      <a href="/logout.php" class="header__login button-<?php if($currentPage === 'service.php' || $currentPage === 'habitat.php' || $currentPage === 'animal.php') { echo 'light';} else { echo 'dark'; } ?>">Déconnexion</a>
    <?php } else { ?>
      <a href="/login.php" class="header__login button-<?php if($currentPage === 'service.php' || $currentPage === 'habitat.php' || $currentPage === 'animal.php') { echo 'light';} else { echo 'dark'; } ?>">Connexion</a>
    <?php } ?>
    <svg class="header__burger js-header-burger" xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 24 16" fill="none">
      <path d="M23.0897 6.81189H11.7234C11.2481 6.81189 10.8125 7.20793 10.8125 7.72278C10.8125 8.19803 11.2085 8.63367 11.7234 8.63367H23.0897C23.565 8.63367 24.0006 8.23763 24.0006 7.72278C24.0006 7.20793 23.565 6.81189 23.0897 6.81189Z" fill="white" />
      <path d="M23.0891 13.5446H0.910891C0.435644 13.5446 0 13.9406 0 14.4554C0 14.9703 0.39604 15.3663 0.910891 15.3663H23.0891C23.5644 15.3663 24 14.9703 24 14.4554C24 13.9406 23.5644 13.5446 23.0891 13.5446Z" fill="white" />
      <path d="M0.910891 1.82178H23.0891C23.5644 1.82178 24 1.42574 24 0.910891C24 0.396039 23.604 0 23.0891 0H0.910891C0.435644 0 0 0.396039 0 0.910891C0 1.42574 0.435644 1.82178 0.910891 1.82178Z" fill="white" />
    </svg>
    <nav class="header__nav-mobile js-header-mobile-nav">
      <ul class="header__list-mobile">
        <?php foreach($mainMenu as $key => $menuItem) { 
          if(!array_key_exists('exclude', $menuItem)) { ?>
            <li class="header__mobile-item <?php if($currentPage === $key) { echo 'active'; } ?>">
              <a href="<?=$key?>" class="header__mobile-link <?php if($currentPage === $key) { echo 'active'; } ?>"><?=$menuItem['menu_title']?></a>
            </li>
          <?php } 
        } ?>
      </ul>
    </nav>
  </header>
  <!-- END : header -->