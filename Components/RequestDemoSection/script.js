import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

jQuery(document).ready(function () {
  if (jQuery('.request-demo-img-elem-desktop').length > 0) {
    jQuery(window).scroll(function () {
      if (jQuery(window).width() > 1000) {
        var scrollTop = parseInt(jQuery(document).scrollTop())

        if (scrollTop < 560) {
          scrollTop = parseInt(scrollTop / 3)

          jQuery('.request-demo-img-elem-desktop').each(function () {
            var bottom = parseInt(jQuery(this).attr('data-bottom'))
            var offY = bottom - scrollTop

            jQuery(this).css('bottom', offY + 'px')
          })
        }
      }
    })
  }

  jQuery('.request-demo-video-link a').click(function () {
    disableBodyScroll(document.querySelector('.youtube-video-dialog'))

    var $videoElem = jQuery('.youtube-video-dialog', jQuery(this).parent().parent())
    var $videoWrapperElem = jQuery('.video-responsive', jQuery(this).parent().parent())
    var videoUrl = jQuery($videoWrapperElem).attr('data-video-url')

    jQuery($videoWrapperElem).html(`<iframe width="560" height="315" src="${videoUrl}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`)

    jQuery($videoElem).fadeIn()
    jQuery('body').addClass('youtube-video-dialog-open')

    return false
  })

  jQuery('.youtube-video-dialog-inner').click(function (e) {
    e.preventDefault()
    return false
  })

  jQuery('.youtube-video-dialog').click(function (e) {
    enableBodyScroll(document.querySelector('.youtube-video-dialog'))

    var $videoWrapperElem = jQuery('.video-responsive', this)
    jQuery($videoWrapperElem).html('')

    jQuery(this).fadeOut()
    jQuery('body').removeClass('youtube-video-dialog-open')
  })

  jQuery('.youtube-video-dialog-close-btn').click(function () {
    enableBodyScroll(document.querySelector('.youtube-video-dialog'))

    var $videoWrapperElem = jQuery('.video-responsive', jQuery(this).parent().parent())
    jQuery($videoWrapperElem).html('')

    jQuery(this).parent().parent().fadeOut()
    jQuery('body').removeClass('youtube-video-dialog-open')
  })
})
