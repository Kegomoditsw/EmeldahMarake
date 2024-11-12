<?php
require_once '../includes/config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "DELETE FROM announcements WHERE id=?";
    $stmt = $conn->prepare($sql);

    
    if ($stmt === false) {
        die("MySQL prepare error: " . $conn->error);
    }

   
    $stmt->bind_param("i", $id);

    
    if ($stmt->execute()) {
       
        header("Location: index.php");
        exit;
    } else {
       
        echo "Error deleting announcement: " . $stmt->error;
    }

    
    $stmt->close();
} else {
    
    echo "No ID specified for deletion.";
}


$conn->close();
?>