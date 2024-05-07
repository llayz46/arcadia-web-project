document.addEventListener('DOMContentLoaded', () => {
  const modalTriggers = document.querySelectorAll('.js-modal-trigger')
  modalTriggers.forEach(trigger => {
    trigger.addEventListener('click', () => {
      const target = trigger.getAttribute('data-target')
      const modalContainer = document.querySelector('.js-modal-container-' + target)
      modalContainer.classList.toggle('active')
    })
  })
})