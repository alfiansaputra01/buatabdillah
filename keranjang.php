<?php
session_start();


$koneksi=new mysqli("localhost", "root","", "tokomputer");
if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])){
    echo "<script>alert('Keranjang kosong, kembali ke Home'); </script>";
    echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Keranjang Belanja</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">

    <style>
        .bg {
            background-image: url(picture/bc.jpg);
        }
    </style>
</head>
<body>
    <div class="bg">
        <?php include 'navbar.php';?>


        <section class="konten">
            <div>
                <h1>Keranjang Belanja</h1>
                <hr>
                <table class="table table-bordered" class="table-dark">
                    <thead>
                        <tr class="table-dark">
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
                        <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah):
                        ?>
                        <!--output berdasarkan id-->
                        <?php
                        $ambil=$koneksi->query("SELECT *FROM produk WHERE id_produk='$id_produk'");
                        $pecah=$ambil->fetch_assoc();
                        $totalharga=$pecah["harga_produk"]*$jumlah;
                        ?>
                        <tr class="table table-success table-striped">
                            <td><?php echo $nomor;?></td>
                            <td><?php echo $pecah["nama_produk"];?></td>
                            <td>IDR <?php echo number_format($pecah['harga_produk']);?></td>
                            <td><?php echo $jumlah;?></td>
                            <td>Rp. <?php echo number_format($totalharga);?></td>
                            <td>
                                <a href="hapusproduk.php?id=<?php echo $id_produk?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php $nomor++;?>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <a href="index.php" class="btn btn-default" style="color:white; background-color:green">Lanjutkan Belanja</a>
                <a href="checkout.php" class="btn btn-primary">Checkout</a>
            </div>
        </section>

    </div>


</body>
</html>