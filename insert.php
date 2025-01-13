<?php
    include 'connct.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'] . "@gmail.com";
        $hp = $_POST['hp'];
        $alamat = $_POST['alamat'];
        $job = $_POST['job'];
        $gender = $_POST['gender'];
        $hobby = $_POST['hobby'];
        $status = $_POST['status'];

        $sql = "INSERT INTO user (name, email, hp, alamat, job, gender, hobby, status)
                VALUES ('$name', '$email', '$hp', '$alamat', '$job', '$gender', '$hobby', '$status')";

        if ($koneksi->query($sql) === TRUE) {
            $last_id = $koneksi->insert_id;
            header("Location: select.php?id=$last_id");
            exit();
        } else {
            echo "<script>alert('Gagal menyimpan data: " . $koneksi->error . "');</script>";
        }
    }

    $koneksi->close();
?>
