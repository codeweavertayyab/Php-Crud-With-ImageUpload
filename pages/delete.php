<?php
include('../connection/config.php');

$deleteid = $_GET['id'];

$query = "SELECT std_name FROM `tbl_std` WHERE id = '$deleteid'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $stdname = $row['std_name'];
    $folderpath = '../uploads/' . $stdname;

    $deleteQuery = "DELETE FROM `tbl_std` WHERE id = '$deleteid'";
    if (mysqli_query($con, $deleteQuery)) {
        function deleteFolder($dir) {
            foreach (new DirectoryIterator($dir) as $fileInfo) {
                if($fileInfo->isDot()) continue;
                if ($fileInfo->isDir()) deleteFolder($fileInfo->getPathname());
                else unlink($fileInfo->getPathname());
            }
            rmdir($dir);
        }

        deleteFolder($folderpath);

        echo "<script>alert('Record and folder deleted successfully'); window.location.href='show.php';</script>";
    } else {
        echo "<script>alert('Error deleting record'); window.location.href='show.php';</script>";
    }
} else {
    echo "<script>alert('Record not found'); window.location.href='show.php';</script>";
}
?>
