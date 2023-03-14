<?php $koneksi=new mysqli("localhost","root","","tokomputer"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Daftar</title>
    
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">

    <style>
        .bg {
            background-image: url(picture/bc.jpg);
            min-height: 100%;
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
            }
        }
    </style>
    
</head>
<body>
<div class="bg">

<?php include 'navbar.php';?>

<div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> Tokomputer : Register</h2>
               
                <h5>( Dftar untuk mendapatkan akses )</h5>
                 <br />
            </div>
        </div>
         <div class="row">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>  Pengguna baru? Daftarkan dirimu </strong>  
                            </div>
                            <div class="panel-body">
                                <form method="POST">
<br/>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Nama Anda" name="nama">
                                        </div>
                                     
                                         <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="Masukkan Email" name="email" >
                                        </div>
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Masukkan Password" name="password">
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Masukkan No. HP" name="nohp">
                                        </div>
                                     
                                     <button class="btn btn-primary" name="daftar">Daftar</button>
                                    <hr />
                                    Sudah terdaftar ?  <a href="login.php" >Login disini</a>
                                    </form>
                                    <?php
                                    if(isset($_POST["daftar"])){
                                        //mengambil semua data pelanggan
                                        $nama=$_POST["nama"];
                                        $email=$_POST["email"];
                                        $password=$_POST["password"];
                                        $nohp=$_POST["nohp"];

                                        //ngecek email yg digunakan
                                        $ambil=$koneksi->query("SELECT * FROM pelanggan WHERE 
                                                                email_pelanggan='$email'");
                                        $cocok=$ambil->num_rows;
                                        if($cocok==1){
                                            echo "<script>alert('pendaftaran gagal karena email sudah digunakan');</script>";
                                            echo "<script>location='daftar.php';</script>";
                                        }
                                        else{
                                            $koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,
                                            nohp_pelanggan) VALUES ('$email','$password','$nama','$nohp')");

                                            echo "<script>alert('pendaftaran sukses, silahkan login');</script>";
                                            echo "<script>location='login.php';</script>";
                                        }
                                        
                                    }

                                     ?>

                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>
</div>
</body>
</html>