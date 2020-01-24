<?php require_once 'header.html'?>

<?php require_once 'databases.php';
    $id = $_GET["id"];
    $link = open_connection();
    $sql = "SELECT *, id.id as id FROM IMAGES.IMAGE_DATA as id
    JOIN IMAGES.GALLERY as g ON g.id = id.gallery_id
    JOIN IMAGES.IMAGE_TAG as tg ON tg.image_id = id.id
    WHERE id.id = '$id'";

    $image = mysqli_fetch_assoc(mysqli_query($link, $sql));
    $imgStream = file_get_contents($image['path']);
    $base64  = base64_encode($imgStream);
    $nameExploded = explode("/", $image['path']);
    $name = end($nameExploded);
    echo "<img src='data:image/png;base64,".$base64."'/>";
    echo "<p><b>Name:</b> $name </p>";
?>

<script type="text/javascript" src="edit_image.js"></script>

<form enctype="multipart/form-data">
    <p style="display: none;" class="alert alert-success" role="alert" id="successMsg"></p>
    <p><b>Edit image:</b></p>

    <p><label for="galleryName">Gallery name</label>
        <input id="gallery" type="textfield" name="galleryName" value="<?php echo $image['name']?>"/>
    </p>

    <p class="tags"><label for="tag">Tags</label>
        <?php
                echo '<input id="tag" type="textfield" name="tag[]" value="'.$image['tag'].'"/>';
        ?>
        <br>
    </p>

    <p><input type="button" value="Edit Image" name="submit"
              onclick="onEdit('<?php echo $image["id"]?>',
              '<?php echo $image["tag"]?>',
              '<?php echo $image["name"]?>')"/></form></p>
</form>
