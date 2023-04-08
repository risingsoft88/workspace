jQuery(document).ready(function () {
  function relatedPostsInit () {
    var page = 1
    var postsPerPage = jQuery('#related-posts-navigation').attr('data-posts-per-page')
    var nonce = jQuery('#related-posts-navigation').attr('data-nonce')
    var cat = jQuery('#related-posts-navigation').attr('data-cat')
    var currentPostId = jQuery('#related-posts-row').attr('data-current-post-id')

    jQuery.ajax({
      type: 'post',
      dataType: 'json',
      url: window.FlyntData.ajaxurl,
      data: {
        action: 'get_related_posts',
        nonce: nonce,
        cat: cat,
        page: page,
        postsPerPage: postsPerPage,
        currentPostId: currentPostId
      },
      success: function (response) {
        jQuery('#related-posts-row').html(response.blog_html)
        jQuery('#related-posts-navigation').html(response.page_nav_html)
        jQuery('#related-posts-load-more-btn-row').html(response.load_more_btn)

        relatedPostsNavigation()
      }
    })
  }

  if (jQuery('.related-posts-section').length > 0) {
    relatedPostsInit()
  }

  function relatedPostsNavigation () {
    jQuery('#related-posts-navigation a').click(function (e) {
      e.preventDefault()

      if (jQuery(this).parent().hasClass('active')) {
        return false
      }

      var page = jQuery(this).attr('href').split('#')[1]
      var postsPerPage = jQuery('#related-posts-navigation').attr('data-posts-per-page')
      var nonce = jQuery('#related-posts-navigation').attr('data-nonce')
      var cat = jQuery('#related-posts-navigation').attr('data-cat')
      var currentPostId = jQuery('#related-posts-row').attr('data-current-post-id')

      jQuery('#related-posts-row').addClass('spinner')

      jQuery.ajax({
        type: 'post',
        dataType: 'json',
        url: window.FlyntData.ajaxurl,
        data: {
          action: 'get_related_posts',
          nonce: nonce,
          page: page,
          postsPerPage: postsPerPage,
          cat: cat,
          currentPostId: currentPostId
        },
        success: function (response) {
          jQuery('#related-posts-row').html(response.blog_html)
          jQuery('#related-posts-navigation').html(response.page_nav_html)
          jQuery('#related-posts-load-more-btn-row').html(response.load_more_btn)

          relatedPostsNavigation()

          jQuery('#related-posts-row').removeClass('spinner')
        }
      })

      return false
    })

    jQuery('#related-posts-load-more-btn').click(function (e) {
      e.preventDefault()

      var page = jQuery(this).attr('data-next-page')
      var postsPerPage = jQuery('#related-posts-navigation').attr('data-posts-per-page')
      var nonce = jQuery('#related-posts-navigation').attr('data-nonce')
      var cat = jQuery('#related-posts-navigation').attr('data-cat')
      var currentPostId = jQuery('#related-posts-row').attr('data-current-post-id')

      jQuery(this).addClass('spinner')

      jQuery.ajax({
        type: 'post',
        dataType: 'json',
        url: window.FlyntData.ajaxurl,
        data: {
          action: 'get_related_posts',
          nonce: nonce,
          page: page,
          postsPerPage: postsPerPage,
          cat: cat,
          currentPostId: currentPostId
        },
        success: function (response) {
          jQuery('#related-posts-row').append(response.blog_html)
          jQuery('#related-posts-navigation').html(response.page_nav_html)
          jQuery('#related-posts-load-more-btn-row').html(response.load_more_btn)

          relatedPostsNavigation()
          jQuery(this).removeClass('spinner')
        }
      })

      return false
    })
  }
})
