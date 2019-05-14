let video = document.getElementById('camera-stream');
let photo = document.getElementById('snap');
let photo_layout = document.getElementById('layout_img');
let superposable = document.getElementById('superposable_img');
let camera_on = document.getElementById('start-camera');
let controlsButtons = document.querySelector('.controls');
let take_photo_btn = document.getElementById('take-photo');
let delete_photo_btn = document.getElementById('delete-photo');
let save_photo_btn = document.getElementById('save-photo');
let error_message = document.getElementById('error-msg');

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

take_photo_btn.addEventListener("click", function(e){
    e.preventDefault();
    let my_photo = takeSnapshot();
    photo.setAttribute('src', my_photo);
    photo.classList.add("visible");
    delete_photo_btn.classList.remove("disabled");
    save_photo_btn.classList.remove("disabled");
    save_photo_btn.href = my_photo;
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
    // console.log('TEST', img.value);
}