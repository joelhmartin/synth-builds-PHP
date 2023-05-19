import Patch from './Patch.mjs'

class List {
  constructor(listItems) {
    this.listItems = listItems;
    this.list = this.makeList(listItems);
    this.filteredList = this.makeList(listItems);
  }

  makeList() {
    let list = [];
    for (let item of this.listItems) {
      let patch = new Patch(item.patch_id, item.title, item.synth, item.genre, item.author);
      patch.setInstructions(item.instructions);
      list.push(patch); 
    }
    return list;
  }

  // Makes a list of the 15 most recent uploads
  makeRecentList() {
    let recentSection = '.recents';
    let recentList = this.list.slice(-15).concat([]);
    recentList.reverse();
    this.displayList(recentList, recentSection);
  }

  makeUserUploadsList(username) {
    let uploadSection = '.uploads';
    let userUploads = this.list
      .filter(patch => {
        if (patch.author === username) {
          return patch;
        }
      });
    this.displayList(userUploads, uploadSection);
  }

  filterList() {
    let titleChoice = document.getElementById("title").value;
    let genreChoice = document.getElementById("genre").value;
    let synthChoice = document.getElementById("synth").value;
    let authorChoice = document.getElementById("author").value;

    let filteredList = this.list
    .filter(patch => {
      if (!genreChoice) {
        return patch;
      } else {
        return patch.genre === genreChoice;
      }
    })
    .filter(patch => {
      if (!synthChoice) {
        return patch;
      } else {
        return patch.synth === synthChoice;
      }
    })
    .filter(patch => {
      if (!titleChoice) {
        return patch;
      } else {
        return patch.title === titleChoice;
      }
    })
    .filter(patch => {
      if (!authorChoice) {
        return patch;
      } else {
        return patch.author === authorChoice;
      }
    })

    let filterSection = '.browse'
    this.filteredList = filteredList;
    this.displayList(this.filteredList, filterSection);
  }

  createDetailButton(id) {
    let form = document.createElement('form');
    let button = document.createElement('button');
    let input = document.createElement('input');
  
    button.classList.add('get-detail-button');
    button.textContent = 'CHECK IT OUT';
  
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'id');
    input.setAttribute('value', id);
  
    form.setAttribute('action', '../php/detail.php');
    form.setAttribute('method', 'get');
    form.appendChild(input);
    form.appendChild(button);
  
    return form;
  }

  createSaveButton(id) {
    let button = document.createElement('button');
    button.classList.add('save-patch-button');
    button.textContent = 'SAVE IT';
    button.setAttribute('value', id);
  
    return button;
  }

  createSynthSection(chosenList, chosenSection) {
    let synthSection = document.querySelector(chosenSection);
    let patchList = chosenList;

    for (let patch of patchList) {
      let entry = document.createElement('div');
      let detailButton = this.createDetailButton(patch.getId())
      let saveButton = this.createSaveButton(patch.getId())

      let title = document.createElement('div');
      let synth = document.createElement('div');
      let genre = document.createElement('div');
      let author = document.createElement('div');

      entry.classList.add('patch-container');
      
      title.textContent = patch.title;
      synth.textContent = patch.synth;
      genre.textContent = 'Genre: ' + patch.genre;
      author.textContent = 'User: ' + patch.author;

      entry.appendChild(title);
      entry.appendChild(synth);
      entry.appendChild(genre);
      entry.appendChild(author);
      entry.appendChild(detailButton)
      entry.appendChild(saveButton);
      synthSection.appendChild(entry);
    }
  }

  clearList(chosenSection) {
    let synthSection = document.querySelector(chosenSection);
    synthSection.innerHTML = ''
  }

  displayList(chosenList, chosenSection) {
    this.clearList(chosenSection);
    this.createSynthSection(chosenList, chosenSection)
  }

}

export default List