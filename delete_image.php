<?php require_once 'header.html'?>

<?php require_once 'databases.php';

$id = $_GET["id"];
$link = open_connection();
$sql = "SELECT path FROM IMAGES.IMAGE_DATA 
    WHERE id = '$id'";

$imagePath = mysqli_fetch_assoc(mysqli_query($link, $sql));
//if (!unlink( $imagePath )) {
//    echo "File has not been deleted from server";
//}

$sql = "DELETE FROM IMAGES.IMAGE_DATA 
    WHERE id = '$id'";
if (!mysqli_query($link, $sql)) {
    echo "Delete unsuccessful";
} else {
    echo "Delete successful";
}

close_connection($link);

?>