// Objectif : Gérer la navigation images du site : donner la classe active à l'icon et à l'image au click sur celle ci
// Récupérer le bouton "icon"
// Au click sur le bouton "icon" : lui ajouter la classe "active" et lui retirer la classe "active" à tous les autres boutons "icon"
// Récupérer l'image correspondante au bouton "icon" avec la classe "active"
// Lui ajouter la classe "active" et retirer la classe "active" à toutes les autres images


// Listes des backgrounds de la jungle
const backgroundJungle = [
  '../assets/images/habitat-jungle-01.jpg',
  '../assets/images/habitat-jungle-02.jpg',
  '../assets/images/habitat-jungle-03.jpg',
]

const habitatsNavImages = document.querySelectorAll('.js-habitats-images')
const habitatsNavIcons = document.querySelectorAll('.js-habitats-icon')
let imagesArray = []

const habitatsNavBackground = () => {
  habitatsNavImages.forEach((image, index) => {
    if (image.classList.contains('active')) {
      image.style.backgroundImage = `url(${backgroundJungle[index]})`
      imagesArray.push(image)
    } else {
      image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${backgroundJungle[index]})`
    }
  })
}

habitatsNavBackground()

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
    habitatsNavBackground()
  })
})