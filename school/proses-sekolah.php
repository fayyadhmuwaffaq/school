<?php

require_once "../config.php";


// jika tombol simpan ditekan

if (isset($_POST['simpan'])) {
    // ambil value yg di posting

    $id                = $_POST['id'];
    $nama              = trim(htmlspecialchars($_POST['nama']));
    $email             = trim(htmlspecialchars($_POST['email']));
    $status            =  $_POST['status'];
    $akreditasi        =  $_POST['akreditasi'];
    $alamat            = trim(htmlspecialchars($_POST['alamat']));
    $visimisi          = trim(htmlspecialchars($_POST['visimisi']));
    $gbr               = trim(htmlspecialchars($_POST['gbrLama']));


    // cek apakah ada gambar user

    if ($_FILES['image']['error'] === 4) {
        $gbrsekolah   = $gbr;
    } else {
        $url = 'profile-sekolah.php';
        $gbrsekolah = uploadimg($url);
        @unlink('../asset/image/' . $gbr);
    }


    // update data
    mysqli_query($koneksi, "UPDATE tbl_sekolah SET 
    nama       = '$nama',
    email      = '$email', 
    status     = '$status',
    akreditasi = '$akreditasi',
    alamat     = '$alamat',
    visimisi   = '$visimisi',
    gambar     = '$gbrsekolah'
    WHERE id   =  $id             
     ");

    header("location:profile-sekolah.php?msg=updated");
    return;
}
