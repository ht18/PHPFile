<?php

if (isset($_POST['content'])) {
    $file = "./files/roswell/" . $_POST['file'];
    if (is_file($file)) {
        $fileOpen = fopen($file, "w");
        fwrite($fileOpen, stripslashes($_POST['content']));
        fclose($fileOpen);
    }
}

if (isset($_POST['delete'])) {
    $file = "./files/roswell/" . $_POST['file'];
    if (is_file($file)) {
        unlink($file);
    } else {
        rmdir($file);
    }
}

?>


<?php include('inc/head.php'); ?>

<?php
$dir1 = opendir("./files/roswell");
while ($file = readdir($dir1)) {
    if ($file != "." && $file != "..") {
        echo '<div style="display:flex; flex-direction:column"><a href="?f=' . $file . '"><img src=./assets/images/file.png/>';
        echo $file;
        echo '</a><div>';
    }
}
?>

<?php
if (isset($_GET['f'])) {
    $file = "./files/roswell/" . $_GET['f'];
    if (is_file($file)) {
        $content = file_get_contents($file);
    } else if (is_dir($file)) {
        $content = 'not a file';
        $dir1 = opendir("./files/roswell/" . $_GET['f']);
        while ($file = readdir($dir1)) {
            if ($file != "." && $file != "..") {
                echo '<div style="display:flex; flex-direction:column"><a href="?f=' . $file . '"><img src=./assets/images/file.png/>';
                echo $file;
                echo '</a><div>';
            }
        }
    }

?>


    <form method="post" action="index.php">
        <textarea name="content" style="width:100%; height:200px"><?php echo $content ?></textarea>
        <input type="submit" value="Save" />
        <input type="submit" name="delete" value="Delete" />
        <input type="hidden" name="file" value="<?php echo $_GET['f'] ?>" />
    </form>
<?php

}
?>
<?php include('inc/foot.php'); ?>