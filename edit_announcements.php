<?php
require_once '../includes/config.php'; 


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "SELECT * FROM announcements WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("MySQL prepare error: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $announcement = $result->fetch_assoc();
    } else {
        echo "Announcement not found.<br />";
        exit;
    }
} else {
    echo "No announcement ID provided.<br />";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'] ?? '';
    $morning_start_time = $_POST['morning_start_time'] ?? '';
    $morning_end_time = $_POST['morning_end_time'] ?? '';
    $morning_location = $_POST['morning_location'] ?? '';
    $afternoon_start_time = $_POST['afternoon_start_time'] ?? '';
    $afternoon_end_time = $_POST['afternoon_end_time'] ?? '';
    $afternoon_location = $_POST['afternoon_location'] ?? '';

    
    $sql = "UPDATE announcements SET date=?, morning_start_time=?, morning_end_time=?, morning_location=?, afternoon_start_time=?, afternoon_end_time=?, afternoon_location=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("MySQL prepare error: " . $conn->error);
    }

    
    $stmt->bind_param("sssssssi", $date, $morning_start_time, $morning_end_time, $morning_location, $afternoon_start_time, $afternoon_end_time, $afternoon_location, $id);
    
    
    if ($stmt->execute()) {
        header("Location: index.php"); 
        exit;
    } else {
        echo "Failed to update the announcement: " . $stmt->error . "<br />";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Announcement</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="date"],
        input[type="time"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: slateblue;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #5a5ea7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Announcement</h1>
        <form method="POST">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($announcement['date'] ?? ''); ?>" required>
            
            <label for="morning_start_time">Morning Start Time:</label>
            <input type="time" id="morning_start_time" name="morning_start_time" value="<?php echo htmlspecialchars($announcement['morning_start_time'] ?? ''); ?>" required>
            
            <label for="morning_end_time">Morning End Time:</label>
            <input type="time" id="morning_end_time" name="morning_end_time" value="<?php echo htmlspecialchars($announcement['morning_end_time'] ?? ''); ?>" required>
            
            <label for="morning_location">Morning Location:</label>
            <input type="text" id="morning_location" name="morning_location" value="<?php echo htmlspecialchars($announcement['morning_location'] ?? ''); ?>" required>
            
            <label for="afternoon_start_time">Afternoon Start Time:</label>
            <input type="time" id="afternoon_start_time" name="afternoon_start_time" value="<?php echo htmlspecialchars($announcement['afternoon_start_time'] ?? ''); ?>">
            
            <label for="afternoon_end_time">Afternoon End Time:</label>
            <input type="time" id="afternoon_end_time" name="afternoon_end_time" value="<?php echo htmlspecialchars($announcement['afternoon_end_time'] ?? ''); ?>">
            
            <label for="afternoon_location">Afternoon Location:</label>
            <input type="text" id="afternoon_location" name="afternoon_location" value="<?php echo htmlspecialchars($announcement['afternoon_location'] ?? ''); ?>">
            
            <button type="submit">Update Announcement</button>
        </form>
    </div>
</body>
</html>