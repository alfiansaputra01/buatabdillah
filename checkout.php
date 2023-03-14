<?php
session_start();
//koneksi ke database
$koneksi=new mysqli("localhost","root","","tokomputer");

//jk blm login
if(!isset($_SESSION["pelanggan"])){
    echo "<script>alert('Silahkan login terlebih dahulu'); </script>";
    echo "<script>location='login.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">

</head>
<body>
    
<?php include 'navbar.php';?>

<section class="konten">
    <div>
        <h1>Keranjang Belanja</h1>
        <hr>
        <table class="table table-borddered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php $totalbelanja=0;?>
                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah):
                ?>
                <!--output berdasarkan id-->
                <?php
                $ambil=$koneksi->query("SELECT *FROM produk WHERE id_produk='$id_produk'");
                $pecah=$ambil->fetch_assoc();
                $totalharga=$pecah["harga_produk"]*$jumlah;
                ?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $pecah["nama_produk"];?></td>
                    <td>IDR <?php echo number_format($pecah['harga_produk']);?></td>
                    <td><?php echo $jumlah;?></td>
                    <td>Rp. <?php echo number_format($totalharga);?></td>
                    
                </tr>
                <?php $nomor++;?>
                <?php $totalbelanja+=$totalharga;?>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total Belanja</th>
                    <th>Rp. <?php echo number_format($totalbelanja)?></th>
                </tr>
            </tfoot>
        </table>
        <form method="post">
               
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION ['pelanggan']['nama_pelanggan']?>"
                            class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION ['pelanggan']['nohp_pelanggan']?>"
                            class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="id_ongkir">
                            <option value="">Pilih Ongkos Kirim</option>
                            <?php
                            $ambil= $koneksi->query("SELECT * FROM ongkir");
                            while($perongkir=$ambil->fetch_assoc()){
                            ?>
                            <option value="<?php echo $perongkir["id_ongkir"]?>">
                                <?php echo $perongkir['nama_kota']?>
                               Rp. <?php echo number_format($perongkir['tarif'])?>
                            </option>
                           
                            <?php } ?>
                       </select>
                    </div>
                </div>
                <button class="btn btn-primary" name="checkout">Checkout</button>
        </form>

        <?php
            if(isset($_POST["checkout"])){
                $id_pelanggan=$_SESSION["pelanggan"]["id_pelanggan"];
                $id_ongkir=$_POST["id_ongkir"];
                $tanggal_pembelian=date("Y-m-d");

                $ambil=$koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                $arrayongkir=$ambil->fetch_assoc();
                $tarif=$arrayongkir['tarif'];
                $total_harga=$totalbelanja+$tarif;

                $koneksi->query("INSERT INTO pembelian (id_pelanggan, id_ongkir, tanggal_pembelian,total_harga)
                VALUES('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_harga')");
                
               

                //mendapatkan id_pembelian
                $id_pembelian_barusan=$koneksi->insert_id;

                foreach($_SESSION["keranjang"] as $id_produk=>$jumlah_produk){
                    $koneksi->query("INSERT INTO pembelian_produk(id_pembelian,id_produk,jumlah_produk)
                    VALUES('$id_pembelian_barusan','$id_produk','$jumlah_produk')");
                }
                //mengkosongkan keranjaang belanj
                unset($_SESSION["keranjang"]);

                //tampilan dialihkan ke halaman nota

                echo "<script>alert('pembelian sukses');</script>";
                echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

            }
        ?>

    </div>
</section>

</body>
</html>