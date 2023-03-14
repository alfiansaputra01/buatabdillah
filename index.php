<?php
session_start();
//koneksi ke database
$koneksi=new mysqli("localhost","root","","tokomputer"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Tokomputer</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">

    <style>
        .bg {
            background-image: url(picture/bc.jpg);
        }
            /* min-height: 100%;
            min-width: 1024px;
            width: 100%;
            height: auto;
            position: fixed;
            top: 0;
            left: 0;
        }
 
         @media screen and (max-width: 1024px) {
            .bg {
                left: 50%;
                margin-left: -512px;   /* 50% */

        .judul {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 50px;
            font-style: oblique;
            color: white;
            background-color:grey;

        }

    </style>
    

</head>
<body>
    <div class="bg">
        <?php include 'navbar.php';?>

        <!-- konten -->

        <section class="konten">
            <div class="container">
                <div class="judul">
                    Selamat Datang di Toko Komputer
                </div>

                
                <div class="row">


                    <?php $ambil=$koneksi->query("SELECT * FROM produk");?>
                    <?php while($perproduk = $ambil->fetch_assoc()){?>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" width="200" height="100">
                            <div class="caption">
                                <h3><?php echo $perproduk['nama_produk'];?></h3>
                                <h5><?php echo number_format($perproduk['harga_produk']);?></h5>
                                <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                
                </div>
            </div>
        </section>

    </div>
</body>
</html>