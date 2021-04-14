function changeSendCheck(event) {
    console.log(this, event);
    if (!this.checked) document.getElementById("email").style.display = 'none';
    else  document.getElementById("email").style.display = 'flex';
}