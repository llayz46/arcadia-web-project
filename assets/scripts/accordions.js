accordionEcology = document.getElementsByClassName('js-accordion-ecology')

const accordion = (accordion) => {
  for (i = 0; i < accordion.length; i++) {
    accordion[i].addEventListener('click', function() {
      this.classList.toggle('active')
    })
  }
}

accordion(accordionEcology)