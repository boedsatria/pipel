<?php

function check_already_login()
{
    $ci =& get_instance();
    $user_session = $ci->session->userdata('id_operator');
    if($user_session){
        redirect('Dashboard');
    }
}

function check_not_login()
{
    $ci =& get_instance();
    $user_session = $ci->session->userdata('id_operator');
    if(!$user_session){
        redirect('Auth/login');
    }
}

function tgl_indo_lengkap($tanggal){
    if ($tanggal == '0000-00-00') return ' '; 
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun
 
    return (string)((int)($pecahkan[2])) . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function check_admin() {
    $ci =& get_instance();
    $ci->load->library('fungsi');
        if($ci->fungsi->user_login()->level != 1) {
        redirect('dashboard');
    }
}
