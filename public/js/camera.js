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
let notSavedPhotosDiv = document.getElementById('notSavedPhotosDiv');
let width_layout;
let height_layout;
let gumStream;
let photocount = 1;


photo_layout_div.style.left = '30%';
photo_layout_div.style.top = '30%';

navigator.getMedia = ( navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);

// console.log(photo.src);
function showNotSave() {
    // var host = photo.src.split('/camagru/');
    // // console.log("test", host);
    // if (host[1] != '')
    // {
        document.getElementById('h_notsaved').hidden = false;
        // document.getElementById('saveDelete').hidden = false;
        // photo.style.zIndex = '1000';
        // delete_photo_btn.classList.remove("disabled");
        // save_photo_btn.classList.remove("disabled");
        // saveDel.classList.remove("disabled");
    // }
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
                gumStream = stream;
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
    let downphoto = document.getElementById('downloadphoto_img').src;
    let downsubstring = "data:image/";

    if (downphoto.indexOf(downsubstring) !== -1)
    {
        let my_photo = downphoto;
        // let download_width = document.getElementById('downloadphoto_img').offsetWidth;
        // console.log('my_photo', document.getElementById('downloadphoto_img').offsetWidth);
        // return ;
        width_layout = photo_layout_div.offsetWidth;
        height_layout = photo_layout_div.offsetHeight;
        let img = await inputPhoto.setAttribute('value', my_photo);
	    await document.getElementById('maskWidth').setAttribute('value',  width_layout);
	    await document.getElementById('maskHeight').setAttribute('value',  height_layout);
	    let video_crd = getCoords(photo_layout_div);
	    let mask_crd = getCoords(document.getElementById('camera-stream-div'));
	    let left = video_crd['left'] - mask_crd['left'];
	    let top = video_crd['top'] - mask_crd['top'];
	    await document.getElementById('maskLeft').setAttribute('value',  left);
	    await document.getElementById('maskTop').setAttribute('value',  top);
    }
    else
    {
        let my_photo = await takeSnapshot();
        let img = await inputPhoto.setAttribute('value', my_photo);
	    await document.getElementById('maskWidth').setAttribute('value',  width_layout);
	    await document.getElementById('maskHeight').setAttribute('value',  height_layout);
	    let video_crd = getCoords(photo_layout_div);
	    let mask_crd = getCoords(video);
	    let left = video_crd['left'] - mask_crd['left'];
	    let top = video_crd['top'] - mask_crd['top'];
	    await document.getElementById('maskLeft').setAttribute('value',  left);
	    await document.getElementById('maskTop').setAttribute('value',  top);
    }
    var formPhotoData = new FormData(document.forms.photoform);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "snapchat/photo");
    xhr.send(formPhotoData);
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            let snapdiv = document.createElement("div");
            notSavedPhotosDiv.appendChild(snapdiv);
            let snap = document.createElement("img");
            snap.setAttribute('class', 'snap');
            snap.id = 'snap' + photocount;
            snapdiv.appendChild(snap);
            snap.src = xhr.responseText;
            let divcontrols = document.createElement("div");
            divcontrols.className = "controls saveDelete";
            divcontrols.id = "saveDelete" + photocount;
            snapdiv.appendChild(divcontrols);
            let formtmppublish = document.createElement("form");
            formtmppublish.method = 'POST';
            formtmppublish.action = 'snapchat/publishphoto';
            let delbtn = document.createElement("button");
            delbtn.innerHTML = "Delete";
            delbtn.id = "delete-photo" + photocount;
            delbtn.className = 'deletephoto';
            divcontrols.appendChild(delbtn);
            // let id = delbtn.id.split('delete-photo')[1];
            delbtn.addEventListener("click", function () {
                snap.src = '';
                divcontrols.hidden = true;
                snapdiv.hidden = true;
            });
            let srctmpimg = document.createElement("input");
            srctmpimg.hidden = true;
            srctmpimg.value = snap.src;
            srctmpimg.name = 'snap';
            let savebtn = document.createElement("input");
            savebtn.value = "Publish";
            savebtn.className = "save-photo";
            savebtn.type = 'submit';
            savebtn.id = "save-photo" + photocount;
            divcontrols.appendChild(formtmppublish);
            formtmppublish.appendChild(srctmpimg);
            formtmppublish.appendChild(savebtn);
            // savebtn.addEventListener("submit", submitHandlerPublish);
            photocount++;

            showNotSave();
            // console.log('ajax',xhr.responseText);
        }
    }

});

function showVideo(){
    cleanSnapPage();
    video.classList.add("visible");
    superposable.classList.add("visible");
    controlsButtons.classList.add("visible");
    take_photo_btn.hidden = false;
}

function takeSnapshot(){
    let hidden_canvas = document.querySelector('canvas');
    let context = hidden_canvas.getContext('2d');
    let width = video.offsetWidth;
    let height = video.offsetHeight;
    width_layout = photo_layout_div.offsetWidth;
    height_layout = photo_layout_div.offsetHeight;
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
    // photo.classList.remove("visible");
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
    // console.log('height_layout',height_layout);
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
        width_layout = photo_layout_div.offsetWidth;
        height_layout = photo_layout_div.offsetHeight;
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

function downloadphoto() {

    var file = document.getElementById("downloadphoto").files[0];
    if (file != undefined) {
	    var formData = new FormData();
	    formData.append("downloadphoto", file);
        formData.append("width", document.getElementById('camera-stream-div-photo').offsetWidth);

	    var XHR = "onload" in new XMLHttpRequest() ? XMLHttpRequest : XDomainRequest;
	    var xhr = new XHR();

	    xhr.open('POST', 'snapchat/downloadphoto', true);
	    xhr.onreadystatechange = () => {
		    if (xhr.readyState !== 4) {
			    return;
		    }
		    if (xhr.status === 200) {
			    console.log(xhr.responseText);
			    var string = xhr.responseText,
				    substring = "ERROR:";

			    if (string.indexOf(substring) == -1) {
				    error_message.innerText = '';
				    error_message.classList.remove("visible");
				    document.getElementById('downloadphoto_img').src = xhr.responseText;
				    document.getElementById('camera-stream-div-photo').onclick = null;
				    document.getElementById('camera-stream-div-photo').classList.remove("camera-stream-div-photo");
				    video.classList.remove("visible");
				    video.classList.add("disabled");
				    superposable.classList.add("visible");
                    controlsButtons.classList.add("visible");
				    take_photo_btn.hidden = false;
				    if (gumStream != undefined)
					    gumStream.getTracks().forEach(track => track.stop());
				    //console.log('downloadphoto_img', document.getElementById('downloadphoto_img').clientWidth,document.getElementById('downloadphoto_img').clientHeight, document.getElementById('downloadphoto_img').naturalWidth, document.getElementById('downloadphoto_img').naturalHeight);
			    }
			    else {
				    error_message.innerText = xhr.responseText;
				    error_message.classList.add("visible");
			    }
		    }
	    };
	    xhr.send(formData);
    }
}
