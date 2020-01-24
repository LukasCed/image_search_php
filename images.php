<?php
require_once 'utils.php';
require_once 'databases.php';
require_once 'galleries.php';

function update() {
    $image_id = $_GET['imageId'];
    $oldTag = $_GET['oldTag'];
    $newTag = $_GET['newTag'];
    $galleryName = $_GET['galleryName'];
    $galleryId = get_gallery_id_by_name($galleryName);

    update_image_tag($image_id, $oldTag, $newTag);
    update_image_gallery($image_id, $galleryId);
}

function update_image_tag($image_id, $oldTag, $newTag) {
    $link = open_connection();
    $newTag = mysqli_real_escape_string($link, $newTag);
    $oldTag = mysqli_real_escape_string($link, $oldTag);

    $sql = "UPDATE IMAGES.IMAGE_TAG
    SET tag = '$newTag' 
    WHERE image_id = '$image_id', tag = '$oldTag'";

    mysqli_query($link, $sql);
    $id = mysqli_insert_id($link);
    close_connection($link);

    return $id;
}

function update_image_gallery($image_id, $gallery_id) {
    $link = open_connection();
    $gallery_id = mysqli_real_escape_string($link, $gallery_id);
    $image_id = mysqli_real_escape_string($link, $image_id);

    $sql = "UPDATE IMAGES.IMAGE_DATA
    SET gallery_id = '$gallery_id' 
    WHERE id = '$image_id'";

    mysqli_query($link, $sql);
    $id = mysqli_insert_id($link);
    close_connection($link);

    return $id;
}

update();

?>