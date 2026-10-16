<?php
session_start();
require_once __DIR__ . '/data/menu.php';
if (!isset($_SESSION['keranjang'])) { $_SESSION['keranjang'] = array(); }
$aksi = isset($_POST['aksi']) ? $_POST['aksi'] : '';
if ($aksi === 'kosongkan') {
    $_SESSION['keranjang'] = array(); header('Location: keranjang.php'); exit;
}
if ($aksi === 'tambah') {
    $jumlahRaw = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
    $idRaw = isset($_POST['id']) ? $_POST['id'] : '';
    $jumlah = filter_var($jumlahRaw, FILTER_VALIDATE_INT, array('options'=>array('min_range'=>1)));
    $id = filter_var($idRaw, FILTER_VALIDATE_INT);
    if ($jumlah === false || $jumlah === null || $id === false || $id === null) {
        http_response_code(400); exit('Jumlah atau menu tidak valid. Keranjang tidak diubah.');
    }
    $ada = false;
    foreach ($menu as $item) { if ($item['id'] == $id) { $ada = true; break; } }
    if (!$ada) { http_response_code(400); exit('Menu tidak ditemukan. Keranjang tidak diubah.'); }
    if (!isset($_SESSION['keranjang'][$id])) { $_SESSION['keranjang'][$id] = 0; }
    $_SESSION['keranjang'][$id] += $jumlah;
    header('Location: keranjang.php'); exit;
}
http_response_code(400); echo 'Permintaan tidak valid.';
