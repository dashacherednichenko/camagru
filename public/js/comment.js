let show_comments = function (photo_id) {
    let divcomment = document.getElementById('photo' + photo_id);
    if (divcomment.style.display == "none")
        divcomment.style.display = "block";
    else
        divcomment.style.display = "none";
};

let close_window = function (photo_id) {
    let divcomment = document.getElementById('photo' + photo_id);
    divcomment.style.display = "none";
};

function insertAfter(elem, refElem) {
    let comment = document.createElement("div");

    var parent = refElem.parentNode;
    comment.innerHTML = elem;

    var next = refElem.nextSibling;
    if (next) {
        return parent.insertBefore(comment, next);
    } else {
      return parent.appendChild(comment);
    }
}

let addcomments = function(e) {
    let error = document.getElementsByClassName('comment_error');
    for (var i = 0; i < error.length; i++)
    {
        error[i].innerHTML = '';
    }
    var formCommentData = new FormData(e);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "comment/addcomment");
    xhr.send(formCommentData);
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            let div = e.childNodes[1];
            div.childNodes[3].value='';
            insertAfter(xhr.responseText, e);
        }
    }
    return false;
};

let submitLikeForm = function(id) {
    let form = document.getElementById('addLikeForm' + id);
    document.getElementById('submit'+ id).click();
}

let like = function (e, id) {
    let likespan = document.getElementById('span' + id);
    let i = likespan.innerHTML;
    let img = document.getElementById('likeimg' + id);
    var formLikeData = new FormData(e);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "comment/like");
    xhr.send(formLikeData);
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            likespan.innerHTML = xhr.responseText;
            let res = xhr.responseText - i;
            if (res == 1)
            {
                img.classList.add("active");
            }
            else {
                img.classList = '';
            }
        }
    }
    return false;
}
