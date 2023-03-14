<?php
session_start();
//mendapatkan id_produk dari url
$id_produk=$_GET['id'];

//jk sdh ad aproduk di keranjang maka produk jumlah +1
if (isset($_SESSION['keranjang'][$id_produk])){
    $_SESSION['keranjang'][$id_produk]+=1;
}
//selain itu, mk produk itu dianggap dibeli 1
else{
    $_SESSION['keranjang'][$id_produk]=1;
}


echo "<script> alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='keranjang.php'</script>";
?>