<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '123456', 'mahasiswa');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data untuk pagination
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1; // Pastikan page minimal 1
$offset = ($page - 1) * $limit;

// Query untuk mengambil data
$result = $conn->query("SELECT * FROM data_mahasiswa LIMIT $limit OFFSET $offset");
if (!$result) {
    die("Query error: " . $conn->error);
}

// Query untuk menghitung total data
$total_data_result = $conn->query("SELECT COUNT(*) AS total FROM data_mahasiswa");
$total_data = $total_data_result ? $total_data_result->fetch_assoc()['total'] : 0;
$total_pages = ceil($total_data / $limit);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Data Mahasiswa</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>NIM</th>
                    <th>Mata Kuliah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = $offset + 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['nama']}</td>
                            <td>" . ($row['jenis_kelamin'] === 'L' ? 'Laki-Laki' : 'Perempuan') . "</td>
                            <td>{$row['nim']}</td>
                            <td>{$row['mata_kuliah']}</td>
                        </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Navigasi Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>">Sebelumnya</a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Selanjutnya</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</body>
</html>
