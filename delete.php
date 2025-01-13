<?php
    include 'conn.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM user WHERE id = $id";

        if ($koneksi->query($sql) === TRUE) {
            echo "<script>
                    alert('Data berhasil dihapus.');
                    window.location.href = 'form_insert.html';
                </script>";
        } else {
            echo "<script>alert('Gagal menghapus data: " . $koneksi->error . "');</script>";
        }
    } else {
        echo "<script>alert('ID tidak ditemukan.');</script>";
    }
?>
