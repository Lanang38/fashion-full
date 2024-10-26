<?php
session_start();

// Include config.php atau file lain di mana Anda memiliki koneksi database disetup
include('config.php');

// Periksa apakah pengguna sudah login, jika belum maka arahkan ke halaman login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Inisialisasi variabel dengan nilai awal kosong
$name = $slug = $image = "";
$name_err = $slug_err = $image_err = "";

// Memproses data formulir ketika formulir dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi nama
    if (empty(trim($_POST["name"]))) {
        $name_err = "Silakan masukkan nama untuk kategori.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Menghasilkan slug dari name
    $slug = strtolower(str_replace(' ', '-', $name)); // Replace spaces with hyphens

    // Validasi unggahan file gambar
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "uploads_c/"; // Pastikan direktori 'uploads/' ada di lokasi yang benar
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Periksa apakah file adalah gambar yang valid
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Izinkan hanya format file tertentu
            $allowedFormats = array("jpg", "jpeg", "png", "gif");
            if (!in_array($imageFileType, $allowedFormats)) {
                $image_err = "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
            }
        } else {
            $image_err = "File bukan gambar.";
        }
    } else {
        $image_err = "Silakan pilih file gambar.";
    }

    // Jika tidak ada kesalahan input, masukkan data ke database
    if (empty($name_err) && empty($image_err)) {
        // Periksa ketersediaan nama di database
        $sql_check = "SELECT category_id FROM categories WHERE name = ?";
        if ($stmt_check = mysqli_prepare($conection_db, $sql_check)) {
            mysqli_stmt_bind_param($stmt_check, "s", $param_name);
            $param_name = $name;
            if (mysqli_stmt_execute($stmt_check)) {
                mysqli_stmt_store_result($stmt_check);
                if (mysqli_stmt_num_rows($stmt_check) > 0) {
                    $name_err = "Nama kategori sudah ada.";
                }
            } else {
                echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
            }
            mysqli_stmt_close($stmt_check);
        }

        // Jika tidak ada error, masukkan data ke database
        if (empty($name_err)) {
            // Persiapkan pernyataan insert
            $sql_insert = "INSERT INTO categories (name, slug, image) VALUES (?, ?, ?)";
            if ($stmt_insert = mysqli_prepare($conection_db, $sql_insert)) {
                mysqli_stmt_bind_param($stmt_insert, "sss", $param_name, $param_slug, $param_image);
                $param_name = $name;
                $param_slug = $slug;
                $param_image = $targetFile;

                if (mysqli_stmt_execute($stmt_insert)) {
                    // Pindahkan file yang diunggah ke direktori tujuan
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                        // Redirect ke halaman daftar kategori
                        header("location: category.php");
                        exit;
                    } else {
                        $image_err = "Maaf, terjadi kesalahan saat mengunggah file Anda.";
                    }
                } else {
                    echo "Ups! Ada yang salah. Silakan coba lagi nanti.";
                }
                mysqli_stmt_close($stmt_insert);
            } else {
                echo "Ups! Ada yang salah. Silakan coba lagi nanti.";
            }
        }
    }

    // Tutup koneksi jika masih terbuka
    if (isset($conection_db)) {
        mysqli_close($conection_db);
    }
}
?>
