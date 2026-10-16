<?php
function rupiah($angka) {
    return 'Rp' . number_format($angka, 0, ',', '.');
}
function hitungDiskon($subtotal) {
    return $subtotal >= 50000 ? round($subtotal * 0.10) : 0;
}
