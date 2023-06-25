<?php
session_start();
include "koneksi.php";
include "modul.php";

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google" value="notranslate">
    <meta name="robots" content="nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sangkuriang">
    <meta name="author" content="Prasta Haitsam & Yozakha Kirnanta">
    <link rel="icon" href="alat2/sangkuriang.ico">

    <title>Sangkuriang</title>

    <link rel="stylesheet" href="alat2/styles.css">
    <link rel="stylesheet" href="alat2/all.min.css">
    <script src="alat2/all.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php include "ss_menuatas.php" ?>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include "ss_menukiri.php"; ?>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h4 class="mt-4">Daftar Peserta Latihan</h4>
                    

                    <?php
                    $query = "SELECT t_sista.no_regis, t_siswa.nama AS 'Nama Siswa', t_sista.metode_latihan, t_sista.kelas, t_tari.nama AS 'Nama Tarian'
                              FROM t_sista
                              INNER JOIN t_tari ON t_sista.kode_tari = t_tari.kode
                              INNER JOIN t_siswa ON t_sista.no_regis = t_siswa.ID
                              ORDER BY t_tari.nama, t_sista.metode_latihan";

                    $result = mysqli_query($conSS, $query);

                    if (!$result) {
                        die("Error: " . mysqli_error($conSS));
                    }
                    ?>

                    <?php
                    $currentTarian = ""; // Variable untuk menyimpan tarian saat ini
                    $prevTarian = ""; // Variable untuk menyimpan tarian sebelumnya
                    $nomor = 0; // Variabel nomor peserta

                    while ($row = mysqli_fetch_assoc($result)) {
                        $currentTarian = $row['Nama Tarian'];

                        if ($currentTarian != $prevTarian) {
                            // Jika tarian berbeda dengan tarian sebelumnya, tampilkan nama tarian di kolom pertama
                            echo '<h6>' . $prevTarian . '</h6>';
                            $prevTarian = $currentTarian;
                            $nomor = 0; // Set ulang nomor peserta
                    ?>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Nama Tarian</th>
                                        <th class="text-center">No. Reg.</th>
                                        <th>Nama Siswa</th>
                                        <th class="text-center">Metode</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                        }

                        $nomor++;
                        $metodeLatihan = ($row['metode_latihan'] == 'K') ? 'Kelompok' : 'Privat';
                        ?>
                                <tr>
                                    <td class="text-center"><?= $nomor; ?></td>
                                    <td><?= $row['Nama Tarian']; ?></td>
                                    <td class="text-center"><?= $row['no_regis']; ?></td>
                                    <td><?= $row['Nama Siswa']; ?></td>
                                    <td class="text-center"><?= $metodeLatihan; ?></td>
                                    <td class="text-center"><?= $row['kelas']; ?></td>
                                    <td class="text-center">
                                        <!-- Tindakan -->
                                    </td>
                                </tr>
                    <?php
                    }
                    ?>
                                </tbody>
                            </table>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-item-center justify-content-between small">
                        <div class="text-muted">&copy; 2023 Prasta Haitsam & Yozakha Kirnanta.unigamalang</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="alat2/bootstrap.bundle.min.js"></script>
    <script src="alat2/scripts.js"></script>
</body>

</html>
