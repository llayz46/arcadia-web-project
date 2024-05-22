<?php
require_once __DIR__ . '/../../lib/config.php';
require_once __DIR__ . '/../../lib/session.php';
require_once __DIR__ . '/../../lib/menu.php';

$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
$role = basename(dirname($_SERVER['SCRIPT_NAME']));

roleOnly($role);

$menu = $role . 'Menu';
?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$$menu[$currentPage]['head_title']?></title>
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="shortcut icon" href="../../assets/images/arcadia-favicon.svg" type="image/x-icon">
</head>

<body class="dashboard__body">
  <aside class="aside">
    <nav class="aside__nav">
      <div class="aside__container">
        <a href="../../index.php">
          <img class="aside__nav-logo" width="32" src="../../assets/images/arcadia-favicon.svg" alt="">
        </a>
        <div class="aside__nav-separator"></div>
        <ul class="aside__nav-list">
          <?php foreach ($$menu as $url => $item) { ?>
            <li class="aside__nav-item <?php if($currentPage === $url) { echo 'active'; } ?>">
              <a href="<?=$url?>">
                <?= $item['menu_icon'] ?>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
      <a href="../../logout.php" class="aside__logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none">
          <path d="M10.0879 21.5625L10.0879 18.975C10.0879 18.525 9.71289 18.15 9.26289 18.15C8.81289 18.15 8.40039 18.525 8.40039 18.975L8.40039 21.5625C8.40039 21.6375 8.36289 21.675 8.28789 21.675L4.05039 21.675C3.15039 21.675 2.43789 20.9625 2.43789 20.0625L2.43789 3.97501C2.43789 3.07501 3.15039 2.36251 4.05039 2.36251L8.28789 2.36251C8.36289 2.36251 8.40039 2.40001 8.40039 2.47501L8.40039 5.06251C8.40039 5.51251 8.77539 5.88751 9.26289 5.88751C9.75039 5.88751 10.0879 5.51251 10.0879 5.06251L10.0879 2.43751C10.0879 1.46251 9.26289 0.637512 8.28789 0.637512L4.05039 0.637512C2.21289 0.637512 0.750391 2.13751 0.750391 3.93751L0.75039 20.025C0.75039 21.8625 2.25039 23.325 4.05039 23.325L8.28789 23.325C9.26289 23.325 10.0879 22.5375 10.0879 21.5625Z" />
          <path d="M12.0377 8.77499L14.4002 11.175L7.6877 11.175C7.2377 11.175 6.8627 11.55 6.8627 12C6.8627 12.45 7.2377 12.825 7.6877 12.825L14.3627 12.825L12.0377 15.1875C11.8877 15.3375 11.8127 15.5625 11.8127 15.7875C11.8127 16.0125 11.8877 16.2375 12.0752 16.3875C12.4127 16.725 12.9377 16.725 13.2752 16.3875L17.0252 12.5625C17.3627 12.225 17.3627 11.7 17.0252 11.3625L13.2752 7.53749C12.9377 7.19999 12.4127 7.19999 12.0752 7.53749C11.7377 7.91249 11.7377 8.43749 12.0377 8.77499Z" />
        </svg>
      </a>
    </nav>
  </aside>
