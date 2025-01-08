const registerModal = (modalId, openButtonId, closeButtonId, showOverlay) => {
  const modal = document.getElementById(modalId)
  const openButton = document.getElementById(openButtonId)

  if (!modal || !openButton) return

  const closeButton = document.getElementById(closeButtonId)
  const overlay = showOverlay ? document.getElementById('overlay') : null

  const open = () => {
    modal.classList.remove('hidden')
    modal.classList.add('visible')

    overlay?.classList.remove('hidden')
    overlay?.classList.add('visible')
  }

  const close = () => {
    modal.classList.remove('visible')
    modal.classList.add('hidden')

    overlay?.classList.remove('visible')
    overlay?.classList.add('hidden')
  }

  openButton.addEventListener('click', open)

  overlay?.addEventListener('click', close)
  closeButton?.addEventListener('click', close)
}

registerModal('add-task-modal', 'open-add-task-modal', null, true)
registerModal('add-list-modal', 'open-add-list-modal', null, true)
registerModal('sidebar', 'open-sidebar', 'close-sidebar', false)
