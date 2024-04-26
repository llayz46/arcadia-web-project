<?php
require_once __DIR__ . '/templates/header.php';
?>

<!-- START : main -->
<main class="main">
  <!-- START : hero -->
  <section class="hero">
    <div class="hero__container-text">
      <h1 class="hero__title">Bienvenue au zoo <br><span class="accent">Arcadia</span></h1>
      <p class="hero__description">Découvrez une aventure au cœur de la nature à Arcadia, où chaque visite est une exploration inoubliable à travers les habitats diversifiés de notre monde. Depuis 1960, nous avons été dévoués à offrir à nos visiteurs une expérience immersive et éducative, tout en préservant et en protégeant la biodiversité de notre planète.</p>
    </div>
    <img class="hero__image--desktop" src="<?=_PATH_ASSETS_IMAGES_ . 'hero-parrot-card.svg'?>" alt="Photo d'un perroquet">
    <img class="hero__image--mobile" src="<?=_PATH_ASSETS_IMAGES_ . 'hero-parrot-card-mobile.png'?>" alt="Photo d'un perroquet">
  </section>
  <!-- END : hero -->

  <!-- START : habitat -->
  <section class="habitat">
    <div class="habitat__container-text">
      <h2 class="habitat__title">Explorez nos <span class="accent">habitats</span></h2>
      <p class="habitat__description">Explorez nos habitats variés, de la savane africaine à la jungle amazonienne, en passant par les marais européens.</p>
      <a href="./pages/habitats/jungle.html" class="button-dark">Nos Habitats</a>
    </div>
    <div class="habitat__container-cards flux">
      <div class="habitat__card">
        <img src="<?=_PATH_UPLOADS_ . 'habitats/habitat-jungle-01.jpg'?>" alt="Photo du ponton de la jungle" class="habitat__image">
        <div class="habitat__button">
          <a href="habitat.php?habitat=jungle" class="habitat__link">Jungle
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
              <path d="M19.7427 9.30757L11.8533 0.289855C11.5102 -0.0966184 10.9767 -0.0966184 10.6336 0.289855C10.2906 0.676328 10.2906 1.27751 10.6336 1.66398L17.0367 9.00698H0.838494C0.381134 9.00698 0 9.43639 0 9.95169C0 10.467 0.381134 10.9393 0.838494 10.9393H17.1129L10.6336 18.3682C10.2906 18.7547 10.2906 19.3559 10.6336 19.7424C10.7861 19.9141 11.0148 20 11.2434 20C11.4721 20 11.7008 19.9141 11.8533 19.6994L19.7427 10.6817C20.0858 10.2952 20.0858 9.69404 19.7427 9.30757Z" fill="white" />
            </svg>
          </a>
        </div>
      </div>
      <div class="habitat__card habitat__card--middle">
        <img src="<?=_PATH_UPLOADS_ . 'habitats/habitat-savane.jpg'?>" alt="Photo de la savane" class="habitat__image">
        <div class="habitat__button">
          <a href="habitat.php?habitat=savane" class="habitat__link">Savane
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
              <path d="M19.7427 9.30757L11.8533 0.289855C11.5102 -0.0966184 10.9767 -0.0966184 10.6336 0.289855C10.2906 0.676328 10.2906 1.27751 10.6336 1.66398L17.0367 9.00698H0.838494C0.381134 9.00698 0 9.43639 0 9.95169C0 10.467 0.381134 10.9393 0.838494 10.9393H17.1129L10.6336 18.3682C10.2906 18.7547 10.2906 19.3559 10.6336 19.7424C10.7861 19.9141 11.0148 20 11.2434 20C11.4721 20 11.7008 19.9141 11.8533 19.6994L19.7427 10.6817C20.0858 10.2952 20.0858 9.69404 19.7427 9.30757Z" fill="white" />
            </svg>
          </a>
        </div>
      </div>
      <div class="habitat__card">
        <img src="<?=_PATH_UPLOADS_ . 'habitats/habitat-marais-01.jpg'?>" alt="Photo du marais" class="habitat__image">
        <div class="habitat__button">
          <a href="habitat.php?habitat=marais" class="habitat__link">Marais
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
              <path d="M19.7427 9.30757L11.8533 0.289855C11.5102 -0.0966184 10.9767 -0.0966184 10.6336 0.289855C10.2906 0.676328 10.2906 1.27751 10.6336 1.66398L17.0367 9.00698H0.838494C0.381134 9.00698 0 9.43639 0 9.95169C0 10.467 0.381134 10.9393 0.838494 10.9393H17.1129L10.6336 18.3682C10.2906 18.7547 10.2906 19.3559 10.6336 19.7424C10.7861 19.9141 11.0148 20 11.2434 20C11.4721 20 11.7008 19.9141 11.8533 19.6994L19.7427 10.6817C20.0858 10.2952 20.0858 9.69404 19.7427 9.30757Z" fill="white" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- END : habitat -->

  <!-- START : ecology -->
  <section class="ecology" id="engagement">
    <div class="ecology__container-text">
      <h2 class="ecology__title"><span class="accent">L’écologie</span>, notre engagement</h2>
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
          <p class="accordion__answers js-accordion-answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora nihil tempore nam officiis nesciunt temporibus sunt exercitationem commodi illum eligendi soluta delectus error ipsa illo vel aliquid, doloribus repudiandae? Facere.</p>
        </li>
        <li class="accordion__container js-accordion-ecology">
          <div class="accordion__question">
            <p class="accordion__title">Trajet en bus</p>
            <svg class="accordion__icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
              <path d="M0 22.8571H17.1428V40H22.8428V22.8571H40V17.1429H22.8428V0H17.1428V17.1429H0V22.8571Z" fill="#242424" />
            </svg>
          </div>
          <p class="accordion__answers js-accordion-answer">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt facere dolor dolorum nostrum quasi voluptates, maxime velit necessitatibus soluta suscipit. Dicta eaque quidem totam, repellat deserunt ipsum consequuntur blanditiis recusandae.</p>
        </li>
        <li class="accordion__container js-accordion-ecology">
          <div class="accordion__question">
            <p class="accordion__title">Voiture électrique</p>
            <svg class="accordion__icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
              <path d="M0 22.8571H17.1428V40H22.8428V22.8571H40V17.1429H22.8428V0H17.1428V17.1429H0V22.8571Z" fill="#242424" />
            </svg>
          </div>
          <p class="accordion__answers js-accordion-answer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora optio, nostrum rem corrupti sunt blanditiis quisquam praesentium inventore obcaecati impedit. Molestias perspiciatis repellat voluptate error eveniet optio quo natus fugiat?</p>
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
      <div class="animal__card">
        <img src="./assets/images/animal-tigre.jpg" alt="Image d'un tigre" class="animal__image">
        <h3 class="animal__card-title">Tigre</h3>
      </div>
      <div class="animal__card">
        <img src="./assets/images/animal-singe.jpg" alt="Image d'un singe" class="animal__image">
        <h3 class="animal__card-title">Singe</h3>
      </div>
      <div class="animal__card">
        <img src="./assets/images/animal-perroquet.jpg" alt="Image d'un perroquet" class="animal__image">
        <h3 class="animal__card-title">Perroquet Ara</h3>
      </div>
      <div class="animal__card">
        <img src="./assets/images/animal-loutre.jpg" alt="Image d'une loutre" class="animal__image">
        <h3 class="animal__card-title">Loutre</h3>
      </div>
      <div class="animal__card">
        <img src="./assets/images/animal-panda.jpg" alt="Image d'un panda roux" class="animal__image">
        <h3 class="animal__card-title">Panda roux</h3>
      </div>
      <div class="animal__card">
        <img src="./assets/images/animal-crocodile.jpg" alt="Image de deux caiman" class="animal__image">
        <h3 class="animal__card-title">Caiman</h3>
      </div>
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
          <img class="services__image" src="<?=_PATH_UPLOADS_ . 'services/service-restaurant.jpg'?>" alt="Image d'un restaurant type gastronomique">
          <p class="services__content">Découvrez une expérience culinaire exceptionnelle au restaurant gastronomique d'Arcadia. Avec une cuisine mettant en valeur des ingrédients frais et locaux, notre restaurant offre une vue imprenable sur les paysages enchanteurs du zoo, vous promettant une expérience culinaire inoubliable.</p>
        </div>
      </div>
      <div class="services__flex">
        <h3 class="services__type">Visite <span class="accent">guidée</span></h3>
        <div class="services__wrapper">
          <img class="services__image" src="<?=_PATH_UPLOADS_ . 'services/service-visite.jpg'?>" alt="Image de visiteur du zoo">
          <p class="services__content">Explorez les merveilles de la faune en compagnie de nos guides experts lors d'une visite immersive au Zoo Arcadia. Laissez-vous guider à travers une aventure captivante où vous découvrirez les habitats naturels de nos résidents, en apprendrez d’avantage sur la vie sauvage et aurez l'occasion d'observer de près certains des animaux les plus fascinants de la planète.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- END : services -->

  <!-- START : testimonial -->
  <section class="testimonial" id="avis">
    <h2 class="testimonial__title">Ils partagent leur <span class="accent">expérience</span></h2>
    <div class="splide flux" role="group">
      <div class="splide__track">
        <ul class="splide__list">
          <li class="splide__slide">
            <div class="testimonial__card">
              <div class="testimonial__card-container">
                <h4 class="testimonial__card-title">Steve Johnson</h4>
                <p class="testimonial__card-content">"Une expérience incroyable au Zoo Arcadia ! J'ai adoré explorer les différents habitats et rencontrer les animaux fascinants. Le personnel était extrêmement sympathique et compétent, et l'engagement envers l'écologie est vraiment inspirant. Je recommande vivement cette expérience à tous les amoureux de la nature !"</p>
              </div>
              <div class="testimonial__card-note">
                <div class="testimonial__card-stars-container">
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                </div>
                <svg class="testimonial__card-smiley" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24ZM12 21.6C17.302 21.6 21.6 17.302 21.6 12C21.6 6.69806 17.302 2.4 12 2.4C6.69806 2.4 2.4 6.69806 2.4 12C2.4 17.302 6.69806 21.6 12 21.6ZM6 13.2H8.4C8.4 15.1883 10.0117 16.8 12 16.8C13.9883 16.8 15.6 15.1883 15.6 13.2H18C18 16.5137 15.3137 19.2 12 19.2C8.6863 19.2 6 16.5137 6 13.2ZM7.2 10.8C6.20588 10.8 5.4 9.99408 5.4 9C5.4 8.00588 6.20588 7.2 7.2 7.2C8.19412 7.2 9 8.00588 9 9C9 9.99408 8.19412 10.8 7.2 10.8ZM16.8 10.8C15.8059 10.8 15 9.99408 15 9C15 8.00588 15.8059 7.2 16.8 7.2C17.7941 7.2 18.6 8.00588 18.6 9C18.6 9.99408 17.7941 10.8 16.8 10.8Z" fill="#55B76B" />
                </svg>
              </div>
            </div>
          </li>

          <li class="splide__slide">
            <div class="testimonial__card">
              <div class="testimonial__card-container">
                <h4 class="testimonial__card-title">Anna Lee</h4>
                <p class="testimonial__card-content">"Une journée inoubliable au Zoo Arcadia ! La visite guidée était très informative et divertissante. Les habitats sont bien aménagés et les animaux semblent très bien pris en charge. Je suis particulièrement impressionné par l'engagement écologique du zoo. Je reviendrai certainement et je le recommande à tous ceux qui recherchent une expérience enrichissante en plein air."</p>
              </div>
              <div class="testimonial__card-note">
                <div class="testimonial__card-stars-container">
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                </div>
                <svg class="testimonial__card-smiley" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24ZM12 21.6C17.302 21.6 21.6 17.302 21.6 12C21.6 6.69806 17.302 2.4 12 2.4C6.69806 2.4 2.4 6.69806 2.4 12C2.4 17.302 6.69806 21.6 12 21.6ZM6 13.2H8.4C8.4 15.1883 10.0117 16.8 12 16.8C13.9883 16.8 15.6 15.1883 15.6 13.2H18C18 16.5137 15.3137 19.2 12 19.2C8.6863 19.2 6 16.5137 6 13.2ZM7.2 10.8C6.20588 10.8 5.4 9.99408 5.4 9C5.4 8.00588 6.20588 7.2 7.2 7.2C8.19412 7.2 9 8.00588 9 9C9 9.99408 8.19412 10.8 7.2 10.8ZM16.8 10.8C15.8059 10.8 15 9.99408 15 9C15 8.00588 15.8059 7.2 16.8 7.2C17.7941 7.2 18.6 8.00588 18.6 9C18.6 9.99408 17.7941 10.8 16.8 10.8Z" fill="#55B76B" />
                </svg>
              </div>
            </div>
          </li>

          <li class="splide__slide">
            <div class="testimonial__card">
              <div class="testimonial__card-container">
                <h4 class="testimonial__card-title">Marc Talot</h4>
                <p class="testimonial__card-content">"Une journée fantastique à Arcadia ! Les habitats étaient superbes et bien entretenus, les animaux semblaient heureux et en bonne santé. Les guides étaient très instructifs et sympathiques. L'engagement envers l'écologie est admirable. Je recommande vivement cette expérience !"</p>
              </div>
              <div class="testimonial__card-note">
                <div class="testimonial__card-stars-container">
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                </div>
                <svg class="testimonial__card-smiley" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24ZM12 21.6C17.302 21.6 21.6 17.302 21.6 12C21.6 6.69806 17.302 2.4 12 2.4C6.69806 2.4 2.4 6.69806 2.4 12C2.4 17.302 6.69806 21.6 12 21.6ZM6 13.2H8.4C8.4 15.1883 10.0117 16.8 12 16.8C13.9883 16.8 15.6 15.1883 15.6 13.2H18C18 16.5137 15.3137 19.2 12 19.2C8.6863 19.2 6 16.5137 6 13.2ZM7.2 10.8C6.20588 10.8 5.4 9.99408 5.4 9C5.4 8.00588 6.20588 7.2 7.2 7.2C8.19412 7.2 9 8.00588 9 9C9 9.99408 8.19412 10.8 7.2 10.8ZM16.8 10.8C15.8059 10.8 15 9.99408 15 9C15 8.00588 15.8059 7.2 16.8 7.2C17.7941 7.2 18.6 8.00588 18.6 9C18.6 9.99408 17.7941 10.8 16.8 10.8Z" fill="#55B76B" />
                </svg>
              </div>
            </div>
          </li>

          <li class="splide__slide">
            <div class="testimonial__card">
              <div class="testimonial__card-container">
                <h4 class="testimonial__card-title">Pauline Lefebvre</h4>
                <p class="testimonial__card-content">"Une expérience incroyable ! Le Zoo Arcadia est un endroit magique où j'ai passé une journée inoubliable en famille. Les animaux sont magnifiques et bien soignés, et les habitats sont très bien conçus. Nous avons particulièrement apprécié la visite guidée qui était informative et divertissante. C'est un endroit idéal pour les amoureux de la nature de tous âges. Nous reviendrons certainement !"</p>
              </div>
              <div class="testimonial__card-note">
                <div class="testimonial__card-stars-container">
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                  <svg class="testimonial__card-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M24 9.18621H14.84L12 0L9.16 9.18621H0L7.4 14.8552L4.6 24L12 18.331L19.4 24L16.56 14.8138L24 9.18621Z" fill="#FFCE31" />
                  </svg>
                </div>
                <svg class="testimonial__card-smiley" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24ZM12 21.6C17.302 21.6 21.6 17.302 21.6 12C21.6 6.69806 17.302 2.4 12 2.4C6.69806 2.4 2.4 6.69806 2.4 12C2.4 17.302 6.69806 21.6 12 21.6ZM6 13.2H8.4C8.4 15.1883 10.0117 16.8 12 16.8C13.9883 16.8 15.6 15.1883 15.6 13.2H18C18 16.5137 15.3137 19.2 12 19.2C8.6863 19.2 6 16.5137 6 13.2ZM7.2 10.8C6.20588 10.8 5.4 9.99408 5.4 9C5.4 8.00588 6.20588 7.2 7.2 7.2C8.19412 7.2 9 8.00588 9 9C9 9.99408 8.19412 10.8 7.2 10.8ZM16.8 10.8C15.8059 10.8 15 9.99408 15 9C15 8.00588 15.8059 7.2 16.8 7.2C17.7941 7.2 18.6 8.00588 18.6 9C18.6 9.99408 17.7941 10.8 16.8 10.8Z" fill="#55B76B" />
                </svg>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- END : testimonial -->
</main>
<!-- END : main -->

<?php
require_once __DIR__ . '/templates/footer.php';
?>