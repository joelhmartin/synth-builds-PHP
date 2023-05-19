import Patch from './Patch.mjs'
import {patchDetailDisplay} from './patch-detail-display.mjs'

let params = new URLSearchParams(location.search);
let id = params.get('id');

function main() {
  fetch(`../php/patch-detail.php?id=${id}`)
    .then(response => response.json())
    .then(items => {
      let item = items[0];
      let patch = new Patch(item.patch_id, item.title, item.synth, item.genre, item.author);
      patch.setInstructions(item.instructions);
      patchDetailDisplay(patch);
    })
    .catch(error => {
      console.error('Error fetching patches:', error);
    });
}

main();