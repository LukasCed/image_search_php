<?php
require_once 'utils.php';
require_once 'databases.php';
require_once 'galleries.php';

function create_gallery_post() {
    if ($_POST['gallery'] != "")
         return create_gallery($_POST['gallery']);
    return null;
}

$galleries = create_gallery_post();
if ($galleries != null) {
    echo "New gallery created successfully";
}

?>