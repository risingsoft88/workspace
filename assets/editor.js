/**
 * Add custom guternbug block for podcast
 * for this we can review the wordpress standard : gutenberg-trunk\packages\block-library\src\html
 */
(function () {
  const el = window.wp.element.createElement
  const { registerBlockType } = window.wp.blocks

  registerBlockType('podcast/html', {
    title: 'PodCast Custom HTML',
    description: 'Please add the podcast iframe to here',
    icon: 'megaphone',
    category: 'widgets',
    keywords: ['podcast', 'iframe', 'html'],
    example: {
      attributes: {
        content: '<marquee>Welcome to the wonderful world of blocks…</marquee>'
      }
    },
    attributes: {
      content: {
        type: 'string'
      }
    },
    edit: function (props) {
      const { PlainText } = window.wp.editor

      return (
        el(
          'div',
          { className: props.className + ' wp-block-html' },
          el(
            PlainText,
            {
              value: props.attributes.content,
              onChange: (content) => {
                // console.log('%cchange', 'background-color: #ff0000;color:#fff;', content)
                props.setAttributes({ content })
              },
              placeholder: 'Write Podcast iframe...',
              'aria-label': 'HTML'
            }
          )
        )
      )
    },
    save: function (props) {
      const { RawHTML } = window.wp.element

      // console.log('%csave', 'background-color:#0000ff;color:#fff;', props.attributes.content)
      return (
        el(
          'div',
          { className: 'podcast-iframe-wrapper' },
          el(
            RawHTML,
            null,
            props.attributes.content
          )
        )
      )
    }
  })
})()
