const API_URL = 'http://localhost:3000/movies';

const movieListDiv = document.getElementById('movie-list');
const searchInput = document.getElementById('search-input');
const form = document.getElementById('add-movie-form');

let allMovies = [];

// Render Movies
function renderMovies(moviesToDisplay) {
    movieListDiv.innerHTML = '';

    if (moviesToDisplay.length === 0) {
        movieListDiv.innerHTML = '<p>No movies found matching your criteria.</p>';
        return;
    }

    moviesToDisplay.forEach(movie => {
        const movieElement = document.createElement('div');
        movieElement.classList.add('movie-item');

        movieElement.innerHTML = `
            <p><strong>${movie.title}</strong> (${movie.year}) - ${movie.genre}</p>

            <div class="actions">
                <button class="edit-btn"
                    onclick="editMoviePrompt(${movie.id}, '${movie.title}', ${movie.year}, '${movie.genre}')">
                    Edit
                </button>

                <button class="delete-btn"
                    onclick="deleteMovie(${movie.id})">
                    Delete
                </button>
            </div>
        `;

        movieListDiv.appendChild(movieElement);
    });
}

// Fetch Movies
function fetchMovies() {
    fetch(API_URL)
        .then(response => response.json())
        .then(movies => {
            allMovies = movies;
            renderMovies(allMovies);
        })
        .catch(error => console.error('Error fetching movies:', error));
}

// Initial load
fetchMovies();

// Search
searchInput.addEventListener('input', function () {
    const searchTerm = searchInput.value.toLowerCase();

    const filteredMovies = allMovies.filter(movie =>
        movie.title.toLowerCase().includes(searchTerm) ||
        movie.genre.toLowerCase().includes(searchTerm)
    );

    renderMovies(filteredMovies);
});

// Add Movie
form.addEventListener('submit', function (event) {
    event.preventDefault();

    const newMovie = {
        title: document.getElementById('title').value,
        genre: document.getElementById('genre').value,
        year: parseInt(document.getElementById('year').value)
    };

    fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(newMovie),
    })
        .then(response => response.json())
        .then(() => {
            form.reset();
            fetchMovies();
        })
        .catch(error => console.error('Error adding movie:', error));
});

// Edit Movie Prompt
function editMoviePrompt(id, currentTitle, currentYear, currentGenre) {
    const newTitle = prompt('Enter new Title:', currentTitle);
    const newYearStr = prompt('Enter new Year:', currentYear);
    const newGenre = prompt('Enter new Genre:', currentGenre);

    if (newTitle && newYearStr && newGenre) {
        const updatedMovie = {
            title: newTitle,
            year: parseInt(newYearStr),
            genre: newGenre
        };

        updateMovie(id, updatedMovie);
    }
}

// Update Movie
function updateMovie(movieId, updatedMovieData) {
    fetch(`${API_URL}/${movieId}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(updatedMovieData),
    })
        .then(response => response.json())
        .then(() => fetchMovies())
        .catch(error => console.error('Error updating movie:', error));
}

// Delete Movie (FULLY FIXED)
function deleteMovie(movieId) {
    fetch(`${API_URL}/${movieId}`, {
        method: 'DELETE'
    })
        .then(response => {
            if (!response.ok) throw new Error('Failed to delete movie');
            return response;
        })
        .then(() => fetchMovies())
        .catch(error => console.error('Error deleting movie:', error));
}
