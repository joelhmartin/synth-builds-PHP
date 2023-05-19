function displayThanks() {
  let parent = document.querySelector('.main-section');
  let div = document.createElement('div');
  div.setAttribute('id', 'thanks')
  div.textContent = 'Thanks for the upload!';
  parent.appendChild(div);

  setTimeout(() => {
    div.remove();
  }, 2000);
}

function clearForm() {
  let inputs = document.querySelectorAll('input[type="text"]');
  inputs.forEach((input) => {
    input.value = '';
  })
  displayThanks();
}

function addStepButton(stepsContainer) {
  let addStepButton = document.getElementById('add-step-button');
  addStepButton.addEventListener('click', (evnt) => {
    evnt.preventDefault();
    let label = document.createElement('label');
    let input = document.createElement('input');
  
    input.setAttribute('class', 'step step-text');
    input.setAttribute('type', 'text');
  
    let stepRow = document.createElement('div');
    stepRow.setAttribute('class', 'step-row');
    stepRow.appendChild(label);
    stepRow.appendChild(input);
  
    stepsContainer.appendChild(stepRow);
  
    let inputElements = stepsContainer.querySelectorAll('input');
    inputElements.forEach((input, index) => {
      let setLabel = input.previousElementSibling;
      setLabel.textContent = `Step ${index + 1}`
    });
  
    let lastRow = stepsContainer.lastElementChild;
    lastRow.setAttribute('id', 'last-row');
    lastRow.previousElementSibling.removeAttribute('id', 'last-row');
  });
}

function removeStepButton(stepsContainer) {
  let removeStepButton = document.getElementById('remove-step-button')
  removeStepButton.addEventListener('click', (evnt) => {
    evnt.preventDefault();
    let lastStepRow = stepsContainer.lastChild;
    if (lastStepRow !== null) {
      stepsContainer.removeChild(lastStepRow);
    }
  })
}

function submitForm() {
  
  let form = document.querySelector('#upload-form');
  form.addEventListener('submit', (evnt) => {
      evnt.preventDefault();
      let title = document.querySelector('#title').value;
      let synth = document.querySelector('#synth').value;
      let genre = document.querySelector('#genre').value;
      let instructions = []
  
      let instructionSet = document.querySelectorAll('.step-row input[type="text"]')
      instructionSet.forEach(instruction => {
        instructions.push(instruction.value)
      });
  
      let formData = new FormData();
      formData.append('title', title);
      formData.append('synth', synth);
      formData.append('genre', genre);
      formData.append('instructions', JSON.stringify(instructions));
  
      fetch('../php/store-data.php', {
          method: 'POST',
          body: formData
      })

      clearForm();
  });
}

export function handleForm(patches) {
  let stepsContainer = document.querySelector('.steps-container');
  addStepButton(stepsContainer);
  removeStepButton(stepsContainer);
  submitForm();
}