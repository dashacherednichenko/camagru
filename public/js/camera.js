let video = document.getElementById('camera-stream');
let photo = document.getElementById('snap');
let photo_layout = document.getElementById('layout_img');
let photo_layout_div = document.getElementById('layout');
let inputPhoto = document.getElementById('userPhoto');
let formSnapButton = document.getElementById('formSnapButton');
let superposable = document.getElementById('superposable_img');
let camera_on = document.getElementById('start-camera');
let controlsButtons = document.querySelector('.controls');
let take_photo_btn = document.getElementById('take-photo');
let delete_photo_btn = document.getElementById('delete-photo');
let save_photo_btn = document.getElementById('save-photo');
let error_message = document.getElementById('error-msg');
let width_layout;
let height_layout;

navigator.getMedia = ( navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);

if(!navigator.getMedia){
    displayErrorMessage("Browser doesn't have support for the navigator.getUserMedia interface.");
}
else{
    navigator.getMedia(
        {
            video: true
        },
        function(stream){
            video.srcObject=stream;
            video.play();
            video.onplay = function() {
                showVideo();
            };
        },
        function(err){
            displayErrorMessage("An error with accessing the camera stream: " + err.name, err);
        }
    );
}

camera_on.addEventListener("click", function(e){
    e.preventDefault();
    video.play();
    showVideo();
});

take_photo_btn.addEventListener("click", async function(e){
    e.preventDefault();
    let my_photo = await takeSnapshot();
    photo.setAttribute('src', my_photo);
    photo.classList.add("visible");
    delete_photo_btn.classList.remove("disabled");
    save_photo_btn.classList.remove("disabled");
    save_photo_btn.href = my_photo;
    let img = await inputPhoto.setAttribute('value', my_photo);
    return formSnapButton.click();
});

delete_photo_btn.addEventListener("click", function(e){
    e.preventDefault();
    photo.setAttribute('src', "");
    photo.classList.remove("visible");
    delete_photo_btn.classList.add("disabled");
    save_photo_btn.classList.add("disabled");
});

function showVideo(){
    cleanSnapPage();
    video.classList.add("visible");
    superposable.classList.add("visible");
    controlsButtons.classList.add("visible");
}

function takeSnapshot(){
    let hidden_canvas = document.querySelector('canvas');
    let context = hidden_canvas.getContext('2d');
    let width = video.videoWidth;
    let height = video.videoHeight;

    if (width && height) {
        hidden_canvas.width = width;
        hidden_canvas.height = height;

        // Make a copy of the current frame in the video on the canvas.
        context.drawImage(video, 0, 0, width, height);
        return hidden_canvas.toDataURL('image/png');
    }
}

function displayErrorMessage(error_msg, error){
    // error = error || "";
    // if(error)
    //     console.log('error: ',error);
    error_message.innerText = error_msg;
    cleanSnapPage();
    error_message.classList.add("visible");
}

function cleanSnapPage(){
    controlsButtons.classList.remove("visible");
    superposable.classList.remove("visible");
    camera_on.classList.remove("visible");
    video.classList.remove("visible");
    photo.classList.remove("visible");
    error_message.classList.remove("visible");
}

function makePhotoButtonActiv(img) {
    if (take_photo_btn.className == 'disabled') {
        take_photo_btn.classList.remove("disabled");
        take_photo_btn.classList.add("visible");
    }
    photo_layout.setAttribute('src', img.value);
    width_layout = photo_layout_div.offsetWidth;
    height_layout = photo_layout_div.offsetHeight;
    console.log('TEST', width_layout);
    console.log('TEST2', height_layout);
}

photo_layout_div.ondragstart = function() {
    return false;
};

photo_layout_div.onmousedown = function(e) {
    photo_layout_div.style.position = 'absolute';
    moveAt(e);
    document.body.appendChild(photo_layout_div);
    photo_layout_div.style.zIndex = '90';
    function moveAt(e) {
        photo_layout_div.style.left = e.pageX - width_layout/2 + 'px';
        photo_layout_div.style.top = e.pageY - height_layout/2 + 'px';
    };

    document.onmousemove = function(e) {
        moveAt(e);
    };

    photo_layout_div.onmouseup = function() {
        document.onmousemove = null;
        photo_layout_div.onmouseup = null;
    };
};

