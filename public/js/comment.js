let show_comments = function (photo_id) {
    let divcomment = document.getElementById('photo' + photo_id);
    if (divcomment.style.display == "none")
        divcomment.style.display = "block";
    else
        divcomment.style.display = "none";
    console.log('test', photo_id);
};

let close_window = function (photo_id) {
    let divcomment = document.getElementById('photo' + photo_id);
    divcomment.style.display = "none";
};

function insertAfter(elem, refElem) {
    console.log(elem, refElem.parentNode);
    let comment = document.createElement("div");

    var parent = refElem.parentNode;
    comment.innerHTML = elem;
    // return parent.appendChild(comment);

    var next = refElem.nextSibling;
    if (next) {
        return parent.insertBefore(comment, next);
    } else {
      return parent.appendChild(comment);
    }
}

// document.addEventListener('DOMContentLoaded', function() {
    let addcomments = function(e) {
        // e.preventDefault();
        console.log('OK', e);
        var formCommentData = new FormData(e);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "comment/addcomment");
        xhr.send(formCommentData);
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                let div = e.childNodes[1];
                div.childNodes[3].value='';
                console.log('rrrr',div.childNodes[3].value='');
                insertAfter(xhr.responseText, e);
                // document.getElementById('comment').

            }
        }
        return false;
    };


