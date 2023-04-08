jQuery(document).ready(function () {
  function allBlogInit (category = '') {
    jQuery('.all-blog-load-spinner').removeClass('hide')

    var page = 1
    var postsPerPage = jQuery('#all-blog-navigation').attr('data-posts-per-page')
    var nonce = jQuery('#all-blog-navigation').attr('data-nonce')
    var cat = category === '' ? jQuery('#all-blog-navigation').attr('data-cat') : category

    jQuery.ajax({
      type: 'post',
      dataType: 'json',
      url: window.FlyntData.ajaxurl,
      data: {
        action: 'get_all_blog_posts',
        nonce: nonce,
        cat: cat,
        page: page,
        postsPerPage: postsPerPage
      },
      success: function (response) {
        jQuery('#all-blog-row').html(response.blog_html)
        jQuery('#all-blog-navigation').html(response.page_nav_html)
        jQuery('#all-blog-load-more-btn-row').html(response.load_more_btn)

        blogNavigation()
        jQuery('.all-blog-load-spinner').addClass('hide')
      }
    })
  }

  if (jQuery('.all-blog-section').length > 0) {
    var queryString = window.location.search.split('?category=')[1]
    if (queryString) {
      jQuery('.all-blog-cat-item', '.all-blog-cat-list').removeClass('active')
      jQuery('.all-blog-cat-list').find(`[data-slug='${queryString}']`).addClass('active')
      allBlogInit(queryString)
    } else {
      allBlogInit()
    }
  }

  function blogNavigation () {
    jQuery('#all-blog-navigation a').click(function (e) {
      e.preventDefault()

      if (jQuery(this).parent().hasClass('active')) {
        return false
      }

      jQuery('.all-blog-load-spinner').removeClass('hide')

      var page = jQuery(this).attr('href').split('#')[1]
      var postsPerPage = jQuery('#all-blog-navigation').attr('data-posts-per-page')
      var nonce = jQuery('#all-blog-navigation').attr('data-nonce')
      var cat = jQuery('#all-blog-navigation').attr('data-cat')

      jQuery.ajax({
        type: 'post',
        dataType: 'json',
        url: window.FlyntData.ajaxurl,
        data: {
          action: 'get_all_blog_posts',
          nonce: nonce,
          page: page,
          postsPerPage: postsPerPage,
          cat: cat
        },
        success: function (response) {
          jQuery('#all-blog-row').html(response.blog_html)
          jQuery('#all-blog-navigation').html(response.page_nav_html)
          jQuery('#all-blog-load-more-btn-row').html(response.load_more_btn)

          blogNavigation()
          jQuery('.all-blog-load-spinner').addClass('hide')
        }
      })

      return false
    })

    jQuery('#all-blog-load-more-btn').click(function (e) {
      e.preventDefault()

      jQuery('.all-blog-load-spinner').removeClass('hide')

      var page = jQuery(this).attr('data-next-page')
      var postsPerPage = jQuery('#all-blog-navigation').attr('data-posts-per-page')
      var nonce = jQuery('#all-blog-navigation').attr('data-nonce')
      var cat = jQuery('#all-blog-navigation').attr('data-cat')

      jQuery.ajax({
        type: 'post',
        dataType: 'json',
        url: window.FlyntData.ajaxurl,
        data: {
          action: 'get_all_blog_posts',
          nonce: nonce,
          page: page,
          postsPerPage: postsPerPage,
          cat: cat
        },
        success: function (response) {
          jQuery('#all-blog-row').append(response.blog_html)
          jQuery('#all-blog-navigation').html(response.page_nav_html)
          jQuery('#all-blog-load-more-btn-row').html(response.load_more_btn)

          blogNavigation()
          jQuery('.all-blog-load-spinner').addClass('hide')
        }
      })

      return false
    })
  }

  // blogNavigation()

  jQuery('.all-blog-cat-item').click(function () {
    if (!jQuery(this).hasClass('active')) {
      var slug = jQuery(this).attr('data-slug')
      var $catElem = jQuery(this).parent()
      var $containerElem = jQuery(this).parent().parent()

      jQuery('.all-blog-cat-item', $catElem).removeClass('active')
      jQuery(this).addClass('active')

      // Remove query strings
      window.history.pushState(
        '',
        '',
        window.location.href.split(window.location.pathname)[0] + '/blog?category=' + slug
      )

      jQuery('#all-blog-navigation').attr('data-cat', slug)
      allBlogInit()

      jQuery('.all-blog-cat-list-label', $containerElem).text(jQuery(this).text())
    }
  })

  jQuery('.all-blog-cat-list-label').click(function () {
    var status = jQuery(this).attr('data-status')

    if (status === 'close') {
      jQuery('.all-blog-cat-list', jQuery(this).parent()).slideDown()
      jQuery(this).attr('data-status', 'open')
    } else if (status === 'open') {
      jQuery('.all-blog-cat-list', jQuery(this).parent()).slideUp()
      jQuery(this).attr('data-status', 'close')
    }
  })
})
