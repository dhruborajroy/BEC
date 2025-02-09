<?php
define('SECURE_ACCESS', true);
include("../../inc/connection.inc.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order'])) {
    $order = $_POST['order'];
    foreach ($order as $position => $id) {
        $position += 1; 
        $sql = "UPDATE referances SET priority = '$position' WHERE id = '$id'";
        mysqli_query($con, $sql);
    }
    mysqli_close($con);
}
?>
