import List from './List.mjs'
import {searchSuggest} from './load-search-options.mjs'
import {storePatchButton, removeSaveButton} from './local-storage.mjs'

function main() {
  Promise.all([
    fetch('../php/load-data.php').then(response => response.json()),
    fetch('../php/get-user.php').then(response => response.json())
  ])
  .then(([patches, id]) => {
    let patchList = new List(patches);
    patchList.makeRecentList();
    patchList.filterList();
    searchSuggest(patches);
    storePatchButton(id);
    if (id === null) {
      removeSaveButton(id);
    }
    document.querySelector('#filter-search').addEventListener('submit', (evnt) => {
      evnt.preventDefault();
      patchList.filterList();
      if (id === null) {
        removeSaveButton(id);
      }
    });
  })
  .catch(error => {
    console.error('Error fetching patches:', error);
  });
}

main();