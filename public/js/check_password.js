var check = function() {
    var register_button = document.getElementById('register_button');
    if (document.getElementById('password').value ==
        document.getElementById('confirm_password').value &&
        document.getElementById('password').value != 0) {
        document.getElementById('message_error').style.color = 'green';
        document.getElementById('message_error').innerHTML = '';
        // register_button.setAttribute('style', 'display:inline-block');
        register_button.type="submit";
    } else {
        document.getElementById('message_error').style.color = 'red';
        document.getElementById('message_error').innerHTML = 'Confirm your password!';
        // register_button.setAttribute('style', 'display:none');
        register_button.type="button";
    }
}