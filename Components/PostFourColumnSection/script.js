jQuery(document).ready(function () {
  jQuery('.post-four-mobile-btn a').click(function () {
    var $wrapperElem = jQuery('.post-four-col-row', jQuery(this).parent().parent())
    var mobileIndex = jQuery($wrapperElem).attr('data-mobile-index')

    mobileIndex = +mobileIndex + 1

    jQuery('.post-four-col-' + mobileIndex, $wrapperElem).addClass('post-four-col-show')
    jQuery($wrapperElem).attr('data-mobile-index', mobileIndex)

    if (mobileIndex === 4) {
      jQuery(this).parent().addClass('hide')
    }

    return false
  })
})
