<?php
session_start();
require_once __DIR__ . '/data/menu.php';
require_once __DIR__ . '/includes/fungsi.php';
if (!isset($_SESSION['keranjang'])) { $_SESSION['keranjang'] = array(); }
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$hasilMenu = array();
foreach ($menu as $item) {
    if ($cari === '' || stripos($item['nama'], $cari) !== false) { $hasilMenu[] = $item; }
}
include __DIR__ . '/includes/header.php';
?>
<div class="card"><h2>Daftar Menu</h2>
<form method="get"><input type="text" name="cari" placeholder="Cari menu..." value="<?php echo htmlspecialchars($cari, ENT_QUOTES, 'UTF-8'); ?>"><button type="submit">Cari</button> <a href="index.php">Reset</a></form>
<?php if (count($hasilMenu) === 0): ?><p>Menu tidak ditemukan.</p>
<?php else: foreach ($hasilMenu as $item): ?>
<div class="card"><h3><?php echo htmlspecialchars($item['nama'], ENT_QUOTES, 'UTF-8'); ?></h3><p class="price"><?php echo rupiah($item['harga']); ?></p>
<form method="post" action="proses.php"><input type="hidden" name="id" value="<?php echo $item['id']; ?>"><label>Jumlah: <input type="number" name="jumlah" min="1" value="1" required></label><button type="submit" name="aksi" value="tambah">Tambah ke keranjang</button></form></div>
<?php endforeach; endif; ?>
<p><a class="button" href="keranjang.php">Lihat Keranjang (<?php echo array_sum($_SESSION['keranjang']); ?>)</a></p></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
