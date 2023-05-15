<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "lancer");

    $id_freelancer = $_SESSION['id_freelancer'];

    if (isset($_POST['submit'])) {
        $message_job = mysqli_real_escape_string($conn, $_POST['message_job']);
        $time_sent = date('Y-m-d H:i:s');
        $id_freelancer = isset($_GET['id_freelancer']) ? $_GET['id_freelancer'] : null;
        $id_client = isset($_GET['client_id']) ? $_GET['client_id'] : null;
        $id_job = isset($_GET['id_job']) ? $_GET['id_job'] : null;

            $sql = "INSERT INTO suivi_job (id_job, id_client, id_freelancer, message_job, time_sent) 
                    VALUES ('$id_job', '$id_client', '$id_freelancer', '$message_job', '$time_sent')";
            $result = mysqli_query($conn, $sql);
            header("Location: request.php?id_freelancer=$id_freelancer");
    }
?>