const registerModal = (modalId, openButtonId, overlayId) => {
  const modal = document.getElementById(modalId)
  const openButton = document.getElementById(openButtonId)
  const overlay = document.getElementById(overlayId)

  openButton.addEventListener('click', () => {
    modal.classList.remove('hidden')
    modal.classList.add('visible')

    overlay.classList.remove('hidden')
    overlay.classList.add('visible')
  })

  overlay.addEventListener('click', () => {
    modal.classList.remove('visible')
    modal.classList.add('hidden')

    overlay.classList.remove('visible')
    overlay.classList.add('hidden')
  })
}

registerModal('add-task-modal', 'open-add-task-modal', 'add-task-overlay')
