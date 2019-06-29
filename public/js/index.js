
let changeNotification = function () {
    let inp = document.getElementById('notifications');
    let label = document.getElementById('notifications_label');
    let res;
    if (inp.checked) {
        label.innerHTML = 'yes=)';
        res = 1;
    }
    else {
        label.innerHTML = "no =(";
        res = 0;
    }

    var xhr = new XMLHttpRequest(),
        method = "GET",
        url = "account/changenotice?notice="+res;

    xhr.open(method, url, true);
    xhr.onreadystatechange = function () {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        };
    };
    xhr.send();

};