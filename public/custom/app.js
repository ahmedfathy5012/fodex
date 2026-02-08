"use strict";
function dragNdrop(event) {
    var fileName = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("preview");
    var previewImg = document.createElement("img");
    previewImg.setAttribute("src", fileName);
    preview.innerHTML = "";
    preview.appendChild(previewImg);
}
function drag() {
    document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
}
function drop() {
    document.getElementById('uploadFile').parentNode.className = 'dragBox';
}

$(".multi_images").change(function() {
    $('#row').empty();
if (this.files && this.files[0]) {
for (var i = 0; i < this.files.length; i++) {
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[i]);
}
}
});


function imageIsLoaded(e) {

$('#row').append('<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-flex align-items-center"><figure class="imghvr-fade"><img style="width:100px;height:100px;"src=' + e.target.result + '></figure></div>');
};