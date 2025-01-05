const registerBackButton = (buttonId) => {
  const backButton = document.getElementById(buttonId)

  if (!backButton) return

  backButton.addEventListener('click', () => {
    history.back()
  })
}

registerBackButton('back')
