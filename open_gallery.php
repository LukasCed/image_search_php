<?php
require_once 'galleries.php';
require_once 'header.html';


function search_images_by_gallery_id() {
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        echo "<p>These are the images in gallery:</p>";

        $link = open_connection();
        $sql = "SELECT *, GROUP_CONCAT(it.tag) as 'tags_concat' FROM IMAGES.IMAGE_DATA as id
        JOIN IMAGES.IMAGE_TAG as it
        ON it.image_id = id.id
        WHERE id.gallery_id = '$id'
        GROUP BY id.id";

        $images = mysqli_fetch_all(mysqli_query($link, $sql));

        if (count($images) > 0) {
            foreach ($images as $image) {
                $imgStream = file_get_contents($image[1]);
                $base64  = base64_encode($imgStream);
                $nameExploded = explode("/", $image[1]);
                $name = end($nameExploded);
                echo "<img src='data:image/png;base64,".$base64."'/>";
                echo "<p><b>Name:</b> $name </p>";
                echo "<p><b>Tags:</b> $image[5] </p>";
                echo "<p><b>Gallery: </b>".get_gallery_by_id($image[2])[1]."</p>";
                echo '<a href="edit_image.php?id='.$image[0].'"><p>Edit image</p></a>';
            }
        } else {
            echo "No images found";
        }

        close_connection($link);
    }
}

search_images_by_gallery_id();

?>
