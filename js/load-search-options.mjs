function filterOptions(searchTerm, dataArray) {
  if (searchTerm.trim() === '') {
    return [];
  }
  // Filters the list based on input and removes duplicates
  return dataArray.filter(option => option.toLowerCase().startsWith(searchTerm.toLowerCase()))
                  .filter((value, index, self) => self.indexOf(value) === index);
}

function displayOptions(options, optionsContainer, searchInput) {
  optionsContainer.innerHTML = ''
  // Fill suggestions list as they type
  options.forEach(option => {
    let optionElement = document.createElement('div');
    optionElement.classList.add('option-item')
    optionElement.textContent = option;
    optionElement.addEventListener('click', () => {
      // Set search input value to selected option
      searchInput.value = option;
      // Clear options container
      optionsContainer.innerHTML = '';
    });
    optionsContainer.appendChild(optionElement);
    clearSuggestions(optionsContainer, searchInput)
  });
};

// Clear options container for all input fields when user clicks outside
function clearSuggestions(optionsContainer, searchInput) {
  document.addEventListener('click', (evnt) => {
    if (!evnt.target !== optionsContainer && !evnt.target !== searchInput) {
        optionsContainer.innerHTML = '';
    }
  });
}

export function searchSuggest(data) {
  let searchFields = document.querySelectorAll('.search-field');
  searchFields.forEach((searchField) => {
    searchField.addEventListener('keyup', (evnt) => {
      let field = evnt.target.id;
      let searchTerm = evnt.target.value;
      let dataArray = data.map(patch => patch[field]);
      let optionsContainer = searchField.parentElement.nextElementSibling
      let filteredOptions = filterOptions(searchTerm, dataArray);
      displayOptions(filteredOptions, optionsContainer, searchField);
    });
  });
}