<?php
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $morning_start_time = $_POST['morning_start_time'];
    $morning_end_time = $_POST['morning_end_time'];
    $morning_location = $_POST['morning_location'];
    $afternoon_start_time = $_POST['afternoon_start_time'];
    $afternoon_end_time = $_POST['afternoon_end_time'];
    $afternoon_location = $_POST['afternoon_location'];

    
    $sql = "INSERT INTO announcements (date, morning_start_time, morning_end_time, morning_location, afternoon_start_time, afternoon_end_time, afternoon_location) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("MySQL prepare error: " . $conn->error);
    }
    
    $stmt->bind_param("sssssss", $date, $morning_start_time, $morning_end_time, $morning_location, $afternoon_start_time, $afternoon_end_time, $afternoon_location);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error executing query: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Announcement</title>
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
        }
        button:hover {
            background-color: #5a5ea7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Announcement</h1>
        <form method="POST">
            <label for="date">Date:</label>
            <input type="date" name="date" required>

            <label for="morning_start_time">Morning Session Start Time:</label>
            <input type="time" name="morning_start_time" required>

            <label for="morning_end_time">Morning Session End Time:</label>
            <input type="time" name="morning_end_time" required>

            <label for="morning_location">Morning Location:</label>
            <input type="text" name="morning_location" placeholder="e.g. Wits Main Pool" required>

            <label for="afternoon_start_time">Afternoon Session Start Time:</label>
            <input type="time" name="afternoon_start_time">

            <label for="afternoon_end_time">Afternoon Session End Time:</label>
            <input type="time" name="afternoon_end_time">

            <label for="afternoon_location">Afternoon Location:</label>
            <input type="text" name="afternoon_location" placeholder="e.g. Old Eds Pool">

            <button type="submit">Add Announcement</button>
        </form>
    </div>
</body>
</html>