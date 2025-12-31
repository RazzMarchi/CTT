<?php
include "../config/auth.php";
include "../config/auth_admin.php";
include "../config/db.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$conn->query("DELETE FROM pegawai WHERE id = $id");

header("Location: index.php");
exit;
