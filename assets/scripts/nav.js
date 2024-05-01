// Burger menu
const burger = document.querySelector('.js-header-burger')
const nav = document.querySelector('.js-header-mobile-nav')

burger.addEventListener('click', () => {
  nav.classList.toggle('active')
})

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

// Création d'un tableau pour stocker les images actives
let imagesArray = []

// Récupération de l'URL de la page
const searchUrl = window.location.search
const URLParams = new URLSearchParams(searchUrl)

// Récupération de la page : 'service' ou 'habitat'
const UrlPathname = window.location.pathname
const OnlyUrlPathname = UrlPathname.replace(/^\/|\.php$/g, '')

// Fonction pour créer un tableau d'images
const imageArrayCreator = (page) => {
  let pageImageArray = []
  for (let i = 1; i <= 3; i++) {
    pageImageArray.push(`assets/uploads/${page}s/${page}-${URLParams.get(page)}-0${i}.jpg`)
  }

  return pageImageArray
}

// Vérification de l'élément actif
const navBackground = () => {
  if (OnlyUrlPathname === 'service') {
    serviceNavImages.forEach((image, index) => {
      if (image.classList.contains('active')) {
        image.style.backgroundImage = `url(${imageArrayCreator(OnlyUrlPathname)[index]})`
        imagesArray.push(image)
      } else {
        image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${imageArrayCreator(OnlyUrlPathname)[index]})`
      }
    })
  } else {
    habitatsNavImages.forEach((image, index) => {
      if (image.classList.contains('active')) {
        image.style.backgroundImage = `url(${imageArrayCreator(OnlyUrlPathname)[index]})`
        imagesArray.push(image)
      } else {
        image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${imageArrayCreator(OnlyUrlPathname)[index]})`
      }
    })
  }
}

// Changement de l'élément actif
const backgroundChanger = () => {
  if (OnlyUrlPathname === 'service') {
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
  } else {
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
  if (OnlyUrlPathname === 'service') {
    serviceNavImages.forEach((image, index) => {
      if (image.classList.contains('active')) {
        image.style.backgroundImage = `url(${imageArrayCreator(OnlyUrlPathname)[index]})`
        imagesArray.push(image)
      } else {
        image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${imageArrayCreator(OnlyUrlPathname)[index]})`
      }
    })
  } else if (OnlyUrlPathname === 'habitat') {
    habitatsNavImages.forEach((image, index) => {
      if (image.classList.contains('active')) {
        image.style.backgroundImage = `url(${imageArrayCreator(OnlyUrlPathname)[index]})`
        imagesArray.push(image)
      } else {
        image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${imageArrayCreator(OnlyUrlPathname)[index]})`
      }
    })
  }
}

// Fonction principale
const contentChanger = () => {
  if (OnlyUrlPathname === 'service') {
    serviceBody.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('assets/uploads/${OnlyUrlPathname}s/${OnlyUrlPathname}-${URLParams.get(OnlyUrlPathname)}-01.jpg')`
  } else {
    habitatsBody.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('assets/uploads/${OnlyUrlPathname}s/${OnlyUrlPathname}-${URLParams.get(OnlyUrlPathname)}-01.jpg')`
  }

  navBackground()

  backgroundChanger()
}

// Lancement de la fonction principale
contentChanger()

// Récupération des éléments du DOM pour le contenu
const contents = document.querySelectorAll('.js-content')

// Récupération du nombres d'éléments
const navLength = contents.length

// Récupération de l'élément actif
const activeElement = Array.from(contents).findIndex(content => content.classList.contains('active')) + 1

const lineBackground = (activeElement, navLength) => {
  const line = document.querySelector('.js-line')
  if (activeElement !== navLength) {
    const percentage = (activeElement / navLength) * 100
    line.style.background = `linear-gradient(to right, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 1) ${percentage}%, rgba(255, 255, 255, 0.5) ${percentage}%, rgba(255, 255, 255, 0.5) 100%)`
  } else {
    line.style.background = `rgba(255, 255, 255, 1)`
  }
}

lineBackground(activeElement, navLength)