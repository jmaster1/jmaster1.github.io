var captchaOk = false;
var captchaToken = null;
var EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var NOT_EMPTY_REGEX = /([^\s])/;

var form = document.getElementById('contactForm');
var fileSelect = document.getElementById('file');

form.onsubmit = function(event) {
    event.preventDefault();

    var files = fileSelect.files;
    var formData = new FormData();
    formData.append("captchaToken", captchaToken);
    formData.append("name", document.getElementById('name').value);
    formData.append("email", document.getElementById('email').value);
    formData.append("phone", document.getElementById('phone').value);
    formData.append("subject", document.getElementById('subject').value);
    formData.append("message", document.getElementById('message').value);
    if(files.length > 0) {
        let file = files[0];
        formData.append('file', file, file.name);
    }
    document.getElementById("contactForm").style.visibility = "hidden";
    document.getElementById("formOverlay").style.visibility = "visible";
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/sendmail.php', true);

    xhr.onload = function (e) {
        document.getElementById("messageSent").style.visibility = "visible";
        document.getElementById("spinner").style.visibility = "hidden";
        console.log("onload=" + e);
        if (xhr.status === 200) {

        } else {
            alert('An error occurred!');
        }
    };
    xhr.send(formData);
}

function setCaptchaOk(token) {
    captchaOk = true;
    captchaToken = token;
    console.log(token);
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
