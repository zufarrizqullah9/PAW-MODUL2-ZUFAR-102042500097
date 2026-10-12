<?php
require 'functions.php';
require 'connect.php';

$search = input($_GET, 'search');
$tipe   = input($_GET, 'tipe');

// TODO 1 (READ)
// Ambil data dari tabel showroom_mobil lalu simpan ke $daftar_mobil
// dalam bentuk array (satu elemen = satu baris data).
// Ketentuan:
// - mobil yang paling baru ditambahkan muncul paling atas
// - kalau $search diisi, tampilkan hanya mobil yang nama atau brand-nya mengandung kata itu
// - kalau $tipe dipilih, tampilkan hanya mobil dengan tipe itu
// - $search dan $tipe bisa dipakai bersamaan
// Gunakan prepared statement, jangan menempelkan $search langsung ke dalam query.
$sql    = 'SELECT * FROM showroom_mobil WHERE 1=1';
$params = [];
 
if ($search !== '') {
    // Escape karakter khusus LIKE (backslash, %, _) supaya dianggap teks biasa.
    $kata = '%' . addcslashes($search, '\\%_') . '%';
    $sql .= ' AND (nama_mobil LIKE ? OR brand_mobil LIKE ?)';
    $params[] = $kata;
    $params[] = $kata;
}
 
if ($tipe !== '') {
    $sql .= ' AND tipe_mobil = ?';
    $params[] = $tipe;
}
 
$sql .= ' ORDER BY created_at DESC, id DESC';
 
$stmt = $conn->prepare($sql);
$stmt->execute($params);
$daftar_mobil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$daftar_mobil = [];

$judul = 'Daftar mobil';
require 'header.php';
?>
<h1>Daftar mobil</h1>
<p class="muted">Menampilkan <?= count($daftar_mobil) ?> mobil.</p>

<form class="toolbar" method="get" action="index.php">
    <input type="text" name="search" placeholder="Cari nama atau brand mobil" value="<?= h($search) ?>">
    <select name="tipe">
        <option value="">Semua tipe</option>
        <?php foreach ($pilihan_tipe as $pilihan): ?>
            <option value="<?= h($pilihan) ?>" <?= $pilihan === $tipe ? 'selected' : '' ?>><?= h($pilihan) ?></option>
        <?php endforeach ?>
    </select>
    <button class="btn" type="submit">Cari</button>
    <a class="btn btn-ghost" href="index.php">Reset</a>
</form>

<?php if (count($daftar_mobil) === 0): ?>
    <p class="empty">Data mobil tidak ditemukan.</p>
<?php endif ?>

<div class="grid">
    <?php foreach ($daftar_mobil as $mobil): ?>
        <article class="card car">
            <div class="car-top">
                <span class="badge"><?= h($mobil['tipe_mobil']) ?></span>
                <span class="code"><?= h($mobil['kode_mobil']) ?></span>
            </div>
            <h2><?= h($mobil['nama_mobil']) ?></h2>
            <p class="muted"><?= h($mobil['brand_mobil']) ?> | <?= h($mobil['warna_mobil']) ?></p>
            <p class="price"><?= rupiah($mobil['harga_mobil']) ?></p>
            <div class="actions">
                <a class="btn btn-sm" href="detail.php?id=<?= (int) $mobil['id'] ?>">Detail</a>
                <a class="btn btn-sm btn-ghost" href="update.php?id=<?= (int) $mobil['id'] ?>">Edit</a>
            </div>
        </article>
    <?php endforeach ?>
</div>
<?php require 'footer.php'; ?>
