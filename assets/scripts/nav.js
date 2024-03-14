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

// Récupération des éléments 'habitats' du DOM pour le contenu
const habitatsTitle = document.querySelector('.js-habitats-title')
const habitatsContent = document.querySelector('.js-habitats-content')
const habitatsBody = document.querySelector('.js-habitats-body')
const habitatsNavImages = document.querySelectorAll('.js-habitats-images')
const habitatsNavIcons = document.querySelectorAll('.js-habitats-icon')

// Création d'un tableau pour stocker les images actives
let imagesArray = []

// Vérification de l'élément actif
const habitatsNavBackground = () => { // chnage rle junglke par habitat 
  habitatsNavImages.forEach((image, index) => {
    if (image.classList.contains('active')) {
      image.style.backgroundImage = `url(${backgroundJungle[index]})`
      imagesArray.push(image)
    } else {
      image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${backgroundJungle[index]})`
    }
  })
}

// Changement de l'élément actif
const backgroundChanger = () => {
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
    })
  })
}

// Changement des images actives
const imagesNavChanger = () => {
  habitatsNavImages.forEach((image, index) => {
    if (image.classList.contains('active')) {
      image.style.backgroundImage = `url(${backgroundJungle[index]})`
      imagesArray.push(image)
    } else {
      image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${backgroundJungle[index]})`
    }
  })
}

// Fonction principale
const contentChanger = () => {
  habitatsNavBackground()

  backgroundChanger()
}

// Lancement de la fonction principale
contentChanger()