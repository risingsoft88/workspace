jQuery(document).ready(function () {
  function relatedPodcastsInit () {
    var page = 1
    var postsPerPage = jQuery('#related-podcasts-navigation').attr('data-posts-per-page')
    var nonce = jQuery('#related-podcasts-navigation').attr('data-nonce')
    var currentPostId = jQuery('#related-podcasts-row').attr('data-current-post-id')

    jQuery.ajax({
      type: 'post',
      dataType: 'json',
      url: window.FlyntData.ajaxurl,
      data: {
        action: 'get_related_podcasts',
        nonce: nonce,
        page: page,
        postsPerPage: postsPerPage,
        currentPostId: currentPostId
      },
      success: function (response) {
        jQuery('#related-podcasts-row').html(response.blog_html)
        jQuery('#related-podcasts-navigation').html(response.page_nav_html)
        jQuery('#related-podcasts-load-more-btn-row').html(response.load_more_btn)

        relatedPodcastsNavigation()
      }
    })
  }

  if (jQuery('.related-podcasts-section').length > 0) {
    relatedPodcastsInit()
  }

  function relatedPodcastsNavigation () {
    jQuery('#related-podcasts-navigation a').click(function (e) {
      e.preventDefault()

      if (jQuery(this).parent().hasClass('active')) {
        return false
      }

      var page = jQuery(this).attr('href').split('#')[1]
      var postsPerPage = jQuery('#related-podcasts-navigation').attr('data-posts-per-page')
      var nonce = jQuery('#related-podcasts-navigation').attr('data-nonce')
      var currentPostId = jQuery('#related-podcasts-row').attr('data-current-post-id')

      jQuery('#related-podcasts-row').addClass('spinner')

      jQuery.ajax({
        type: 'post',
        dataType: 'json',
        url: window.FlyntData.ajaxurl,
        data: {
          action: 'get_related_podcasts',
          nonce: nonce,
          page: page,
          postsPerPage: postsPerPage,
          currentPostId: currentPostId
        },
        success: function (response) {
          jQuery('#related-podcasts-row').html(response.blog_html)
          jQuery('#related-podcasts-navigation').html(response.page_nav_html)
          jQuery('#related-podcasts-load-more-btn-row').html(response.load_more_btn)

          relatedPodcastsNavigation()

          jQuery('#related-podcasts-row').removeClass('spinner')
        }
      })

      return false
    })

    jQuery('#related-podcasts-load-more-btn').click(function (e) {
      e.preventDefault()

      var page = jQuery(this).attr('data-next-page')
      var postsPerPage = jQuery('#related-podcasts-navigation').attr('data-posts-per-page')
      var nonce = jQuery('#related-podcasts-navigation').attr('data-nonce')
      var currentPostId = jQuery('#related-podcasts-row').attr('data-current-post-id')

      jQuery(this).addClass('spinner')

      jQuery.ajax({
        type: 'post',
        dataType: 'json',
        url: window.FlyntData.ajaxurl,
        data: {
          action: 'get_related_podcasts',
          nonce: nonce,
          page: page,
          postsPerPage: postsPerPage,
          currentPostId: currentPostId
        },
        success: function (response) {
          jQuery('#related-podcasts-row').append(response.blog_html)
          jQuery('#related-podcasts-navigation').html(response.page_nav_html)
          jQuery('#related-podcasts-load-more-btn-row').html(response.load_more_btn)

          relatedPodcastsNavigation()
          jQuery(this).removeClass('spinner')
        }
      })

      return false
    })
  }
})
