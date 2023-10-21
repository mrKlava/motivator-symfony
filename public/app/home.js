"use strict"
/* Variables */

const about = document.getElementById('about')
const action = document.getElementById('action')
const actionGroup = document.getElementById('actionGroup')

/* GSAP - config */

gsap.config({
  nullTargetWarn: false,
})

/* About section */

const selAbout = gsap.utils.selector(about)
let tlAbout = gsap.timeline()

tlAbout
  .to(
    selAbout('.about-content'),
    { duration: 1, opacity: 1 }
  )
  .fromTo(
    selAbout('.about-content__item__title'),
    { duration: 2, x: '300px' },
    { x: '0px' },
    '-=1'
  )
  .fromTo(
    selAbout('.about-carousel'),
    { duration: 2, x: '-100%' },
    { x: '0px' },
    '-=1'
  )
  .fromTo(
    selAbout('.about-text'),
    { duration: 2, x: '100%' },
    { x: '0px' },
    '-=1'
  )

ScrollTrigger.create({
  animation: tlAbout,
  trigger: about,
  start: '30% 70%',
  end: '100% 70%',
  toggleActions: "play reverse play reverse",
  markers: false,
})


/* Action Section */

const selAction = gsap.utils.selector(action)
let tlAction = gsap.timeline()

tlAction
  .to(
    selAction('.action-content'),
    { duration: 1.5, opacity: 1 }
  )
  .fromTo(
    selAction('.action-suptitle'),
    { duration: 3, x: '-100%' },
    { x: '0px' },
    '-=1'
  )
  .fromTo(
    selAction('.action-title'),
    { duration: 3, x: '100%' },
    { x: '0px' },
    '-=1'
  )
  .fromTo(
    selAction('.action-btn'),
    { duration: 2, opacity: 0 },
    { opacity: 1 },
    '-=1'
  )

ScrollTrigger.create({
  animation: tlAction,
  trigger: action,
  start: 'top 70%',
  end: 'bottom 70%',
  toggleActions: "play reverse play reverse",
  markers: false,
})