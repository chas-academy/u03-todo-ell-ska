const registerInputPreview = (inputId, previewId, defaultValue) => {
  const input = document.getElementById(inputId)
  const preview = document.getElementById(previewId)

  input.addEventListener('change', () => {
    let previewText

    if (input instanceof HTMLInputElement) {
      previewText = input.value
    } else if (input instanceof HTMLSelectElement) {
      const selectedOption = input.selectedOptions[0].text
      previewText = selectedOption === defaultValue ? '' : selectedOption
    }

    if (previewText) {
      preview.innerHTML = previewText
      preview.classList.remove('hidden')
      preview.classList.add('visible')
    } else {
      preview.innerHTML = previewText
      preview.classList.remove('visible')
      preview.classList.add('hidden')
    }
  })
}

registerInputPreview('list', 'list-preview', 'No list')
registerInputPreview('scheduled', 'scheduled-preview')
registerInputPreview('deadline', 'deadline-preview')
