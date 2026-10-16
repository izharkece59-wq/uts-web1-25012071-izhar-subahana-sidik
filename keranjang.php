<?php
session_start();
require_once __DIR__ . '/data/menu.php';
require_once __DIR__ . '/includes/fungsi.php';
$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
$subtotal = 0; $baris = array();
foreach ($keranjang as $id => $jumlah) {
    foreach ($menu as $item) {
        if ($item['id'] == (int)$id) {
            $totalItem = $item['harga'] * $jumlah; $subtotal += $totalItem;
            $baris[] = array('nama'=>$item['nama'], 'jumlah'=>$jumlah, 'total'=>$totalItem, 'harga'=>$item['harga']);
            break;
        }
    }
}
$diskon = hitungDiskon($subtotal); $total = $subtotal - $diskon;
include __DIR__ . '/includes/header.php';
?>
<div class="card"><h2>Keranjang Belanja</h2>
<?php if (count($baris) === 0): ?><p>Keranjang masih kosong.</p>
<?php else: foreach ($baris as $item): ?>
<p><?php echo htmlspecialchars($item['nama'], ENT_QUOTES, 'UTF-8'); ?> — <?php echo $item['jumlah']; ?> × <?php echo rupiah($item['harga']); ?> = <?php echo rupiah($item['total']); ?></p>
<?php endforeach; ?><hr><p>Subtotal: <?php echo rupiah($subtotal); ?></p><p>Diskon: <?php echo rupiah($diskon); ?></p><h3>Total: <?php echo rupiah($total); ?></h3>
<form method="post" action="proses.php"><button type="submit" name="aksi" value="kosongkan">Kosongkan keranjang</button></form>
<?php endif; ?><p><a href="index.php">Kembali ke menu</a></p></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
