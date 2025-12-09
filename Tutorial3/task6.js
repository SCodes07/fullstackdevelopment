// Old way0
const movie =   { id: 1, title: "Inception", genre: "Sci-Fi", year: 2010 };

function displayMovie(movie) {
return movie.title + " (" + movie.year + ") - " + movie.genre;
}
// New way: Use template literals and destructuring
function displayMovieModern(movie) {
// Destructuring
const {title, genre, year} = movie;
return `${title} (${genre}) - ${year}`;

// Template literal
}
// Test it
console.log(displayMovieModern(movie));
console.log(displayMovie(movie));