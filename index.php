<?php
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/habitats.php';
require_once __DIR__ . '/lib/reviews.php';
require_once __DIR__ . '/lib/animals.php';
require_once __DIR__ . '/templates/header.php';

$habitats = getHabitats($pdo, 3);

$reviews = getReviews($pdo, 'published');

$animals = getAnimalsAndBreed($pdo, 6, true);
?>

<!-- START : main -->
<main class="main">
  <!-- START : hero -->
  <section class="hero">
    <div class="hero__container-text">
      <h1 class="hero__title">Bienvenue au zoo <br><span class="accent">Arcadia</span></h1>
      <p class="hero__description">Découvrez une aventure au cœur de la nature à Arcadia, où chaque visite est une exploration inoubliable à travers les habitats diversifiés de notre monde. Depuis 1960, nous avons été dévoués à offrir à nos visiteurs une expérience immersive et éducative, tout en préservant et en protégeant la biodiversité de notre planète.</p>
    </div>
    <img class="hero__image--desktop" src="<?= _PATH_ASSETS_IMAGES_ . 'hero-parrot-card.svg' ?>" alt="Photo d'un perroquet">
    <img class="hero__image--mobile" src="<?= _PATH_ASSETS_IMAGES_ . 'hero-parrot-card-mobile.png' ?>" alt="Photo d'un perroquet">
  </section>
  <!-- END : hero -->

  <!-- START : habitat -->
  <section class="habitat">
    <div class="habitat__container-text">
      <h2 class="habitat__title">Explorez nos <span class="accent">habitats</span></h2>
      <p class="habitat__description">Explorez nos habitats variés, de la savane africaine à la jungle amazonienne, en passant par les marais européens.</p>
      <a href="./habitat.php" class="button-dark">Nos Habitats</a>
    </div>
    <div class="habitat__container-cards flux">
      <?php $i = 0;
      foreach ($habitats as $key => $habitat) {
        $i++ ?>
        <div class="habitat__card <?php if ($i === 2) {
                                    echo 'habitat__card--middle';
                                  } ?>">
          <img src="https://arcadiaweb.blob.core.windows.net/images/habitats/habitat-<?=str_replace(' ', '_', $key)?>-01.jpg" alt="Photo de l'habitat : <?= $key ?>" class="habitat__image">
          <div class="habitat__button">
            <a href="habitat.php?habitat=<?= $key ?>" class="habitat__link"><?= ucfirst($key) ?>
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M19.7427 9.30757L11.8533 0.289855C11.5102 -0.0966184 10.9767 -0.0966184 10.6336 0.289855C10.2906 0.676328 10.2906 1.27751 10.6336 1.66398L17.0367 9.00698H0.838494C0.381134 9.00698 0 9.43639 0 9.95169C0 10.467 0.381134 10.9393 0.838494 10.9393H17.1129L10.6336 18.3682C10.2906 18.7547 10.2906 19.3559 10.6336 19.7424C10.7861 19.9141 11.0148 20 11.2434 20C11.4721 20 11.7008 19.9141 11.8533 19.6994L19.7427 10.6817C20.0858 10.2952 20.0858 9.69404 19.7427 9.30757Z" fill="white" />
              </svg>
            </a>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>
  <!-- END : habitat -->

  <!-- START : ecology -->
  <section class="ecology" id="engagement">
    <div class="ecology__container-text">
      <h2 class="ecology__title"><span class="accent">L’écologie,</span> notre engagement</h2>
      <p class="ecology__description">Chez Arcadia, nous croyons en la préservation de notre précieux écosystème. Nous sommes fiers d'être entièrement autonomes sur le plan énergétique et de soutenir des initiatives de conservation à l'échelle mondiale pour protéger les espèces en voie de disparition.</p>
    </div>
    <div class="ecology__flux flux">
      <h3 class="ecology__subtitle">Vous aussi vous pouvez <span class="accent">contribuer</span></h3>
      <ul class="ecology__accordion">
        <li class="accordion__container js-accordion-ecology">
          <div class="accordion__question">
            <p class="accordion__title">Trajet en covoiturage</p>
            <svg class="accordion__icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
              <path d="M0 22.8571H17.1428V40H22.8428V22.8571H40V17.1429H22.8428V0H17.1428V17.1429H0V22.8571Z" fill="#242424" />
            </svg>
          </div>
          <p class="accordion__answers js-accordion-answer">Découvrez une façon écologique et conviviale de vous rendre aux Zoo Arcadia en utilisant le covoiturage ! Partagez la route avec d'autres passionnés de la nature et réduisez votre empreinte carbone tout en profitant d'un trajet agréable vers notre zoo.</p>
        </li>
        <li class="accordion__container js-accordion-ecology">
          <div class="accordion__question">
            <p class="accordion__title">Trajet en bus</p>
            <svg class="accordion__icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
              <path d="M0 22.8571H17.1428V40H22.8428V22.8571H40V17.1429H22.8428V0H17.1428V17.1429H0V22.8571Z" fill="#242424" />
            </svg>
          </div>
          <p class="accordion__answers js-accordion-answer">Optez pour un voyage respectueux de l'environnement en choisissant le bus pour vous rendre aux Zoo Arcadia ! Profitez d'un trajet confortable et pratique à bord de nos bus écologiques, et laissez-vous conduire jusqu'à notre zoo en toute sécurité. Évitez les tracas de la circulation et du stationnement, et contribuez à réduire les émissions de CO2 en utilisant les transports en commun.</p>
        </li>
        <li class="accordion__container js-accordion-ecology">
          <div class="accordion__question">
            <p class="accordion__title">Voiture électrique</p>
            <svg class="accordion__icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
              <path d="M0 22.8571H17.1428V40H22.8428V22.8571H40V17.1429H22.8428V0H17.1428V17.1429H0V22.8571Z" fill="#242424" />
            </svg>
          </div>
          <p class="accordion__answers js-accordion-answer">Empruntez une voie durable en choisissant la voiture électrique pour vous rendre aux Zoo Arcadia ! Profitez d'un trajet écologique, silencieux et sans émissions de CO2 à bord de nos véhicules électriques. Rejoignez-nous dans notre engagement pour un avenir plus vert et contribuez à préserver notre environnement lors de votre prochaine visite à Arcadia !</p>
        </li>
      </ul>
    </div>
  </section>
  <!-- END : ecology -->

  <!-- START : animal -->
  <section class="animal flux" id="animaux">
    <div class="animal__container-text">
      <h2 class="animal__title">À la découverte de nos <span class="accent">compagnons</span></h2>
      <p class="animal__description">Plongez dans la diversité de la faune à Arcadia, où chaque coin révèle une nouvelle merveille de la nature. Des tigres majestueux aux pandas roux espiègles, chaque rencontre est une expérience unique et enrichissante. Venez explorer et apprécier la beauté de nos compagnons à fourrure, à plumes et à écailles.</p>
    </div>
    <div class="animal__container-grid">
      <?php foreach($animals as $animal) { $animalHabitat = getAnimalHabitatById($pdo, $animal['animal_id']) ?>
        <a href="animal.php?habitat=<?=$animalHabitat['habitat_title']?>" class="animal__card animal__card--index">
          <img src="<?= _PATH_UPLOADS_ . 'animals/animal-' . strtolower($animal['animal_name']) . '.jpg'?>" alt="Image d'un(e) <?=strtolower($animal['breed_name'])?>" class="animal__image">
          <h3 class="animal__card-title"><?=ucfirst($animal['breed_name'])?></h3>
        </a>
      <?php } ?>
    </div>
  </section>
  <!-- END : animal -->

  <!-- START : services -->
  <section class="services">
    <div class="services__container-text">
      <h2 class="services__title">Découvrez les <span class="accent">services</span> d'Arcadia</h2>
      <p class="services__description">Explorez les nombreux services offerts par Arcadia, conçus pour rendre votre expérience inoubliable. De notre restaurant gastronomique à des visites guidées des habitats avec un guide (gratuit), nous sommes là pour répondre à tous vos besoins. Laissez-nous vous guider à travers une aventure unique au cœur de la nature.</p>
      <a href="service.php?service" class="button-dark">Nos Services</a>
    </div>
    <div class="services__flux">
      <div class="services__flex">
        <h3 class="services__type"><span class="accent">Restauration</span></h3>
        <div class="services__wrapper">
          <img class="services__image" src="<?= _PATH_UPLOADS_ . 'services/service-restaurant.jpg' ?>" alt="Image d'un restaurant type gastronomique">
          <p class="services__content">Découvrez une expérience culinaire exceptionnelle au restaurant gastronomique d'Arcadia. Avec une cuisine mettant en valeur des ingrédients frais et locaux, notre restaurant offre une vue imprenable sur les paysages enchanteurs du zoo, vous promettant une expérience culinaire inoubliable.</p>
        </div>
      </div>
      <div class="services__flex">
        <h3 class="services__type">Visite <span class="accent">guidée</span></h3>
        <div class="services__wrapper">
          <img class="services__image" src="<?= _PATH_UPLOADS_ . 'services/service-visite.jpg' ?>" alt="Image de visiteur du zoo">
          <p class="services__content">Explorez les merveilles de la faune en compagnie de nos guides experts lors d'une visite immersive au Zoo Arcadia. Laissez-vous guider à travers une aventure captivante où vous découvrirez les habitats naturels de nos résidents, en apprendrez d’avantage sur la vie sauvage et aurez l'occasion d'observer de près certains des animaux les plus fascinants de la planète.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- END : services -->

  <!-- START : testimonial -->
  <section class="testimonial" id="avis">
    <div class="testimonial__container-text">
      <h2 class="testimonial__title">Ils partagent leur <span class="accent">expérience</span></h2>
      <p class="testimonial__description">Découvrez ce que nos visiteurs ont à dire sur leur expérience inoubliable au Zoo Arcadia. Vous aussi, partagez votre expérience au Zoo Arcadia et faites partie de notre communauté ! Votre avis compte pour nous.</p>
      <a href="new_review.php" class="button-dark">Partagez votre expérience</a>
    </div>
    <?php if (count($reviews) > 3) { ?>
      <div class="splide flux" role="group">
        <div class="splide__track">
          <ul class="splide__list">
            <?php foreach ($reviews as $review) { ?>
              <li class="splide__slide">
                <div class="testimonial__card">
                  <div class="testimonial__card-container">
                    <h4 class="testimonial__card-title"><?= $review['nickname'] ?></h4>
                    <p class="testimonial__card-content">"<?= $review['content'] ?>"</p>
                  </div>
                  <div class="testimonial__card-note">
                    <div class="testimonial__card-stars-container">
                      <?php for ($i = 0; $i < $review['note']; $i++) { ?>
                        <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    <?php } else { ?>
      <div class="testimonial__container flux">
        <?php foreach ($reviews as $review) { ?>
          <div class="testimonial__card testimonial__no-carousel">
            <div class="testimonial__card-container">
              <h4 class="testimonial__card-title"><?= $review['nickname'] ?></h4>
              <p class="testimonial__card-content">"<?= $review['content'] ?>"</p>
            </div>
            <div class="testimonial__card-note">
              <div class="testimonial__card-stars-container">
                <?php for ($i = 0; $i < $review['note']; $i++) { ?>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
        <?php } ?>
      </div>
    <?php } ?>
  </section>
  <!-- END : testimonial -->
</main>
<!-- END : main -->

<?php
require_once __DIR__ . '/templates/footer.php';
?>