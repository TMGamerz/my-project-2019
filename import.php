<!--Halaman untuk mengimport data ke dalam pangkalan data-->
<?php
    require 'header.php';
?>

<head>
    <!--CSS bagi halaman import-->
    <link rel = "stylesheet" type = "text/css" href = "css/import-style.css">
    <title>Import</title>
</head>

<body>
<div class = "container">  
    <h1>Import Data</h1>

    <!--Form untuk mengimport data ke dalam pangkalan data-->
    <form action = "includes/import.inc.php" method = "POST" enctype = "multipart/form-data">
        <table align = "center">
            <tr class = "row">
                <td class = "col-70">
                    <input type = "file" id = "real-file" name = "importFile" hidden = "hidden" required>
                    <span id = "custom-text">(Nama Fail)</span>
                </td>

                <td class = "col-15">
                    <button type = "button" id = "custom-button">Choose File</button>
                </td>

                <td class = "col-submit">
                    <input type="submit" name = "import" value = "Import">
                </td>
            </tr>
        </table>
    </form>
</div> 

<script type = "text/javascript">
    // Untuk mengayakan elemen import
    const realFileBtn = document.getElementById("real-file");
    const customBtn = document.getElementById("custom-button");
    const customTxt = document.getElementById("custom-text");
    
    customBtn.addEventListener("click", function() {
        realFileBtn.click();
    });

    realFileBtn.addEventListener("change", function() {
        if (realFileBtn.value) {
            customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
        } else {
            customTxt.innerHTML = "(Nama Fail)";
        }
    })
</script>

<?php
    require 'footer.php';
?>