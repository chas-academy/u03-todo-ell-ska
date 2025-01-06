const registerInputPreview = (inputId, previewId, defaultValue) => {
  const input = document.getElementById(inputId)
  const preview = document.getElementById(previewId)

  input.addEventListener('change', () => {
    let previewText

    if (input instanceof HTMLInputElement) {
      if (stringIsDate(input.value)) {
        previewText = getRelativeDate(input.value)
      } else {
        previewText = input.value
      }
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

const stringIsDate = (string) => {
  const date = new Date(string)
  return date !== 'Invalid Date' && !isNaN(date)
}

const getRelativeDate = (dateString) => {
  const date = new Date(dateString)
  date.setHours(0, 0, 0, 0)
  const currentDate = new Date()
  currentDate.setHours(0, 0, 0, 0)

  const differenceDays = Math.round(
    (currentDate - date) / (1000 * 60 * 60 * 24)
  )

  switch (differenceDays) {
    case 0:
      return 'Today'
    case 1:
      return 'Yesterday'
    case -1:
      return 'Tomorrow'
  }

  const year = date.getFullYear()
  const currentYear = currentDate.getFullYear()

  return date.toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: currentYear !== year ? 'numeric' : undefined,
  })
}

registerInputPreview('list', 'list-preview', 'No list')
registerInputPreview('scheduled', 'scheduled-preview')
registerInputPreview('deadline', 'deadline-preview')
