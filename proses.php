```php
<?php
session_start();

require_once __DIR__ . '/data/menu.php';

if (!isset($_SESSION['keranjang']) || !is_array($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$aksi = isset($_POST['aksi']) && is_string($_POST['aksi'])
    ? $_POST['aksi']
    : '';

if ($aksi === 'kosongkan') {
    $_SESSION['keranjang'] = array();

    header('Location: keranjang.php');
    exit;
}

if ($aksi === 'tambah') {
    $jumlahRaw = isset($_POST['jumlah']) && is_string($_POST['jumlah'])
        ? $_POST['jumlah']
        : '';

    $idRaw = isset($_POST['id']) && is_string($_POST['id'])
        ? $_POST['id']
        : '';

    $jumlah = filter_var(
        $jumlahRaw,
        FILTER_VALIDATE_INT,
        array('options' => array('min_range' => 1))
    );

    $id = filter_var($idRaw, FILTER_VALIDATE_INT);

    if ($jumlah === false || $jumlah === null ||
        $id === false || $id === null) {
        http_response_code(400);
        exit('Jumlah atau menu tidak valid.');
    }

    $menuDitemukan = false;

    foreach ($menu as $item) {
        if ((int) $item['id'] === (int) $id) {
            $menuDitemukan = true;
            break;
        }
    }

    if (!$menuDitemukan) {
        http_response_code(400);
        exit('Menu tidak ditemukan.');
    }

    $jumlahSaatIni = isset($_SESSION['keranjang'][$id])
        ? (int) $_SESSION['keranjang'][$id]
        : 0;

    // Mencegah jumlah item menjadi terlalu besar.
    if ($jumlah > 1000 || $jumlahSaatIni + $jumlah > 1000) {
        http_response_code(400);
        exit('Jumlah item maksimal adalah 1000.');
    }

    $_SESSION['keranjang'][$id] = $jumlahSaatIni + $jumlah;

    header('Location: keranjang.php');
    exit;
}

http_response_code(400);
exit('Permintaan tidak valid.');
```
