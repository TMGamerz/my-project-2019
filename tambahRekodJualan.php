<!-- Halaman untuk menambah rekod item -->
<?php
    require 'header.php';
    include 'includes/dbh.inc.php';
    // sql untuk mencapai data item dari pangkalan data
    $sql = "SELECT * FROM `item`";
    $hasil = mysqli_query($conn, $sql);

    // Mengistiharkan nilai asal
    $jumlahJualanCalc = false;
    $tarikhJualan = "mm/dd/yyyy";
    $hargaPerItem = 0;
    $kuantiti = 1;
    $itemTerpilih = "";
    $jumlahJualan = 0;

    // Memaparka harga per item
    if (isset($_POST['namaItem'])) {
        $tarikhJualan = $_POST['tarikhJualan'];
        $itemTerpilih = $_POST['namaItem'];
        $sql2 = "SELECT `HargaPerItem` FROM `item` WHERE `KodItem` = '$itemTerpilih'";
        $hasil2 = mysqli_query($conn, $sql2);
        $hargaPerItem = mysqli_fetch_assoc($hasil2)['HargaPerItem'];
    }

    // Mengira jumlah jualan
    if (isset($_POST['kuantiti'])) {
        $jumlahJualanCalc = true;
        $tarikhJualan = $_POST['tarikhJualan'];
        $kuantiti = $_POST['kuantiti'];
        $jumlahJualan = $hargaPerItem * $kuantiti;
    }
?>

    <head>
        <link rel = "stylesheet" type = "text/css" href = "css/tambahRekod-style.css">
        <title>Tambah Rekod Jualan</title>
    </head>

    <body>
<div class = "container">
    <h1>Tambah Rekod Jualan</h1>
    <!-- Form untuk menambah rekod jualan -->
    <form name = "tambahJualanForm" action = "includes/tambahRekodJualan.inc.php" method = "POST">
        <table align = "center">
            <!-- Input tarikh jualan -->
            <tr class = "row">
                <td class = "col-25">
                    <label for = "tarikh_jualan">Tarikh Jualan: </label>
                </td>

                <td class = "col-75">
                    <input type = "date" id = "tarikh_jualan" name = "tarikhJualan" value = "<?php echo $tarikhJualan ?>">
                </td>
            </tr>
            <!-- Input nama item -->
            <tr class = "row">
                <td class = "col-25">
                    <label for = "nama_item">Nama Item: </label>
                </td>

                <td class = "col-75">
                    <select class = "tambah-select" id = "nama_item" name = "namaItem" onChange="reSubmit();" required>
                        <option disabled hidden selected></option>
                        <?php
                        $sql3 = "SELECT KodItem, NamaItem FROM `item`";
                        $hasil3 = mysqli_query($conn, $sql3);
                        while ($row3 = mysqli_fetch_assoc($hasil3)) {
                            $kodItem = $row3['KodItem'];
                            $namaItem = $row3['NamaItem'];
                            if ($kodItem != $itemTerpilih) {
                                echo "<option value=\"" . $kodItem . "\">" . $namaItem . "</option>";
                            } else {
                                echo "<option selected value=\"" . $kodItem . "\">" . $namaItem . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr class = "row">
                <td class = "col-25">
                    <label for = "harga_per_item">Harga Per Item: </label>
                </td>

                <td class = "col-75">
                    <input type = "number" id = "harga_per_item" name = "hargaPerItem" value = "<?php echo $hargaPerItem; ?>" min = "1" required readonly>
                </td>
            </tr>
            <!-- Input kuantiti item dijual-->
            <tr class = "row">
                <td class = "col-25">
                    <label for = "kuantiti_item_dijual">Kuantiti Item Dijual: </label>
                </td>

                <td class = "col-75">
                    <input type = "number" id = "kuantiti_item_dijual" name = "kuantiti" onChange="reSubmit()" value = "<?php echo $kuantiti; ?>" min = "1" required>
                </td>
            </tr>

            <tr class = "row">
                <td class = "col-25">
                    <label for = "harga_jualan">Harga Jualan: </label>
                </td>

                <td class = "col-75">
                    <input type = "number" id = "harga_jualan" name = "hargaJualan" min="0.00" step="0.01" value = "<?php echo $jumlahJualan; ?>" required readonly>
                </td>
            </tr>

            <tr class = "row">
                <td colspan = "2">
                    <input type="submit" value = "Tambah" name = "tambah">
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
    function reSubmit() {
        document.getElementsByName("tambahJualanForm")[0].action = "<?php echo $_SERVER["PHP_SELF"]; ?>";
        document.tambahJualanForm.submit();
    }
</script>

<?php
require "footer.php";
?>