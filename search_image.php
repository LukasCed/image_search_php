<?php
require_once 'utils.php';
require_once 'databases.php';
require_once 'galleries.php';

function search_image() {
    $link = open_connection();
    $tags = $_POST['tag'];

    $sql = "SELECT * FROM IMAGES.IMAGE_DATA as id
    JOIN IMAGES.IMAGE_TAG as it
    ON it.image_id = id.id
    WHERE ";
    $whereClause = '';
    for ($i = 0; $i < count($tags); $i++) {
        $tag = mysqli_real_escape_string($link, $tags[$i]);
        $whereClause = $whereClause.'it.tag = '."'$tag'";
        if ($i != count($tags) - 1) {
            $whereClause = $whereClause.' or ';
        } else {
            $whereClause = $whereClause.';';
        }
    }
    $sql = $sql.$whereClause;

    $images = mysqli_fetch_all(mysqli_query($link, $sql));

    if (count($images) > 0) {
        foreach ($images as $image) {
            $imgStream = file_get_contents($image[1]);
            $base64  = base64_encode($imgStream);
            $nameExploded = explode("/", $image[1]);
            $name = end($nameExploded);
            echo "<img src='data:image/png;base64,".$base64."'/>";
            echo "<p><b>Name:</b> $name </p>";
            echo "<p><b>Tags:</b> $image[4] </p>";
            echo "<p><b>Gallery: </b>".get_gallery_by_id($image[2])[1]."</p>";
        }
    } else {
        echo "No images found";
    }

    close_connection($link);

}


search_image();

?>