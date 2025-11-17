<?php
include 'config/database.php';
checkLogin();
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['jawaban'])) {
    $user_id = $_SESSION['user_id'];
    $jawaban_data = $_POST['jawaban'];
    $total_skor = 0;
    
    // Hitung total skor
    foreach ($jawaban_data as $pertanyaan_id => $jawaban) {
        $jawaban = intval($jawaban);
        $total_skor += $jawaban;
        
        // Simpan jawaban user
        $query = "INSERT INTO jawaban_user (user_id, pertanyaan_id, jawaban) 
                  VALUES ('$user_id', '$pertanyaan_id', '$jawaban')";
        $db->conn->query($query);
    }
    
    // Tentukan kategori
    if ($total_skor <= 7) {
        $kategori = 'Sangat Ringan';
    } elseif ($total_skor <= 15) {
        $kategori = 'Ringan';
    } elseif ($total_skor <= 23) {
        $kategori = 'Sedang';
    } elseif ($total_skor <= 31) {
        $kategori = 'Cukup Berat';
    } else {
        $kategori = 'Sangat Berat';
    }
    
    // Simpan hasil test
    $query = "INSERT INTO hasil_test (user_id, total_skor, kategori) 
              VALUES ('$user_id', '$total_skor', '$kategori')";
    if ($db->conn->query($query)) {
        $_SESSION['last_test_id'] = $db->conn->insert_id;
        header("Location: hasil.php");
        exit();
    } else {
        die("Error: " . $db->conn->error);
    }
} else {
    header("Location: kuesioner.php");
    exit();
}
?>