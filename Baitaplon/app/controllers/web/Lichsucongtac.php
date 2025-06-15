<?php

require_once __DIR__ . '/../../models/Database.php';
require_once __DIR__ . '/../../../core/SqlConnection.php';

$db = new Database();

$action = $_GET['action'] ?? '';
$manv = $_GET['id'] ?? '';

if ($action === 'ThemLichsucongtac') {
    // Lấy danh sách nhân viên để chọn khi thêm
    $nhanvien = $db->select(['Manv', 'Hocvi'], 'hsnhansu', '');
    include __DIR__ . '/../../views/Themlichsucongtac.php';
    exit;
}

if ($action === 'SuaLichsucongtac' && $manv) {
    $table = $db->select([], 'lichsucongtac', "WHERE Manv = '$manv'");
    $row = $table[0] ?? null;  // THÊM DÒNG NÀY
    $nhanvien = $db->select(['Manv', 'Hocvi'], 'hsnhansu', '');
    include __DIR__ . '/../../views/Sualichsucongtac.php';
    exit;
}


// Mặc định: hiển thị danh sách
$condition = '';
if (isset($_GET['search-ma']) && $_GET['search-ma'] !== '') {
    $searchMa = htmlspecialchars($_GET['search-ma']);
    $condition = "WHERE Manv = '$searchMa'";
}
$data = $db->select([], 'lichsucongtac', $condition);
include __DIR__ . '/../../views/Lichsucongtac.php';