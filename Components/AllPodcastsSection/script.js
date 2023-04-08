jQuery(document).ready(function () {
  function allPodcastInit (category = '') {
    jQuery('.all-blog-load-spinner').removeClass('hide')

    var page = 1
    var postsPerPage = jQuery('#all-podcast-navigation').attr('data-posts-per-page')
    var nonce = jQuery('#all-podcast-navigation').attr('data-nonce')

    jQuery.ajax({
      type: 'post',
      dataType: 'json',
      url: window.FlyntData.ajaxurl,
      data: {
        action: 'get_all_podcast_posts',
        nonce: nonce,
        page: page,
        postsPerPage: postsPerPage
      },
      success: function (response) {
        jQuery('#all-podcast-row').html(response.blog_html)
        jQuery('#all-podcast-navigation').html(response.page_nav_html)
        jQuery('#all-podcast-load-more-btn-row').html(response.load_more_btn)

        podcastNavigation()
        jQuery('.all-blog-load-spinner').addClass('hide')
      }
    })
  }

  if (jQuery('.all-podcast-section').length > 0) {
    allPodcastInit()
  }

  function podcastNavigation () {
    jQuery('#all-podcast-navigation a').click(function (e) {
      e.preventDefault()

      if (jQuery(this).parent().hasClass('active')) {
        return false
      }

      jQuery('.all-blog-load-spinner').removeClass('hide')

      var page = jQuery(this).attr('href').split('#')[1]
      var postsPerPage = jQuery('#all-podcast-navigation').attr('data-posts-per-page')
      var nonce = jQuery('#all-podcast-navigation').attr('data-nonce')

      jQuery.ajax({
        type: 'post',
        dataType: 'json',
        url: window.FlyntData.ajaxurl,
        data: {
          action: 'get_all_podcast_posts',
          nonce: nonce,
          page: page,
          postsPerPage: postsPerPage
        },
        success: function (response) {
          jQuery('#all-podcast-row').html(response.blog_html)
          jQuery('#all-podcast-navigation').html(response.page_nav_html)
          jQuery('#all-podcast-load-more-btn-row').html(response.load_more_btn)

          podcastNavigation()
          jQuery('.all-blog-load-spinner').addClass('hide')
        }
      })

      return false
    })

    jQuery('#all-podcast-load-more-btn').click(function (e) {
      e.preventDefault()

      jQuery('.all-blog-load-spinner').removeClass('hide')

      var page = jQuery(this).attr('data-next-page')
      var postsPerPage = jQuery('#all-podcast-navigation').attr('data-posts-per-page')
      var nonce = jQuery('#all-podcast-navigation').attr('data-nonce')

      jQuery.ajax({
        type: 'post',
        dataType: 'json',
        url: window.FlyntData.ajaxurl,
        data: {
          action: 'get_all_podcast_posts',
          nonce: nonce,
          page: page,
          postsPerPage: postsPerPage
        },
        success: function (response) {
          jQuery('#all-podcast-row').append(response.blog_html)
          jQuery('#all-podcast-navigation').html(response.page_nav_html)
          jQuery('#all-podcast-load-more-btn-row').html(response.load_more_btn)

          podcastNavigation()
          jQuery('.all-blog-load-spinner').addClass('hide')
        }
      })

      return false
    })
  }
})
