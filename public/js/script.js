function openForm(id) {
    document.getElementById(id).style.display = 'block';
    document.getElementById('container').style.opacity = '0.2';
}

function closeForm(id) {
    document.getElementById(id).style.display = 'none';
    document.getElementById('container').style.opacity = '1';
}

function changeIconColor(id) {
    const icon = document.getElementById(id);
    if (icon.classList.contains('change-icon-color')) {
        icon.classList.remove('change-icon-color');
    } else {
        icon.classList.add('change-icon-color');
    }
}