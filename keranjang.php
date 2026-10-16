```php
<?php
session_start();

require_once __DIR__ . '/data/menu.php';
require_once __DIR__ . '/includes/fungsi.php';

$keranjang = isset($_SESSION['keranjang'])
    ? $_SESSION['keranjang']
    : array();

$subtotal = 0;
$baris = array();
$totalJumlah = 0;

foreach ($keranjang as $id => $jumlah) {
    foreach ($menu as $item) {
        if ($item['id'] == (int) $id) {
            $jumlah = max(0, (int) $jumlah);

            if ($jumlah === 0) {
                break;
            }

            $totalItem = $item['harga'] * $jumlah;
            $subtotal += $totalItem;
            $totalJumlah += $jumlah;

            $baris[] = array(
                'nama' => $item['nama'],
                'jumlah' => $jumlah,
                'total' => $totalItem,
                'harga' => $item['harga']
            );

            break;
        }
    }
}

$diskon = hitungDiskon($subtotal);
$total = max(0, $subtotal - $diskon);

include __DIR__ . '/includes/header.php';
?>

<div class="card cart-card">
    <h2>Keranjang Belanja</h2>

    <?php if (count($baris) === 0): ?>
        <div class="cart-empty">
            <p>Keranjang lu masih kosong, bro.</p>
            <p>Yuk, pilih menu favorit lu terlebih dahulu!</p>
            <a href="index.php">Lihat Menu</a>
        </div>
    <?php else: ?>

        <p>
            Total item:
            <strong><?php echo $totalJumlah; ?> item</strong>
        </p>

        <div class="cart-items">
            <?php foreach ($baris as $item): ?>
                <div class="cart-item">
                    <div>
                        <strong>
                            <?php
                            echo htmlspecialchars(
                                $item['nama'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>
                        </strong>

                        <p>
                            <?php echo $item['jumlah']; ?> ×
                            <?php echo rupiah($item['harga']); ?>
                        </p>
                    </div>

                    <strong>
                        <?php echo rupiah($item['total']); ?>
                    </strong>
                </div>
            <?php endforeach; ?>
        </div>

        <hr>

        <div class="cart-summary">
            <p>
                <span>Subtotal</span>
                <strong><?php echo rupiah($subtotal); ?></strong>
            </p>

            <p>
                <span>Diskon</span>
                <strong><?php echo rupiah($diskon); ?></strong>
            </p>

            <h3>
                <span>Total Bayar</span>
                <strong><?php echo rupiah($total); ?></strong>
            </h3>
        </div>

        <form method="post" action="proses.php"
              onsubmit="return confirm('Yakin ingin mengosongkan keranjang?');">
            <button type="submit" name="aksi" value="kosongkan">
                Kosongkan Keranjang
            </button>
        </form>

    <?php endif; ?>

    <p><a href="index.php">← Kembali ke Menu</a></p>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
```