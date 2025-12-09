const newMovie = {
  title: "The Matrix",
  genre: "Sci-Fi",
  year: 1999
};
const jsonString = JSON.stringify(newMovie);
console.log("JSON String:", jsonString);
console.log("Type:", typeof jsonString);
const movieObject = JSON.parse(jsonString);
console.log("Object:", movieObject);
console.log("Type:", typeof movieObject);
console.log("Title:", movieObject.title);
