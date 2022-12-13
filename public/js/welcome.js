function openForm(id) {
    document.getElementById(id).style.display = 'block';
    document.getElementById('container').style.opacity = '0.2';
}

function closeForm(id) {
    document.getElementById(id).style.display = 'none';
    document.getElementById('container').style.opacity = '1';
}