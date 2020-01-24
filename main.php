<?php require_once 'header.html'?>

<script type="text/javascript" src="main.js"></script>

<body>
    <form action="upload_image.php" method="post" enctype="multipart/form-data">
             <p><b>Upload image:</b></p>
            <input type="file" name="filesToUpload[]" multiple/>
            <p><label for="galleryName">Gallery name</label>
            <input type="textfield" name="galleryName"/>
            </p>

            <p class="tags"><label for="tag">Tags</label>
                <input type="textfield" name="tag[]"/>
                <button type="button" onclick="appendTag()">Add tag</button>
                <br>
            </p>

            <p><input type="submit" value="Upload Image" name="submit"/></form></p>
    </form>

    <br>

    <form action="search_image.php" method="post" enctype="multipart/form-data">
        <p><b>Search for Image by tags:</b></p>

        <p class="searchTags"><label for="tag">Tags</label>
            <input type="textfield" name="tag[]"/>
            <button type="button" onclick="appendTagForSearching()">Add tag</button>
            <br>
        </p>

        <p><input type="submit" value="Search Images" name="submit"/></form></p>
    </form>

    <br>

    <form action="create_gallery.php" method="post" enctype="multipart/form-data">
            <p><b>Create Gallery:</b></p>
            <label for="gallery">Gallery name</label>
            <input type="textbox" name="gallery" required/>
            <input type="submit" value="Create Gallery" name="submit"/>
    </form>

    <br>
    <p>
        <b>Galleries:</b>
        <?php include 'galleries.php';
        foreach (get_galleries() as $gallery) {
            echo '<a href="open_gallery.php?id='.$gallery[0].'"><p>'.$gallery[1].'</p></a>';
        }
        ?>
    </p>
</body>
