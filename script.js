function changeSendCheck(event) {
    if (!event.target.checked) {
        document.getElementById("email").style.display = 'none';
        document.getElementById("email").removeAttribute('required');
    }
    else {
        document.getElementById("email").style.display = 'flex';
        document.getElementById("email").setAttribute('required', '');
    }
}