import List from './List.mjs'
import {searchSuggest} from './load-search-options.mjs'
import {loadStoredPatches, storePatchButton, removeSomeSaveButtons} from './local-storage.mjs'

function main() {
  Promise.all([
    fetch('../php/load-data.php').then(response => response.json()),
    fetch('../php/get-user.php').then(response => response.json()),
    fetch('../php/get-username.php').then(response => response.json())
  ])
  .then(([patches, id, username]) => {
    let fullList = new List(patches);
    fullList.makeUserUploadsList(username);
    searchSuggest(patches);
    storePatchButton(id);
    return loadStoredPatches(patches, id)
  })
  .then((storedPatches) => {
    let patchList = new List(storedPatches);
    patchList.filterList();
    removeSomeSaveButtons();
    document.querySelector('#filter-search').addEventListener('submit', (evnt) => {
      evnt.preventDefault();
      patchList.filterList();
      removeSomeSaveButtons();
    });
  })
  .catch(error => {
    console.error('Error fetching patches:', error);
  });
}

main();