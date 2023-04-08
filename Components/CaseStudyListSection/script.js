jQuery(document).ready(function () {
  jQuery('.case-study-list-cat-list-label').click(function () {
    var status = jQuery(this).attr('data-status')

    if (status === 'close') {
      jQuery('.case-study-list-cat-list', jQuery(this).parent()).slideDown()
      jQuery(this).attr('data-status', 'open')
    } else if (status === 'open') {
      jQuery('.case-study-list-cat-list', jQuery(this).parent()).slideUp()
      jQuery(this).attr('data-status', 'close')
    }
  })

  jQuery('.case-study-list-cat-item').click(function () {
    if (!jQuery(this).hasClass('active')) {
      var slug = jQuery(this).attr('data-slug')
      var $catElem = jQuery(this).parent()
      var $containerElem = jQuery(this).parent().parent()

      jQuery('.case-study-list-cat-item', $catElem).removeClass('active')
      jQuery(this).addClass('active')

      jQuery('.case-study-list', $containerElem).addClass('hide')
      jQuery('.case-study-list.' + slug, $containerElem).removeClass('hide')

      jQuery('.case-study-list-cat-list-label', $containerElem).text(jQuery(this).text())
    }
  })
})
