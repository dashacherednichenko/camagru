let video = document.getElementById('camera-stream');
let video_div = document.getElementById('camera-stream-div');
let photo = document.getElementById('snap');
let photo_layout = document.getElementById('layout_img');
let photo_layout_div = document.getElementById('layout');
let inputPhoto = document.getElementById('userPhoto');
let formSnapButton = document.getElementById('formSnapButton');
let superposable = document.getElementById('superposable_img');
let camera_on = document.getElementById('start-camera');
let controlsButtons = document.getElementById('take-photo-div');
let saveDel = document.getElementById('saveDelete');
let take_photo_btn = document.getElementById('take-photo');
let delete_photo_btn = document.getElementById('delete-photo');
let save_photo_btn = document.getElementById('save-photo');
let error_message = document.getElementById('error-msg');
let width_layout;
let height_layout;

photo_layout_div.style.left = '300px';
photo_layout_div.style.top = '200px';

navigator.getMedia = ( navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);

// console.log(photo.src);
if (photo.src )
{
    var host = photo.src.split('/camagru/')
    // console.log("test", host);
    if (host[1] != '')
    {
        document.getElementById('h_notsaved').hidden = false;
        document.getElementById('saveDelete').hidden = false;
        photo.style.zIndex = '1000';
        delete_photo_btn.classList.remove("disabled");
        save_photo_btn.classList.remove("disabled");
        saveDel.classList.remove("disabled");
    }
}

function startVideo() {
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
}

camera_on.addEventListener("click", function(e){
    e.preventDefault();
    video.play();
    showVideo();
});

take_photo_btn.addEventListener("click", async function(e){
    e.preventDefault();
    let my_photo = await takeSnapshot();
    let img = await inputPhoto.setAttribute('value', my_photo);
    await document.getElementById('maskWidth').setAttribute('value',  width_layout);
    await document.getElementById('maskHeight').setAttribute('value',  height_layout);
    let video_crd = getCoords(photo_layout_div);
    let mask_crd = getCoords(video);
    let left = video_crd['left'] - mask_crd['left'];
    let top = video_crd['top'] - mask_crd['top'];
    // await document.getElementById('videoLeft').setAttribute('value',  video_crd['left']);
    // await document.getElementById('videoTop').setAttribute('value',  video_crd['top']);
    await document.getElementById('maskLeft').setAttribute('value',  left);
    await document.getElementById('maskTop').setAttribute('value',  top);
    return formSnapButton.click();
});

function submitHandlerDelete(e) {
    e.preventDefault();
    let request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        console.log("readyState=", this.readyState, "statis=", this.status);
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            photo.setAttribute('src', "");
            photo.classList.remove("visible");
            delete_photo_btn.classList.add("disabled");
            save_photo_btn.classList.add("disabled");
            document.getElementById('h_notsaved').hidden = true;
            document.getElementById('saveDelete').hidden = true;
            console.log("SUCCESS", this);
            // console.log("SUCCESS", request.responseText);
        }
    }
    request.open(this.method, this.action, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    let data = new FormData(this);
    // for (let key of data.keys())
    //     console.log('test', key, data.get(key));
    request.send(data);
}
document.getElementById('delete-photo-form').addEventListener("submit", submitHandlerDelete);

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
        context.drawImage(video, 0, 0, width, height);
        return hidden_canvas.toDataURL('image/png');
    }
}

function displayErrorMessage(error_msg, error){
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
}

photo_layout_div.ondragstart = function() {
    return false;
};

function getCoords(elem) {
    var box = elem.getBoundingClientRect();
    return {
        top: box.top + pageYOffset,
        left: box.left + pageXOffset
    };
}

photo_layout_div.onmousedown = function(e) {
    photo_layout_div.style.position = 'absolute';
    moveAt(e);
    document.body.appendChild(photo_layout_div);
    photo_layout_div.style.zIndex = '90';
    function moveAt(e) {
        photo_layout_div.style.left = e.pageX - width_layout/2 + 'px';
        // console.log(e.pageX);
        photo_layout_div.style.top = e.pageY - height_layout/2 + 'px';
        // console.log(e.pageY);
        // console.log(getCoords(photo_layout_div));
    };

    document.onmousemove = function(e) {
        moveAt(e);
    };

    photo_layout_div.onmouseup = function() {
        document.onmousemove = null;
        photo_layout_div.onmouseup = null;
    };
};

