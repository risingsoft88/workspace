import Swiper from 'swiper'
import 'swiper/css/swiper.min.css'

function initTestimonialSlider () {
  var windowWidth = jQuery(window).width()

  if (windowWidth > 1000) {
    if (window.testimonialSlider === '') {
      // init slider
      jQuery('.testimonial-slider-container').addClass('swiper-container')
      jQuery('.testimonial-slider-wrapper').addClass('swiper-wrapper')
      jQuery('.testimonial-slider-item').addClass('swiper-slide')

      window.testimonialSlider = new Swiper('.testimonial-slider-container', {
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 0,
        roundLengths: true,
        autoplay: {
          delay: 5000
        },
        loop: true,
        pagination: {
          el: '.testimonial-pagination'
        },
        navigation: {
          nextEl: '.testimonial-slider-next',
          prevEl: '.testimonial-slider-prev'
        }
      })
    }
  } else {
    if (window.testimonialSlider !== '') {
      // destory slider
      window.testimonialSlider.destroy()
      window.testimonialSlider = ''
      jQuery('.testimonial-slider-container').removeClass('swiper-container')
      jQuery('.testimonial-slider-wrapper').removeClass('swiper-wrapper')
      jQuery('.testimonial-slider-item').removeClass('swiper-slide')

      // console.log('destory')
    }
  }
}

jQuery(document).ready(function () {
  window.testimonialSlider = ''

  if (jQuery('.testimonial-slider-container').length > 0) {
    initTestimonialSlider()

    jQuery(window).resize(function () {
      initTestimonialSlider()
    })
  }

  jQuery('.testimonial-slider-mobile-btn a').click(function () {
    var $wrapperElem = jQuery('.testimonial-slider-wrapper', jQuery(this).parent().parent())
    var mobileIndex = jQuery($wrapperElem).attr('data-mobile-index')

    mobileIndex = +mobileIndex + 1

    jQuery('.testimonial-slider-item-' + mobileIndex, $wrapperElem).addClass('testimonial-slider-item-show')
    jQuery($wrapperElem).attr('data-mobile-index', mobileIndex)

    if (mobileIndex === 6) {
      jQuery(this).parent().addClass('hide')
    }

    return false
  })
})
