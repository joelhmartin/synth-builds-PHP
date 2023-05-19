export function removeSaveButton() {
  let buttons = document.querySelectorAll('.save-patch-button');
  buttons.forEach((button) => {
    button.textContent = 'LOG IN TO SAVE PATCHES';
  })
}

export function removeSomeSaveButtons() {
  let browse = document.querySelector('.browse');
  let buttons = browse.querySelectorAll('.save-patch-button');
  buttons.forEach((button) => {
    button.remove();
  });
}

export function storePatchButton(currentId) {
  // Create the item in localStorage if it doesn't exist
  if (!localStorage.getItem(`savedPatches-${currentId}`)) {
    localStorage.setItem(`savedPatches-${currentId}`, JSON.stringify([]));
  }
  let saveButtons = document.querySelectorAll('.save-patch-button');
  saveButtons.forEach((button) => {
    button.addEventListener('click', (evnt) => {
      evnt.preventDefault();
      let itemId = parseInt(evnt.target.value);
      let savedPatches = JSON.parse(localStorage.getItem(`savedPatches-${currentId}`)) || [];
      if (!savedPatches.includes(itemId)) {
        savedPatches.push(itemId);
        button.innerHTML = 'SAVE IT &#x2713;';
      } else {
        button.innerHTML = 'SAVE IT &#x2713;';
      }

      localStorage.setItem(`savedPatches-${currentId}`, JSON.stringify(savedPatches));
    })
  })
}

export function loadStoredPatches(patches, currentId) {
  let savedPatches = JSON.parse(localStorage.getItem(`savedPatches-${currentId}`)) || [];
  let filteredPatches = [];
  patches.forEach((patch) => {
    savedPatches.forEach((savedPatch) => {
      console.log('patch_id:', patch.patch_id, 'savedPatch:', savedPatch);
      if (patch.patch_id === savedPatch) {
        filteredPatches.push(patch);
      }
    })
  })
  return filteredPatches;
}

