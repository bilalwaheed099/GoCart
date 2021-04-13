<?php 
    include_once('.\config\config.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM product WHERE product_id=$id";
    if($mysqli->query($sql) === TRUE){
        echo "Record deleted successfully!";
        header('Location: products.php');
    }else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
?>