<?php
require 'functions.php';
require 'connect.php';

$id    = (int) input($_GET, 'id');
$mobil = cari_mobil($conn, $id);
if (!$mobil) {
    pindah_halaman('index.php', 'Data mobil tidak ditemukan.');
}

$gagal = false;

// Data baru dihapus setelah tombol konfirmasi ditekan (POST).
// Kalau halaman ini cuma dibuka (GET), belum ada yang terhapus.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TODO 4 (DELETE)
    // Hapus baris dengan id = $id dari tabel showroom_mobil.
    // Ubah $berhasil menjadi true kalau query-nya sukses dijalankan.
    $stmt = $conn->prepare('DELETE FROM showroom_mobil WHERE id = ?');
$berhasil = $stmt->execute([$id]);
    $berhasil = false;

    if ($berhasil) {
        pindah_halaman('index.php', 'Data mobil berhasil dihapus.');
    }
    $gagal = true;
}

$judul = 'Hapus mobil';
require 'header.php';
?>
<?php if ($gagal): ?>
    <p class="notice notice-error">Data belum terhapus. Cek lagi pengerjaan TODO 4 di delete.php.</p>
<?php endif ?>

<form class="card detail" method="post" action="delete.php?id=<?= $id ?>">
    <h1>Hapus mobil ini?</h1>
    <p class="muted"><b><?= h($mobil['nama_mobil']) ?></b> dengan kode <b><?= h($mobil['kode_mobil']) ?></b> akan dihapus dan tidak bisa dikembalikan.</p>
    <div class="actions">
        <button class="btn" type="submit">Ya, hapus</button>
        <a class="btn btn-ghost" href="detail.php?id=<?= $id ?>">Batal</a>
    </div>
</form>
<?php require 'footer.php'; ?>
