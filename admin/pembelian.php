<h2> Data pembelian</h2>

<table class="table table-bordered"> 
    <thead>
            <tr>
                <th>no</th>
                <th>nama pelanggan</th>
                <th>Tanggal</th>
                <th>total</th>
                <th>aksi</th>
            </tr>

    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.
        id_pelanggan=pelanggan.id_pelanggan");?>
        <?php while( $pecah = $ambil->fetch_assoc()){?>
        <tr>
            <td><?php echo $nomor;?></td>
            <td><?php echo $pecah['nama_pelanggan'];?></td>
            <td><?php echo $pecah['tanggal_pembelian'];?></td>
            <td><?php echo $pecah['total_harga'];?></td>
            <td>
                <a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>"
                class="btn btn-info">detail</a>
                
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>   
    </tbody>
</table>