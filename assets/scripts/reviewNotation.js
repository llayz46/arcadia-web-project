const stars = document.querySelectorAll(".star");

stars.forEach((star, i) => {
  star.addEventListener("click", () => {
    const rating = i + 1
    document.querySelector("#star_rating").value = rating

    stars.forEach((s, j) => {
      if (j < rating) {
        s.classList.add("rated")
      } else {
        s.classList.remove("rated")
      }
    })
  })
})
