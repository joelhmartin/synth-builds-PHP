class Patch {

  constructor(id, title, synth, genre, author) {
    this.id = id;
    this.title = title;
    this.synth = synth;
    this.genre = genre;
    this.author = author;
    this.instructions = [];
  }

  setId(id) {
    this.id = id;
  }

  setAuthor(author) {
    this.author = author;
  }

  setSynth(synth) {
    this.synth = synth;
  }

  setTitle(title) {
    this.title = title;
  }

  setGenre(genre) {
    this.genre = genre;
  }

  setInstructions(instructions) {
    this.instructions = instructions;
  }

  getId() {
    return this.id;
  }

  getTitle() {
    return this.title;
  }

  getSynth() {
    return this.synth;
  }

  getGenre() {
    return this.genre;
  }

  getAuthor() {
    return this.author;
  }

  getInstructions() {
    let instructions = JSON.parse(this.instructions.replace(/&quot;/g, '"'));
    return instructions;
  }
  
}

export default Patch;