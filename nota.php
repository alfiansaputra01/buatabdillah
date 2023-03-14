<?php
session_start();
//koneksi ke database
$koneksi=new mysqli("localhost","root","","tokomputer");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <
    <title>Nota Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    
</head>
<body>
<?php include 'navbar.php';?>

<section class="konten">
    <div class="container">

    <h2> Detail Pembelian </h2>
<?php
$ambil= $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON
                pembelian.id_pelanggan=pelanggan.id_pelanggan
                WHERE pembelian.id_pembelian='$_GET[id]'");
$detail=$ambil->fetch_assoc();
?>

<strong><?php echo $detail['nama_pelanggan'];?></strong> <br>
<p>
    <?php echo $detail['nohp_pelanggan']; ?> <br>
    <?php echo $detail['email_pelanggan']; ?> <br>
</p>
<p>
    tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>   
    total harga : <?php echo $detail['total_harga']; ?>
</p>
<table class="table table-bordered"> 
    <thead>
            <tr>
                <th>no</th>
                <th>nama Produk</th>
                <th>harga</th>
                <th>jumlah</th>
                <th>total harga</th>
            </tr>

    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON
                        pembelian_produk.id_produk=produk.id_produk WHERE
                        pembelian_produk.id_pembelian='$_GET[id]'"); ?>
        <?php while( $pecah = $ambil->fetch_assoc()){?>
        <tr> 
            <td><?php echo $nomor;?></td>
            <td><?php echo $pecah['nama_produk'];?></td>
            <td><?php echo $pecah['harga_produk'];?></td>
            <td><?php echo $pecah['jumlah_produk'];?></td>
            <td>
                <?php echo $pecah['harga_produk']*$pecah['jumlah_produk'];?>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>   
    </tbody>
</table>

<div class="row">
    <div class="col-md-7">
        <div class="alert alert-info">
            <p>
                Silahkan melakukan pembayaran sebesar IDR <?php echo number_format($detail['total_harga']); ?>
            </p>
        </div>

    </div>
</div>
    </div>
</section>

</body>
</html>