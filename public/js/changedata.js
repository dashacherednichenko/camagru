let register_button = document.getElementById('register_button');
let hidden_div = document.getElementsByClassName('hidden_div')[0];
let edit_img = document.getElementById('edit');

function editInput(id)
{
    let input = document.getElementById(id);
    input.focus();
}

function showPasswordDiv(){
    if (hidden_div.hidden == true) {
        hidden_div.hidden = false;
        document.getElementById('password').focus();
        register_button.type="button";
        edit_img.src = '/camagru/public/images/cancel.png';
    }
    else if (hidden_div.hidden == false) {
        hidden_div.hidden = true;
        register_button.type="submit";
        edit_img.src = '/camagru/public/images/edit.png';
    }
};
let check = function() {
    if (document.getElementById('password').value ==
        document.getElementById('confirm_password').value &&
        document.getElementById('password').value != 0) {
        document.getElementById('message_error').style.color = 'green';
        document.getElementById('message_error').innerHTML = '';
        register_button.type="submit";
    } else {
        document.getElementById('message_error').style.color = 'red';
        document.getElementById('message_error').innerHTML = 'Confirm your password!';
        register_button.type="button";
    }
}

let change = document.getElementById('register_button');
let form = document.getElementById('form_register');
change.addEventListener("click", async function(e) {
    e.preventDefault();
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save", true);
    xhr.send(formData);
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            document.getElementById('change_message').innerHTML = xhr.responseText;
            if (xhr.responseText.indexOf("SUCCESS") != -1) {
                setInterval(function() {window.location.href = '/camagru/account'}, 1500);
            }
        }
    }
});