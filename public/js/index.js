// console.log('testINDEX');



let changeNotification = function () {
    let inp = document.getElementById('notifications');
    let label = document.getElementById('notifications_label');
    let res;
    if (inp.checked) {
        // console.log('yes', inp);
        label.innerHTML = 'yes=)';
        res = 1;
    }
    else {
        label.innerHTML = "no =(";
        res = 0;
        // console.log('no');
    }

    var xhr = new XMLHttpRequest(),
        method = "GET",
        url = "account/changenotice?notice="+res;

    xhr.open(method, url, true);
    xhr.onreadystatechange = function () {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // console.log(xhr.responseText);
        };
    };
    xhr.send();

    // if (inp.checked) {
    //     // console.log('yes', inp);
    //     label.innerHTML = 'yes=)';
    // }
    // else {
    //     label.innerHTML = "no =(";
    //     // console.log('no');
    // }
};