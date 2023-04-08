(function () {
  var shareButtons = document.querySelectorAll('.share-buttons .button')

  if (shareButtons) {
    [].forEach.call(shareButtons, function (button) {
      button.addEventListener('click', function (event) {
        var width = 650
        var height = 450

        event.preventDefault()

        window.open(this.href + window.location.href, 'Share Dialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=' + width + ',height=' + height + ',top=' + (window.screen.height / 2 - height / 2) + ',left=' + (window.screen.width / 2 - width / 2))
      })
    })
  }
})()
