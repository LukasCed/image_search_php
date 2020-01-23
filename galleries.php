<?php
require_once 'utils.php';
require_once 'databases.php';

function get_galleries() {
    $link = open_connection();
    $sql = "SELECT * FROM IMAGES.GALLERY";
    $galleries = mysqli_query($link, $sql);
    close_connection($link);
    return mysqli_fetch_all($galleries);
}

function get_gallery_id_by_name($name) {
    $link = open_connection();
    $name = mysqli_real_escape_string($link, $name);
    $sql = "SELECT * FROM IMAGES.GALLERY WHERE name = '$name'";
    $gallery = mysqli_query($link, $sql);
    close_connection($link);
    return mysqli_fetch_array($gallery)[0];
}

function get_gallery_by_id($id) {
    $link = open_connection();
    $name = mysqli_real_escape_string($link, $id);
    $sql = "SELECT * FROM IMAGES.GALLERY WHERE id = '$id'";
    $gallery = mysqli_query($link, $sql);
    close_connection($link);
    return mysqli_fetch_array($gallery);
}

function create_gallery($name) {
    $link = open_connection();
    $name = mysqli_real_escape_string($link, $name);

    $sql = "INSERT INTO IMAGES.GALLERY (name)
    VALUES ('$name')";

    mysqli_query($link, $sql);
    $id = mysqli_insert_id($link);
    close_connection($link);

    return $id;
}

?>