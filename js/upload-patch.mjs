import {searchSuggest} from './load-search-options.mjs'
import {handleForm} from './handle-form.mjs'

function main() {
  fetch('../php/load-data.php')
  .then(response => response.json())
  .then(patches => {
    searchSuggest(patches);
    handleForm(patches);
  })
  .catch(error => {
    console.error('Error fetching patches:', error);
  });

}

main();
