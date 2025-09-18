<?php
require_once 'elektronik.php';
session_start();

if (!isset($_SESSION['data_elektronik'])) {
    $_SESSION['data_elektronik'] = [];
}



// --- TAMBAH DATA ---
if (isset($_POST['tambah'])) {
    $namaFile = null;

    if (!empty($_FILES['gambar']['name'])) {
        $targetDir = "images/";
        $namaFile = time() . "_" . basename($_FILES["gambar"]["name"]);
        $targetFile = $targetDir . $namaFile;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile);
    }

    $newItem = new elektronik(
        (int)$_POST['id'],
        $_POST['nama'],
        $_POST['merek'],
        (float)$_POST['harga'],
        $namaFile
    );

    $_SESSION['data_elektronik'][] = $newItem;
    header("Location: main.php");
    exit();
}

// --- UPDATE DATA ---
if (isset($_POST['update'])) {
    $idToUpdate = (int)$_POST['id'];
    foreach ($_SESSION['data_elektronik'] as $key => $item) {
        if ($item->getId() === $idToUpdate) {
            $_SESSION['data_elektronik'][$key]->setNama($_POST['nama']);
            $_SESSION['data_elektronik'][$key]->setMerek($_POST['merek']);
            $_SESSION['data_elektronik'][$key]->setHarga((float)$_POST['harga']);

            if (!empty($_FILES['gambar']['name'])) {
                $targetDir = "images/";
                $namaFile = time() . "_" . basename($_FILES["gambar"]["name"]);
                $targetFile = $targetDir . $namaFile;
                move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile);
                $_SESSION['data_elektronik'][$key]->setGambar($namaFile);
            }
            break;
        }
    }
    header("Location: main.php");
    exit();
}

// --- HAPUS DATA ---
if (isset($_GET['hapus'])) {
    $idToDelete = (int)$_GET['hapus'];
    $_SESSION['data_elektronik'] = array_filter(
        $_SESSION['data_elektronik'],
        function ($item) use ($idToDelete) {
            return $item->getId() !== $idToDelete;
        }
    );
    header("Location: main.php");
    exit();
}

// --- UNTUK EDIT ---
$itemToEdit = null;
if (isset($_GET['edit'])) {
    $idToEdit = (int)$_GET['edit'];
    foreach ($_SESSION['data_elektronik'] as $item) {
        if ($item->getId() === $idToEdit) {
            $itemToEdit = $item;
            break;
        }
    }
}

// --- UNTUK CARI ---
$searchResult = null;
if (isset($_GET['cari'])) {
    $idToSearch = (int)$_GET['id_cari'];
    foreach ($_SESSION['data_elektronik'] as $item) {
        if ($item->getId() === $idToSearch) {
            $searchResult = $item;
            break;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Elektronik</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; margin: 20px; }
        .container { max-width: 900px; margin: auto; }
        .card { border: 1px solid #ccc; border-radius: 5px; padding: 15px; margin-bottom: 20px; }
        .card h2 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        img { max-width: 100px; max-height: 80px; display: block; }
        input[type="text"], input[type="number"] { width: 95%; padding: 8px; margin-bottom: 10px; }
        input[type="file"] { margin-bottom: 10px; }
        button { padding: 10px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        button.update { background-color: #007BFF; }
        a { text-decoration: none; color: #007BFF; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistem Manajemen Elektronik</h1>

        <!-- Form Pencarian -->
        <div class="card">
            <h2>Cari Data</h2>
            <form action="main.php" method="GET">
                <input type="number" name="id_cari" placeholder="Masukkan ID untuk Dicari" required>
                <button type="submit" name="cari" class="update">Cari</button>
            </form>
            <?php if (isset($_GET['cari'])): ?>
                <hr>
                <h3>Hasil Pencarian:</h3>
                <?php if ($searchResult): ?>
                    <p>ID: <?= $searchResult->getId() ?></p>
                    <p>Nama: <?= $searchResult->getNama() ?></p>
                    <p>Merek: <?= $searchResult->getMerek() ?></p>
                    <p>Harga: Rp <?= number_format($searchResult->getHarga(), 2, ',', '.') ?></p>
                    <?php if ($searchResult->getGambar()): ?>
                        <img src="images/<?= $searchResult->getGambar() ?>" alt="gambar">
                    <?php endif; ?>
                <?php else: ?>
                    <p>Data dengan ID tersebut tidak ditemukan.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Form Tambah/Update -->
        <div class="card">
            <h2><?= $itemToEdit ? 'Update Data' : 'Tambah Data Baru' ?></h2>
            <form action="main.php" method="POST" enctype="multipart/form-data">
                <?php if ($itemToEdit): ?>
                    <input type="hidden" name="id" value="<?= $itemToEdit->getId() ?>">
                <?php else: ?>
                    <label>ID:</label><br>
                    <input type="number" name="id" required><br>
                <?php endif; ?>

                <label>Nama Barang:</label><br>
                <input type="text" name="nama" value="<?= $itemToEdit ? $itemToEdit->getNama() : '' ?>" required><br>

                <label>Merek:</label><br>
                <input type="text" name="merek" value="<?= $itemToEdit ? $itemToEdit->getMerek() : '' ?>" required><br>

                <label>Harga:</label><br>
                <input type="number" step="0.01" name="harga" value="<?= $itemToEdit ? $itemToEdit->getHarga() : '' ?>" required><br>

                <label>Gambar:</label><br>
                <input type="file" name="gambar" accept="image/*"><br>
                <?php if ($itemToEdit && $itemToEdit->getGambar()): ?>
                    <img src="uploads/<?= $itemToEdit->getGambar() ?>" alt="gambar lama">
                <?php endif; ?>

                <?php if ($itemToEdit): ?>
                    <button type="submit" name="update" class="update">Update Data</button>
                <?php else: ?>
                    <button type="submit" name="tambah">Tambah Data</button>
                <?php endif; ?>
            </form>
        </div>

        <!-- Tabel Semua Data -->
        <div class="card">
            <h2>Daftar Semua Data</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Merek</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($_SESSION['data_elektronik'])): ?>
                    <tr><td colspan="6" style="text-align:center;">Belum ada data.</td></tr>
                <?php else: ?>
                    <?php foreach ($_SESSION['data_elektronik'] as $item): ?>
                        <tr>
                            <td><?= $item->getId() ?></td>
                            <td><?= $item->getNama() ?></td>
                            <td><?= $item->getMerek() ?></td>
                            <td>Rp <?= number_format($item->getHarga(), 2, ',', '.') ?></td>
                            <td>
                                <?php if ($item->getGambar()): ?>
                                    <img src="images/<?= $item->getGambar() ?>" alt="gambar">
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="main.php?edit=<?= $item->getId() ?>">Edit</a> |
                                <a href="main.php?hapus=<?= $item->getId() ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
