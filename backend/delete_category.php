<?php
session_start();
require 'config.php';

// Cek apakah pengguna sudah login, jika tidak redirect ke halaman login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Cek apakah ID tag telah diberikan
if(isset($_GET['category_id'])){
    $id = $_GET['category_id'];

    // Hapus tag berdasarkan ID
    $sql = "DELETE FROM categories WHERE category_id = ?";
    if($stmt = $conection_db->prepare($sql)){
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            header("location: category.php");
            exit;
        } else {
            echo "Terjadi kesalahan. Silakan coba lagi.";
        }
    }
} else {
    echo "ID tag tidak diberikan.";
}
?>