<?php
require_once 'config.php'; 

/**
 * Function to send email notifications to subscribers.
 *
 * @param string $email The email address to send to.
 * @param string $subject The subject of the email.
 * @param string $message The message body of the email.
 * @return bool True if the email was sent, false otherwise.
 */
function sendEmail($email, $subject, $message) {
    $headers = "From: noreply@yourdomain.com\r\n";
    $headers .= "Reply-To: noreply@yourdomain.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    return mail($email, $subject, $message, $headers);
}

/**
 * Function to add a subscriber to the database.
 *
 * @param string $email The email address of the subscriber.
 * @return bool True if the subscriber was added, false otherwise.
 */
function addSubscriber($email) {
    global $conn;

    $sql = "INSERT INTO subscribers (email) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    return $stmt->execute();
}

/**
 * Function to fetch all announcements from the database.
 *
 * @return array List of announcements.
 */
function fetchAnnouncements() {
    global $conn;

    $sql = "SELECT * FROM announcements ORDER BY date, time";
    $result = $conn->query($sql);

    $announcements = [];
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }

    return $announcements;
}
?>