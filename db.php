<?php

class db{
    private $koneksi;
    function __construct()
    {
        $this->koneksi= $koneksi=new mysqli("localhost","root","","db_latihan");

    }
    function get_user($username,$password){
        $data=$this->koneksi->query("select * from tbl_user where username='$username' and password='$password'");
        return $data;
    }

}

?>
