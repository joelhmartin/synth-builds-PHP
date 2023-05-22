function displayPatch(patch) {
  let title = document.createElement('span');
  let synth = document.createElement('span');
  let genre = document.createElement('span');
  let author = document.createElement('span');

  title.textContent = patch.getTitle();
  synth.textContent = patch.getSynth();
  genre.textContent = patch.getGenre();
  author.textContent = patch.getAuthor();

  let titleP = document.querySelector('#title');
  let synthP = document.querySelector('#synth');
  let genreP = document.querySelector('#genre');
  let authorP = document.querySelector('#author');

  titleP.appendChild(title);
  synthP.appendChild(synth);
  genreP.appendChild(genre);
  authorP.appendChild(author);
}

function makeInstructionList(instructions) {
  let stepsContainer = document.querySelector('.steps-container');
  
  instructions.forEach((instruction) => {
    let stepRow = document.createElement('div');
    let stepNum = document.createElement('span');
    let stepText = document.createElement('span');

    stepText.setAttribute('class', 'step step-text');
    stepNum.setAttribute('class', 'step step-num');
    stepRow.setAttribute('class', 'step-row');
    stepText.textContent = instruction;
  
    stepRow.appendChild(stepNum);
    stepRow.appendChild(stepText);
    stepsContainer.appendChild(stepRow);
  })
  
  let inputElements = stepsContainer.querySelectorAll('.step-num');
  inputElements.forEach((input, index) => {
    input.textContent = `Step ${index + 1}`;
  });

  let lastRow = stepsContainer.lastElementChild;
  lastRow.setAttribute('id', 'last-row');
  lastRow.previousElementSibling.removeAttribute('id', 'last-row');

}



export function patchDetailDisplay(patch) {
  makeInstructionList(patch.getInstructions());
  displayPatch(patch);
}