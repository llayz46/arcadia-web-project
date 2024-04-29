document.addEventListener('DOMContentLoaded', () => {
  // Récupération des éléments
  let line = document.querySelectorAll('.js-line-parent')

  // Cacher les éléments au chargements de la page
  line.forEach((el) => {
    el.style.display = 'none'
  })

  // Afficher les éléments après 300 milliseconde
  setTimeout(() => {
    line.forEach((el) => {
      el.style.display = 'flex'
    })
  }, 300)
})