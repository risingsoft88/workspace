jQuery(document).ready(function () {
  jQuery('.navigation-item').click(function () {
    const sectionId = jQuery(this).attr('data-section-id')

    if (jQuery(`#${sectionId}`).length > 0) {
      jQuery('html, body').animate({
        scrollTop: jQuery(`#${sectionId}`).offset().top
      }, 1000)
    }
  })
})
