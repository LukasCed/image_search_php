function onEdit(image_id, image_tag, gallery_name) {
    var newTag = image_tag;
    var newGalleryName = gallery_name;
    var xhttp = new XMLHttpRequest();

    newTag = document.getElementById("tag").value;
    newGalleryName = document.getElementById("gallery").value;

    xhttp.open("GET", "images.php?imageId=" + image_id + "&oldTag=" + image_tag +
        "&newTag=" + newTag + "&galleryName=" + newGalleryName, true);
    xhttp.send();
    if (xhttp.status == 0)
        console.log(xhttp.responseText)
    document.getElementById('successMsg').textContent = "Image data changed successfully!";
    document.getElementById('successMsg').style.display = "block";

}