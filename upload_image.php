<?php
require 'utils.php';
require 'databases.php';
require 'galleries.php';

function upload_image() {
    $target_directory = "/opt/lampp/htdocs/task/images/".generateRandomString()."/";
    $link = open_connection();

    foreach($_FILES['filesToUpload']["name"] as $key=>$name) {
        $target_path = $target_directory.$name;

        if (!is_dir($target_directory) && !mkdir($target_directory)){
            die("Error creating folder $target_directory");
        } else {
            chmod("$target_directory",0755);
        }

        $gallery = get_gallery_id_by_name($_POST['galleryName']);
        if ($gallery == null) {
            $gallery = create_gallery($_POST['galleryName']);
        }
        $tags = $_POST['tag'];

        $sql = "INSERT INTO IMAGES.IMAGE_DATA (path, gallery_id)
        VALUES ('$target_path', '$gallery')";
        if(move_uploaded_file($_FILES['filesToUpload']['tmp_name'][$key], $target_path)) {
            echo "File uploaded successfully!";
            if (mysqli_query($link, $sql) === TRUE) {
                echo "New record created successfully";
                upload_tags($link, mysqli_insert_id($link), $tags);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($link);
            }
        } else{
            echo "Sorry, file not uploaded, please try again!";
        }

    }
    close_connection($link);
}

function upload_tags($link, $image_id, $tags) {
    $sql = "INSERT INTO IMAGES.IMAGE_TAG (image_id, tag) VALUES";
    for ($i = 0; $i < count($tags); $i++) {
        $sql = $sql." ('$image_id', '$tags[$i]')\n";
        if ($i != count($tags) - 1) {
            $sql = $sql.',';
        } else {
            $sql = $sql.';';
        }
    }
    if (mysqli_query($link, $sql) === TRUE) {
        echo "Tags added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}

upload_image();
?>


