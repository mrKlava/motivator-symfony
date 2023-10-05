"use strict"

/* Variables */

const menu = document.getElementById('navMenu')

/* Events */

document.addEventListener("click", (e) => {
  const avatar = e.target.closest('#avatar')

  if (!avatar) {
    menu.classList.remove('active')
  } else {
    menu.classList.add('active')
  }
})

