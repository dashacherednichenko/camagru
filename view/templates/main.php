<?php
?>
<div id="container">
    <div id="main_container">
        <h1>Gallery</h1>
<!--        <button id="take">Take a photo</button><br />-->
<!--        <video id="v"></video>-->
<!--        <canvas id="canvas" style="display:none;"></canvas>-->
<!--        <img src="http://placehold.it/300&text=Your%20image%20here%20..." id="photo" alt="photo">-->
        <script>
            // ;(function(){
            //     function userMedia(){
            //         return navigator.getUserMedia = navigator.getUserMedia ||
            //             navigator.webkitGetUserMedia ||
            //             navigator.mozGetUserMedia ||
            //             navigator.msGetUserMedia || null;
            //
            //     }
            //
            //     // Now we can use it
            //     if( userMedia() ){
            //         var videoPlaying = false;
            //         var constraints = {
            //             video: true,
            //             audio:false
            //         };
            //         var video = document.getElementById('v');
            //
            //         var media = navigator.getUserMedia(constraints, function(stream){
            //
            //             // URL Object is different in WebKit
            //             var url = window.URL || window.webkitURL;
            //             console.log('url', url);
            //
            //             // create the url and set the source of the video element
            //             video.src = url ? url.createObjectURL(stream) : stream;
            //
            //             // Start the video
            //             video.play();
            //             videoPlaying  = true;
            //         }, function(error){
            //             console.log("ERROR");
            //             console.log(error);
            //         });
            //
            //         // Listen for user click on the "take a photo" button
            //         document.getElementById('take').addEventListener('click', function(){
            //             if (videoPlaying){
            //                 var canvas = document.getElementById('canvas');
            //                 canvas.width = video.videoWidth;
            //                 canvas.height = video.videoHeight;
            //                 canvas.getContext('2d').drawImage(video, 0, 0);
            //                 var data = canvas.toDataURL('image/webp');
            //                 document.getElementById('photo').setAttribute('src', data);
            //             }
            //         }, false);
            //
            //     } else {
            //         console.log("KO");
            //     }
            // })();
        </script>
    </div>
    <div id="side_bar">
    </div>
</div>