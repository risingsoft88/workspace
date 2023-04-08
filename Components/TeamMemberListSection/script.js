jQuery(document).ready(function () {
  jQuery('.mobile-team-member-teammates-show-btn').click(function () {
    var parentElem = jQuery(this).parent().parent()
    jQuery(this).css('display', 'none')
    jQuery('.team-member-teammates', parentElem).css('display', 'block')
    jQuery('.team-member-teammates-row', parentElem).css('display', 'flex')

    return false
  })
})
