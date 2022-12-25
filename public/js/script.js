function openForm(id) {
    document.getElementById(id).style.display = 'block';
    document.getElementById('welcome-container').style.opacity = '0.2';
}

function closeForm(id) {
    document.getElementById(id).style.display = 'none';
    document.getElementById('welcome-container').style.opacity = '1';
}

function requestAddWatchedMovie(movie) {
    let request = new XMLHttpRequest();
    request.open("GET", "../requests/add-watched-movie.php?movie=" + movie, true);
    request.send();
    window.location.reload();
}

function requestRemoveWatchedMovie(movie) {
    let request = new XMLHttpRequest();
    request.open("GET", "../requests/remove-watched-movie.php?movie=" + movie, true);
    request.send();
    window.location.reload();
}