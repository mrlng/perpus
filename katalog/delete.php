<?php
include '../config/koneksi.php';
$id = $_GET['id'];
$sql = "DELETE FROM katalog WHERE katalog_id=$id";
if ($mysqli->query($sql) === TRUE) {
 header("Location: ../katalog");
 exit;
} else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();
?>