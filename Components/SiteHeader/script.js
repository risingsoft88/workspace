import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

jQuery(document).ready(function () {
  jQuery('.header-mobile-menu-btn').click(function () {
    if (jQuery(this).hasClass('is-active')) {
      jQuery(this).removeClass('is-active')
      jQuery('.header-nav').removeClass('is-active')

      enableBodyScroll(document.querySelector('.header-nav'))
    } else {
      jQuery(this).addClass('is-active')
      jQuery('.header-nav').addClass('is-active')

      disableBodyScroll(document.querySelector('.header-nav'))
    }
  })

  setHeaderMenuAction()

  jQuery(window).resize(function () {
    setHeaderMenuAction()
  })

  jQuery('.arrow-down').click(function () {
    if (jQuery(this).hasClass('open')) {
      jQuery('.header-sub-menu-section', jQuery(this).parent()).slideUp()
      jQuery(this).removeClass('open')
    } else {
      jQuery('.header-sub-menu-section', jQuery(this).parent()).slideDown()
      jQuery(this).addClass('open')
    }
  })
})

function setHeaderMenuAction () {
  if (jQuery(window).width() > 1000) {
    attachHoverMenuEventHandlers()
  } else {
    unbindHoverMenuEventHandlers()
  }
}

function attachHoverMenuEventHandlers () {
  // On desktop only and don't attach handlers if function has already run
  if (!window.desktopMenuEventsAttached) {
    // Open sub menu and keep open. Close when hovering over a different menu item
    jQuery('.header-menu>.menu-item').hover(
      function () {
        var $this = jQuery(this)
        jQuery('.header-menu-item').removeClass('fade')
        $this.children('.header-menu-item').addClass('fade')

        setTimeout(function () {
          jQuery('.header-sub-menu-section.active').removeClass('active')
          $this.children('.header-sub-menu-section').addClass('active')
        }, 200)
      }
    )

    // Close sub menu when not hovering header element
    jQuery('header').hover(function () {}, function () {
      setTimeout(function () {
        jQuery('.header-menu-item').removeClass('fade')
        jQuery('.header-sub-menu-section.active').removeClass('active')
      }, 200)
    })

    jQuery('.header-sub-menu-list a').mouseover(function (e) {
      var menuID = jQuery(this).attr('data-menu-id')
      var selectedSubMenuID = jQuery('.header-menu').attr('data-selected-sub-menu-id')

      if (selectedSubMenuID !== menuID) {
        jQuery('.header-menu').attr('data-selected-sub-menu-id', menuID)
        var $subMenuDesElem = jQuery(`#header-sub-menu-description-sub-${menuID}`)

        if ($subMenuDesElem.is(':hidden')) {
          jQuery('.header-sub-menu-description-sub').hide()
          $subMenuDesElem.fadeIn(500)
        }
      }
    })

    window.desktopMenuEventsAttached = true
  }
}

function unbindHoverMenuEventHandlers () {
  if (window.desktopMenuEventsAttached) {
    jQuery('.header-menu>.menu-item, .header-sub-menu-list a').off('mouseenter mouseleave')

    window.desktopMenuEventsAttached = false
  }
}
