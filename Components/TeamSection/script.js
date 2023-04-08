import Masonry from 'masonry-layout'

jQuery(document).ready(function () {
  if (document.querySelector('.team-images')) {
    window.msnry = new Masonry(document.querySelector('.team-images'), {
      itemSelector: '.team-image-item'
    })
  }
})
