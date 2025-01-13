<?php
    include 'connct.php';

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Secure the ID input
    } else {
        echo "ID tidak ditemukan.";
        exit();
    }

    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Diri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;400;500&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: "Mali", cursive;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .custom-form {
            background-color: #ffffff;
            border: 2px solid #E90074;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .btn-pink {
            background-color: #E90074;
            color: #fff;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-pink:hover {
            background-color: #b00054;
        }
        .form-heading {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>

    <script>
        function confirmDelete() {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = 'delete.php?id=<?php echo $row['id']; ?>';
            }
        }
    </script>
</head>
<body>
    <div class="custom-form">
        <h1 class="form-heading">Edit Data Diri</h1>
        <p class="text-center">Berikut adalah data diri Anda yang telah diinput. Silakan ubah jika diperlukan.</p>

        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="email" value="<?php echo str_replace('@gmail.com', '', htmlspecialchars($row['email'])); ?>" required>
                    <span class="input-group-text">@gmail.com</span>
                </div>
            </div>

            <div class="mb-3">
                <label for="hp" class="form-label">No. Handphone:</label>
                <input type="text" class="form-control" id="hp" name="hp" value="<?php echo htmlspecialchars($row['hp']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="Alamat" class="form-label">Alamat:</label>
                <textarea class="form-control" rows="3" id="Alamat" name="alamat" required><?php echo htmlspecialchars($row['alamat']); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="job" class="form-label">Pekerjaan:</label>
                <input type="text" class="form-control" id="job" name="job" value="<?php echo htmlspecialchars($row['job']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin:</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="gender" value="perempuan" <?php echo ($row['gender'] == 'perempuan') ? 'checked' : ''; ?>>
                    <label class="form-check-label">Perempuan</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="gender" value="Laki-laki" <?php echo ($row['gender'] == 'Laki-laki') ? 'checked' : ''; ?>>
                    <label class="form-check-label">Laki-laki</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="hobby" class="form-label">Hobby:</label>
                <textarea class="form-control" rows="2" id="hobby" name="hobby" required><?php echo htmlspecialchars($row['hobby']); ?></textarea>
            </div>

            <div class="mb-4">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" name="status" required>
                    <option value="Belum menikah" <?php echo ($row['status'] == 'Belum menikah') ? 'selected' : ''; ?>>Belum menikah</option>
                    <option value="Sudah menikah" <?php echo ($row['status'] == 'Sudah menikah') ? 'selected' : ''; ?>>Sudah menikah</option>
                    <option value="Sudah menikah tapi cerai" <?php echo ($row['status'] == 'Sudah menikah tapi cerai') ? 'selected' : ''; ?>>Sudah menikah tapi cerai</option>
                    <option value="Tidak mau menikah" <?php echo ($row['status'] == 'Tidak mau menikah') ? 'selected' : ''; ?>>Tidak mau menikah</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-pink">Update</button>
                <button type="button" class="btn btn-pink" onclick="confirmDelete()">Delete</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
