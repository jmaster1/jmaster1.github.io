var captchaOk = false;
var EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var NOT_EMPTY_REGEX = /([^\s])/;
function setCaptchaOk() {
    captchaOk = true;
    enableBtn();
}
function enableBtn() {
    let name = document.getElementById('name').value;
    let nameOk = NOT_EMPTY_REGEX.test(name);
    let email = document.getElementById('email').value;
    let emailOk = EMAIL_REGEX.test(email);
    let fieldsOk = nameOk && emailOk;
    console.log("nameOk=" + nameOk + ", emailOk=" + emailOk + ", captchaOk=" + captchaOk);
    document.getElementById("contactSubmit").disabled = !(captchaOk && fieldsOk);
}

setInterval(function () {
    let container = document.getElementById("wpcf7-f10-p97-o1");
    let rect = container.getBoundingClientRect();
    let formOverlay = document.getElementById("formOverlay");
    formOverlay.style.position = "absolute";
    formOverlay.style.width = rect.width + "px";
    formOverlay.style.height = rect.height + "px";
}, 200);
