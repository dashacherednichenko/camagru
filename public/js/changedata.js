let register_button = document.getElementById('register_button');
let hidden_div = document.getElementsByClassName('hidden_div')[0];
let edit_img = document.getElementById('edit');
console.log('2', hidden_div.hidden);

function showPasswordDiv(){
    if (hidden_div.hidden == true) {
        hidden_div.hidden = false;
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