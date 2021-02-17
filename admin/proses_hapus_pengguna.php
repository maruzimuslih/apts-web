<?php
    include "../koneksi.php";    

    $email = $_GET['email'];
    
    $get_user = mysqli_query($connect, "SELECT level, id_user FROM tb_user WHERE email = '$email' ");
    $user = mysqli_fetch_array($get_user);
    
    if ($user['level']=='pj') {
        $get_pj = mysqli_query($connect, "SELECT id_pj FROM tb_pj WHERE id_user = '".$user['id_user']."' ");
        $pj = mysqli_fetch_array($get_pj);
        if (isset($pj)) {
            $get_armada = mysqli_query($connect, "SELECT id_armada FROM tb_armada WHERE id_pj = '".$pj['id_pj']."' ");
            $armada = mysqli_fetch_array($get_armada);
            if (isset($armada)) {                
                $get_pesanan = mysqli_query($connect, "SELECT id_pesanan FROM tb_pemesanan WHERE id_armada= '".$armada['id_armada']."' ");
                $pesanan = mysqli_fetch_array($get_pesanan);
                if (isset($pesanan)) {
                    $del_infoBayar = mysqli_query($connect, "DELETE FROM tb_infopembayaran WHERE id_pesanan = '".$pesanan['id_pesanan']."' ");
                    $del_namausia = mysqli_query($connect, "DELETE FROM tb_namausiapesanan WHERE id_pesanan = '".$pesanan['id_pesanan']."' ");
                    $del_kursipesanan = mysqli_query($connect, "DELETE FROM tb_kursipesanan WHERE id_pesanan = '".$pesanan['id_pesanan']."' ");
                    if (isset($del_infoBayar) || isset($del_namausia) || isset($del_kursipesanan)) {
                        $del_kursi = mysqli_query($connect, "DELETE FROM tb_kursi WHERE id_armada = '".$armada['id_armada']."' ");
                        $del_pesanan = mysqli_query($connect, "DELETE FROM tb_pemesanan WHERE id_pesanan = '".$pesanan['id_pesanan']."' ");
                        if (isset($del_pesanan) || isset($del_kursi)) {
                            $del_armada = mysqli_query($connect, "DELETE FROM tb_armada WHERE id_armada = '".$armada['id_armada']."' ");
                            if (isset($del_armada)) {
                                $del_pj = mysqli_query($connect, "DELETE FROM tb_pj WHERE id_pj = '".$pj['id_pj']."' ");
                                if (isset($del_pj)) {
                                    $del_user = mysqli_query($connect, "DELETE FROM tb_user WHERE id_user = '".$user['id_user']."' ");
                                    header("location:kelola_pengguna.php");
                                }                                
                            }
                        }
                    }
                }else {
                    $del_kursi = mysqli_query($connect, "DELETE FROM tb_kursi WHERE id_armada = '".$armada['id_armada']."' ");
                    if (isset($del_kursi)) {
                        $del_armada = mysqli_query($connect, "DELETE FROM tb_armada WHERE id_armada = '".$armada['id_armada']."' "); 
                        if (isset($del_armada)) {
                            $del_pj = mysqli_query($connect, "DELETE FROM tb_pj WHERE id_pj = '".$pj['id_pj']."' ");
                            if (isset($del_pj)) {
                                $del_user = mysqli_query($connect, "DELETE FROM tb_user WHERE id_user = '".$user['id_user']."' ");
                                header("location:kelola_pengguna.php");
                            }                                
                        }
                    }
                }

            }else {
                $del_pj = mysqli_query($connect, "DELETE FROM tb_pj WHERE id_pj = '".$pj['id_pj']."' ");
                if (isset($del_pj)) {
                    $del_user = mysqli_query($connect, "DELETE FROM tb_user WHERE id_user = '".$user['id_user']."' ");
                    header("location:kelola_pengguna.php");
                }                
            }        
        }
    } else {
        $get_penumpang = mysqli_query($connect, "SELECT id_penumpang FROM tb_penumpang WHERE id_user = '".$user['id_user']."' ");
        $penumpang = mysqli_fetch_array($get_penumpang);
        if (isset($penumpang)) {
            $get_pesanan = mysqli_query($connect, "SELECT id_pesanan FROM tb_pemesanan WHERE id_penumpang= '".$penumpang['id_penumpang']."' ");
            $pesanan = mysqli_fetch_array($get_pesanan);
            if (isset($pesanan)) {
                $del_infoBayar = mysqli_query($connect, "DELETE FROM tb_infopembayaran WHERE id_pesanan = '".$pesanan['id_pesanan']."' ");
                $del_namausia = mysqli_query($connect, "DELETE FROM tb_namausiapesanan WHERE id_pesanan = '".$pesanan['id_pesanan']."' ");
                $del_kursipesanan = mysqli_query($connect, "DELETE FROM tb_kursipesanan WHERE id_pesanan = '".$pesanan['id_pesanan']."' ");
                if (isset($del_infoBayar) || isset($del_namausia) || isset($del_kursipesanan)) {                        
                    $del_pesanan = mysqli_query($connect, "DELETE FROM tb_pemesanan WHERE id_pesanan = '".$pesanan['id_pesanan']."' ");
                    if (isset($del_pesanan)) {
                        $del_penumpang = mysqli_query($connect, "DELETE FROM tb_penumpang WHERE id_penumpang = '".$penumpang['id_penumpang']."' ");
                        if (isset($del_penumpang)) {
                            $del_user = mysqli_query($connect, "DELETE FROM tb_user WHERE id_user = '".$user['id_user']."' ");                                                               
                            header("location:kelola_pengguna.php");
                        }
                    }
                }
            }else {
                $del_penumpang = mysqli_query($connect, "DELETE FROM tb_penumpang WHERE id_penumpang = '".$penumpang['id_penumpang']."' ");
                if (isset($del_penumpang)) {
                    $del_user = mysqli_query($connect, "DELETE FROM tb_user WHERE id_user = '".$user['id_user']."' ");                                                               
                    header("location:kelola_pengguna.php");
                }
            }
        }
    }        
?>