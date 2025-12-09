const movies = [
{ id: 1, title: "Inception", genre: "Sci-Fi", year: 2010 },
{ id: 2, title: "The Green Mile", genre: "Crime", year: 1999 },
{ id: 3, title: "12 Angry Men", genre: "Thriller", year: 1957 }
];
// Challenge 1: Find all Sci-Fi movies
const sciFiMovies = movies.filter(movie => {
movies.genre==="Sci-Fi";
});
// Challenge 2: Get an array of just movie titles
const titles = movies.map(movie => {
// Your code here
});
// Challenge 3: Find the movie "Dune"

const duneMovie = movies.find(movie => {
// Your code here
});
// Challenge 4: Display each movie nicely
movies.forEach(movie => {
// Use template literals to create: "Inception (2010) - Sci-Fi"
});
console.log(sciFiMovies);
