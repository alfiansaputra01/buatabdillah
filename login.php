<?php
session_start();
//koneksi ke database
$koneksi=new mysqli("localhost","root","","tokomputer"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login User</title>
    
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
    <!-- navbar -->
    <?php include 'navbar.php';?>

        
    <div class="container">
            <div class="row text-center ">
                <div class="col-md-12">
                    <br /><br />
                    <h2> Tokomputer : Login</h2>
                
                    <h5>( Login yourself to get access )</h5>
                    <br />
                </div>
            </div>
            <div class="row ">
                
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                            <strong>   Enter Details To Login </strong>  
                                </div>
                                <div class="panel-body">
                                    <form role="form" method="post">
                                        <br />
                                        <label>
                                                Email
                                            </label>
                                        <div class="form-group input-group">
                                            
                                                <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                                <input type="text" class="form-control" name="user"/>
                                            </div>
                                            <label>
                                                Password
                                            </label>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                                <input type="password" class="form-control" name="pass"/>
                                            </div>
                                        <div class="form-group">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" /> Remember me
                                                </label>
                                                

                                        <button class="btn tbn-primary" name="login" style="background-color: blue; color: white">Login</button>
                                        <hr />
                                        Not register ? <a href="daftar.php" >click here </a> 
                                        </form>
                                        <?php 
                                        if (isset($_POST['login'])){
                                        $ambil= $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$_POST[user]'
                                            AND password_pelanggan='$_POST[pass]'");
                                            $cocok=$ambil->num_rows;
                                            if($cocok==1){
                                                $akun=$ambil->fetch_assoc();
                                                $_SESSION['admin']=$ambil->fetch_assoc();
                                                $_SESSION["pelanggan"]=$akun;
                                                echo "<div class='alert alert-info'>Login sukses </div>";
                                                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                                            }
                                            else{
                                                echo "<div class='alert alert-danger'>Login gagal </div>";
                                                echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                                            }
                                        }
                                        ?>
                                </div>
                                </div>
                            </div>
                    </div>
            </div>
    </div>

    <?php



    ?>
</div>
</body>
</html>