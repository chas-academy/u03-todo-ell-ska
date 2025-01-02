const registerDatePreview = (inputId, previewId, emptyText) => {
  const input = document.getElementById(inputId)
  const preview = document.getElementById(previewId)

  input.addEventListener('change', () => {
    const previewText = input.value ? input.value : emptyText
    preview.innerHTML = previewText
  })
}

const registerSelectPreview = (
  selectId,
  previewId,
  defaultOption,
  defaultOptionReplacement
) => {
  const select = document.getElementById(selectId)
  const preview = document.getElementById(previewId)

  select.addEventListener('change', () => {
    const previewText =
      select.selectedOptions[0].text === defaultOption
        ? defaultOptionReplacement
        : select.selectedOptions[0].text

    preview.innerHTML = previewText
  })
}

registerSelectPreview('list', 'list-preview', 'No list', 'List')
registerDatePreview('scheduled', 'scheduled-preview', 'Scheduled')
registerDatePreview('deadline', 'deadline-preview', 'Deadline')
