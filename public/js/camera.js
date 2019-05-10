var video = document.querySelector('#camera-stream');
var photo = document.querySelector('#snap');
var start_camera = document.querySelector('#start-camera');
var controls = document.querySelector('.controls');
var take_photo_btn = document.querySelector('#take-photo');
var delete_photo_btn = document.querySelector('#delete-photo');
var save_photo_btn = document.querySelector('#save-photo');
var error_message = document.querySelector('#error-msg');

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

// Mobile browsers cannot play video without user input,
// so here we're using a button to start it manually.
start_camera.addEventListener("click", function(e){
    e.preventDefault();
    video.play();
    showVideo();

});

take_photo_btn.addEventListener("click", function(e){
    e.preventDefault();
    var my_photo = takeSnapshot();
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
    hideUI();
    video.classList.add("visible");
    controls.classList.add("visible");
}


function takeSnapshot(){
    var hidden_canvas = document.querySelector('canvas');
    var context = hidden_canvas.getContext('2d');
    var width = video.videoWidth;
    var height = video.videoHeight;

    if (width && height) {
        hidden_canvas.width = width;
        hidden_canvas.height = height;

        // Make a copy of the current frame in the video on the canvas.
        context.drawImage(video, 0, 0, width, height);
        return hidden_canvas.toDataURL('image/png');
    }
}

function displayErrorMessage(error_msg, error){
    error = error || "";
    if(error){
        console.log(error);
    }
    error_message.innerText = error_msg;
    hideUI();
    error_message.classList.add("visible");
}

function hideUI(){
    controls.classList.remove("visible");
    start_camera.classList.remove("visible");
    video.classList.remove("visible");
    snap.classList.remove("visible");
    error_message.classList.remove("visible");
}