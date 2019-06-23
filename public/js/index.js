// console.log('testINDEX');

let show_comments = function(photo_id){
    let divcomment = document.getElementById('photo'+photo_id);
    divcomment.style.display="block";
    console.log('test', photo_id);
};

let close_window = function(photo_id){
    let divcomment = document.getElementById('photo'+photo_id);
    divcomment.style.display="none";
};

let changeNotification = function () {
    let inp = document.getElementById('notifications');
    let label = document.getElementById('notifications_label');
    if (inp.checked) {
        console.log('yes', inp);
        label.innerHTML = 'yes=)';
    }
    else {
        label.innerHTML = "no =(";
        console.log('no');
    }
};