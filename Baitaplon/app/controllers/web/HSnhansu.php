<?php

require_once __DIR__ . '/../../models/Database.php';
require_once __DIR__ . '/../../../core/SqlConnection.php';

$db = new Database();

$action = $_GET['action'] ?? '';
$manv = $_GET['id'] ?? '';

if ($action === 'ThemHSnhansu') {
    include __DIR__ . '/../../views/ThemHSnhansu.php';
    exit;
}

if ($action === 'SuaHSnhansu' && $manv) {
    $nhansu = $db->select([], 'hsnhansu', "WHERE Manv = '$manv'");
    $nhansu = $nhansu ? $nhansu[0] : null;
    include __DIR__ . '/../../views/SuaHSnhansu.php';
    exit;
}

// Mặc định: hiển thị danh sách
$table = $db->select([], 'hsnhansu', '');
include __DIR__ . '/../../views/HSnhansu.php';