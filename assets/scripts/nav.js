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

// Récupération des éléments du DOM pour le contenu
const habitatsTitle = document.querySelector('.js-habitats-title')
const habitatsContent = document.querySelector('.js-habitats-content')
const habitatsBody = document.querySelector('.js-habitats-body')
const habitatsNavImages = document.querySelectorAll('.js-habitats-images')
let imagesArray = []
const habitatsNavIcons = document.querySelectorAll('.js-habitats-icon')
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
















// const habitatsNavigation = () => {
//   imagesNavChanger()
//   navSync()
// }

// let arrayNavImages = []
// let arrayNavImagesIndexed = []

// habitatsNavigation()

// const habitatsNavBackground = () => {
//   habitatsNavImages.forEach((image, index) => {
//     if (image.classList.contains('active')) {
//       image.style.backgroundImage = `url(${backgroundJungle[index]})`
//       imagesArray.push(image)
//     } else {
//       image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${backgroundJungle[index]})`
//     }
//   })
// }

// habitatsNavBackground()

// const contentChanger = (numList) => {
//   const parentActiveElement = numList[0].parentElement
//   const parentOfParentActiveElement = parentActiveElement.parentElement
//   if (Array.from(parentOfParentActiveElement.children).indexOf(parentActiveElement) === 1) {
//     habitatsBody.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(${backgroundSavane[0]})`
//     habitatsTitle.textContent = 'Savane'
//     habitatsContent.textContent = "Explorez la savane, un paysage majestueux où la vie s'épanouit sous un ciel infini. De lions majestueux à des troupeaux d'antilopes élégants, chaque moment révèle la beauté brute de la nature. Venez découvrir la magie de la savane avec nous."
//   } else if (Array.from(parentOfParentActiveElement.children).indexOf(parentActiveElement) === 2) {
//     habitatsBody.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(${backgroundMarais[0]})`
//     habitatsTitle.textContent = 'Marais'
//     habitatsContent.textContent = "Immergez-vous dans les marais, un écosystème mystérieux où la vie prospère dans un paysage tranquille et serein. Découvrez une biodiversité fascinante, des oiseaux élégants aux grenouilles agiles. Rejoignez-nous pour découvrir la magie des marais."
//   } else {
//     habitatsBody.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(${backgroundJungle[0]})`
//     habitatsTitle.textContent = 'Jungle'
//     habitatsContent.textContent = 'Plongez dans la jungle, un monde luxuriant et mystérieux où la vie déborde dans une explosion de couleurs et de mouvements. Explorez ses sentiers sinueux, émerveillez-vous devant la richesse de sa biodiversité, des félins furtifs aux singes espiègles.'
//   }
// }

// habitatsNavIcons.forEach(icon => {
//   icon.addEventListener('click', () => {
//     habitatsNavIcons.forEach(icon => {
//       icon.classList.remove('active')
//     })
//     habitatsNavImages.forEach(image => {
//       image.classList.remove('active')
//     })
//     imagesArray = []
//     icon.classList.add('active')
//     imagesArray.push(icon.parentElement)
//     imagesArray[0].firstElementChild.classList.add('active')
//     habitatsBody.style.backgroundImage = imagesArray[0].firstElementChild.style.backgroundImage
    
//     imagesNavChanger()
//   })
// })

// const lineNav = (i) => {
//   const line = document.querySelector('.js-line')
//   switch (i) {
//     case 0:
//       line.style.background = 'linear-gradient(to right, #ffffff 0%, #ffffff 33%, #ffffff80 33%, #ffffff80 100%)'
//       break

//     case 1:
//       line.style.background = 'linear-gradient(to right, #ffffff 0%, #ffffff 66%, #ffffff80 66%, #ffffff80 100%)'
//       break

//     case 2:
//       line.style.backgroundColor = '#fff'
//       break
//   }
// }

// const imagesNavChanger = () => {
//   habitatsNavImages.forEach((image, index) => {
//     if (image.classList.contains('active')) {
//       image.style.backgroundImage = `url(${backgroundJungle[index]})`
//       imagesArray.push(image)
//     } else {
//       image.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(${backgroundJungle[index]})`
//     }
//   })
// }

// const navSync = () => {
//   let indexOfPage = []
//   const GrandParent = numbersArray[0].parentElement.parentElement
//   indexOfPage.push(Array.from(GrandParent.children).indexOf(numbersArray[0].parentElement))
//   lineNav(indexOfPage[0])
// }