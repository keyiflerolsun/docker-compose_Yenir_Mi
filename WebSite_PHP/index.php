<!-- Bu araç @keyiflerolsun tarafından | @KekikAkademi için yazılmıştır. -->

<html>

<head>
    <title>docker-compose Yenir Mi | @keyiflerolsun</title>
</head>

<body>
    <h1>Ürünler</h1>

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
</body>

</html>