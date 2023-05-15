<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "lancer");

    $id = $_SESSION['freelancer_id'];

    if (isset($_POST['send_message'])) {
        $message_fc = mysqli_real_escape_string($conn, $_POST['message_fc']);
        $time_sent_message = date('Y-m-d H:i:s');
        $id_sender = $_SESSION['freelancer_id'];
        $id_client = isset($_GET['client_id']) ? $_GET['client_id'] : null;

            $sql = "INSERT INTO messages (id_sender, id_client, id_freelancer, message_fc, time_sent_message) 
                    VALUES ('$id_sender', '$id_client', '$id_sender', '$message_fc', '$time_sent_message')";
            $result = mysqli_query($conn, $sql);
            header("Location: messages.php?client_id=$id_client");
    }
?>