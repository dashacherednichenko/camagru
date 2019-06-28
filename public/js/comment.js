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

let submitLikeForm = function(id) {
    let form = document.getElementById('addLikeForm' + id);
    document.getElementById('submit'+ id).click();
    // e.classList.add("active");
    // console.log('e', e);
}

let like = function (e, id) {
    let likespan = document.getElementById('span' + id);
    let i = likespan.innerHTML;
    let img = document.getElementById('likeimg' + id);
    console.log("like", likespan.innerHTML);
    var formLikeData = new FormData(e);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "comment/like");
    xhr.send(formLikeData);
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            likespan.innerHTML = xhr.responseText;
            let res = xhr.responseText - i;
            console.log('res', res);
            if (res == 1)
            {
                img.classList.add("active");
            }
            else {
                img.classList = '';
            }
            // console.log('like!!!!', xhr.responseText);

        }
    }
    return false;
}
