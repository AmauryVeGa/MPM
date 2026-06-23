<?php
session_start();
session_destroy();

echo "<script>alert('Sesión Cerrada'); 
     window.location.href='../Index.php';</script>";
?>