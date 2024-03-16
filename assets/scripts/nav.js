// Listes des backgrounds de la jungle
const backgroundJungle = [
  '../../assets/images/habitat-jungle-01.jpg',
  '../../assets/images/habitat-jungle-02.jpg',
  '../../assets/images/habitat-jungle-03.jpg',
]

// Listes des backgrounds de la savane
const backgroundSavane = [
  '../../assets/images/habitat-savane-01.jpg',
  '../../assets/images/habitat-savane-02.jpg',
  '../../assets/images/habitat-savane-03.jpg',
]

// Listes des backgrounds des marais
const backgroundMarais = [
  '../../assets/images/habitat-marais-01.jpg',
  '../../assets/images/habitat-marais-02.jpg',
  '../../assets/images/habitat-marais-03.jpg',
]

// Listes des backgrounds des restaurants
const backgroundRestauration = [
  '../../assets/images/service-restauration-01.jpg',
  '../../assets/images/service-restauration-02.jpg',
  '../../assets/images/service-restauration-03.jpg',
]

// Listes des backgrounds des visites en train
const backgroundTrain = [
  '../../assets/images/service-train-01.jpg',
  '../../assets/images/service-train-02.jpg',
  '../../assets/images/service-train-03.jpg',
]

// Listes des backgrounds des visites guidées
const backgroundGuide = [
  '../../assets/images/service-guide-01.jpg',
  '../../assets/images/service-guide-03.jpg',
  '../../assets/images/service-guide-02.jpg',
]

// Récupération des éléments 'habitats' du DOM pour le contenu
const habitatsTitle = document.querySelector('.js-habitats-title')
const habitatsContent = document.querySelector('.js-habitats-content')
const habitatsBody = document.querySelector('.js-habitats-body')
const habitatsNavImages = document.querySelectorAll('.js-habitats-images')
const habitatsNavIcons = document.querySelectorAll('.js-habitats-icon')

// Récupération des éléments 'service' du DOM pour le contenu
const serviceTitle = document.querySelector('.js-service-title')
const serviceContent = document.querySelector('.js-service-content')
const serviceBody = document.querySelector('.js-service-body')
const serviceNavImages = document.querySelectorAll('.js-service-images')
const serviceNavIcons = document.querySelectorAll('.js-service-icon')

// Récupération de la page HTML
let pageURL = ''
const pageHTML = () => {
  const pathURL = window.location.href
  const folderURL = pathURL.substring(0, pathURL.lastIndexOf('/'))
  pageURL = folderURL.split('/').pop()
}
pageHTML()

// Création d'un tableau pour stocker les images actives
let imagesArray = []

// Récupération du titre de la page
let getTitle = pageURL === 'services' ? serviceTitle.textContent : habitatsTitle.textContent

// Vérificateur de la page active
const pageChecker = () => {
  if (getTitle === 'Restaurant') {
    return backgroundRestauration
  } else if (getTitle === 'Visite en train') {
    return backgroundTrain
  } else if (getTitle === 'Visite guidée') {
    return backgroundGuide
  } else if (getTitle === 'Jungle') {
    return backgroundJungle
  } else if (getTitle === 'Savane') {
    return backgroundSavane
  } else if (getTitle === 'Marais') {
    return backgroundMarais
  }
}

// Vérification de l'élément actif
const navBackground = () => {
  if (pageURL === 'services') {
    serviceNavImages.forEach((image, index) => {
      if (image.classList.contains('active')) {
        image.style.backgroundImage = `url(${pageChecker()[index]})`
        imagesArray.push(image)
      } else {
        image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${pageChecker()[index]})`
      }
    })
  } else if (pageURL === 'habitats') {
    habitatsNavImages.forEach((image, index) => {
      if (image.classList.contains('active')) {
        image.style.backgroundImage = `url(${pageChecker()[index]})`
        imagesArray.push(image)
      } else {
        image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${pageChecker()[index]})`
      }
    })
  }
}

// Changement de l'élément actif
const backgroundChanger = () => {
  if (pageURL === 'services') {
    serviceNavIcons.forEach(icon => {
      icon.addEventListener('click', () => {
        serviceNavIcons.forEach(icon => {
          icon.classList.remove('active')
        })
        serviceNavImages.forEach(image => {
          image.classList.remove('active')
        })
        imagesArray = []
        icon.classList.add('active')
        imagesArray.push(icon.parentElement)
        imagesArray[0].firstElementChild.classList.add('active')
        serviceBody.style.backgroundImage = imagesArray[0].firstElementChild.style.backgroundImage
        
        imagesNavChanger()
        
        navBackground()
      })
    })
  } else if (pageURL === 'habitats') {
    habitatsNavIcons.forEach(icon => {
      icon.addEventListener('click', () => {
        habitatsNavIcons.forEach(icon => {
          icon.classList.remove('active')
        })
        habitatsNavImages.forEach(image => {
          image.classList.remove('active')
        })
        imagesArray = []
        icon.classList.add('active')
        imagesArray.push(icon.parentElement)
        imagesArray[0].firstElementChild.classList.add('active')
        habitatsBody.style.backgroundImage = imagesArray[0].firstElementChild.style.backgroundImage
        
        imagesNavChanger()
        
        navBackground()
      })
    })
  }
}

// Changement des images actives
const imagesNavChanger = () => {
  if (pageURL === 'services') {
    serviceNavImages.forEach((image, index) => {
      if (image.classList.contains('active')) {
        image.style.backgroundImage = `url(${backgroundRestauration[index]})`
        imagesArray.push(image)
      } else {
        image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${backgroundRestauration[index]})`
      }
    })
  } else if (pageURL === 'habitats') {
    habitatsNavImages.forEach((image, index) => {
      if (image.classList.contains('active')) {
        image.style.backgroundImage = `url(${backgroundJungle[index]})`
        imagesArray.push(image)
      } else {
        image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${backgroundJungle[index]})`
      }
    })
  }
}

// Fonction principale
const contentChanger = () => {
  navBackground()

  backgroundChanger()
}

// Lancement de la fonction principale
contentChanger()