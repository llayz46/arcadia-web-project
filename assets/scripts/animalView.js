const buttons = document.querySelectorAll('.js-animal-button')

buttons.forEach(button => {
  button.addEventListener('click', () => {
    const index = button.getAttribute('data-target')
    const modal = document.querySelector('.js-modal-container-' + index)

    const animalId = modal.getAttribute('data-animal-id')
    if (modal.style.visibility === 'hidden') {

    } else {
      fetch('lib/increment_view.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'animal_id=' + animalId
      })
      .then(response => response.text())
    }
  })
})