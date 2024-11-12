<?php
require_once 'includes/config.php'; 

$sql = "SELECT * FROM announcements ORDER BY date, morning_start_time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcements</title>
    <link rel="stylesheet" href="../styles.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: slategray; 
        }
        .container {
            max-width: 1000px; 
            margin: 0 auto;
            background-color: #fff; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
            padding: 30px; 
        }
        h1 {
            text-align: center;
            color: #4a4a4a; 
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse; 
        }
        th {
            background-color: cornflowerblue; 
            color: #333; 
            padding: 12px;
        }
        th, td {
            border: 1px solid #ddd; 
            padding: 10px;
            text-align: center;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; 
        }
        tr:hover {
            background-color: #e9f7fa; 
        }
        td {
            color: #333; 
        }
        p.inset {
            border-style: inset; 
            padding: 10px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Wits Waterpolo USSA Weekly Training Schedule 2024</h1>
        <p class="inset">Week 1: Tuesday, 12 November - Friday, 15 November 2024</p> 
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Morning Start Time</th>
                    <th>Morning End Time</th>
                    <th>Morning Location</th>
                    <th>Afternoon Start Time</th>
                    <th>Afternoon End Time</th>
                    <th>Afternoon Location</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['morning_start_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['morning_end_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['morning_location']); ?></td>
                    <td><?php echo htmlspecialchars($row['afternoon_start_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['afternoon_end_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['afternoon_location']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>