"use strict"

/* Variables */

const header = document.getElementById('header')

/* GSAP - config */

gsap.config({
  nullTargetWarn: false,
})


/* Header section */

let tlHeader = gsap.timeline({
  scrollTrigger: {
    trigger: header,
    start: "top top",
    end: "bottom top",
    scrub: 0,
    // markers: true,
  }
})

gsap.utils.toArray(".parallax").forEach(layer => {
  const depth = layer.dataset.depth;
  const movement = -(layer.offsetHeight * depth)
  console.log(depth)
  console.log(movement)
  tlHeader.to(layer, { y: movement, ease: "none" }, 0)
})