<!doctype html>
<html lang="tr">

<head>
    <!-- ? Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Language" content="tr">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Başlık</title>
    <meta name="description" content="Açıklama">
    <meta name="keywords"    content="keyiflerolsun, Ömer Faruk Sancak, KekikAkademi, Kekik Akademi">
    <meta name="author"      content="keyiflerolsun">

    <!-- ? Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>

    <h1><i class="fas fa-shopping-basket"></i> Ürünler</h1>

    <ul>
        <?php

            $api_veri = file_get_contents("http://urunapi_py:5000/");
            $api_obje = json_decode($api_veri);

            $urunler = $api_obje->Urunler;

            foreach ($urunler as $urun) {
                echo "<li>$urun</li>";
            }

        ?>
    </ul>


<!-- ! Bu araç @keyiflerolsun tarafından | @KekikAkademi için yazılmıştır.
* ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣀⠀⠀⠀⡀⠀⠀⠀
* ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠘⣿⣷⣤⣾⡇⠀⠀⠀
* ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⡆⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣈⡛⣿⡟⠁⢀⣀⠀
* ⠀⠀⠀⢰⡄⠀⠀⠀⠀⠀⢸⣿⡀⠀⠀⠀⠀⠀⠀⠀⠀⠙⠻⠿⠾⣷⣾⠿⠃⠀
* ⠀⠀⠀⠈⣿⣦⡀⠀⠀⠀⣿⣿⣧⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣿⠀⠀⠀⠀
* ⠀⠀⠀⠀⣿⣿⣿⣦⡀⠀⣿⣿⣿⣧⡀⠀⠀⠀⠀⢀⣤⣤⣤⣀⡀⠛⠀⠀⠀⠀
* ⠀⠀⠀⠀⠘⣿⣿⣿⣿⣶⣄⠙⠻⠿⣷⡀⠀⠀⢀⣿⣿⣿⣿⣿⡿⠶⠀⠀⠀⠀
* ⠀⠀⠀⠀⠀⠘⣿⣿⣿⣿⣿⣿⣶⣦⣤⣤⣤⣤⣾⣿⣿⡏⠉⠀⣤⠄⠀⠀⠀⠀
* ⠀⠀⠀⠀⠀⠀⠈⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⠀⠀⠉⠀⠀⠀⠀⠀
* ⠀⠀⠀⠀⠀⠀⠀⠀⠙⠿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡏⠀⠀⠀⠀⠀⠀⠀⠀⠀
* ⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⣿⣿⣿⣿⣿⣿⣿⣿⣿⠟⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
* ⠀⣼⣷⣶⣶⣶⣶⣶⣾⣿⣿⣿⣿⣿⣿⣿⡿⠟⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
* ⠀⢻⣿⣿⣿⣿⣿⠿⠟⠛⠛⠛⠋⠉⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
* ⠀⠘⢿⣿⣿⠟⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
* ⠀⠀⠀⠉⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
! -->
</body>
</html>