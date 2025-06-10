<?php

class HSnhansu
{
    private $model;

    function __construct()
    {
        require_once __DIR__ . '/../../../models/Database.php';
        $this->model = new Database();
        header('Content-Type: application/json');
    }

    // Lấy danh sách hoặc tìm kiếm nhân sự (GET /api/admin/HSnhansu?search-ma=...)
    public function index()
    {
        $condition = '';
        if (isset($_GET['search-ma']) && $_GET['search-ma'] !== '') {
            $searchMa = htmlspecialchars($_GET['search-ma']);
            $condition = "WHERE Manv = '$searchMa'";
        }
        $data = $this->model->select([], 'hsnhansu', $condition);
        echo json_encode(['data' => $data]);
    }

    // Thêm nhân sự (POST /api/admin/HSnhansu)
    public function store()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid input']);
            return;
        }
        if (!isset($input['Manv'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Thiếu mã nhân viên!']);
            return;
        }
        $check = $this->model->isDuplicate('hsnhansu', 'Manv', $input['Manv']);
        if ($check == 0) {
            $this->model->insert('hsnhansu', $input);
            echo json_encode(['message' => 'Thêm nhân viên thành công!']);
        } else {
            http_response_code(409);
            echo json_encode(['error' => 'Trùng mã nhân viên!']);
        }
    }

    // Sửa nhân sự (PUT /api/admin/HSnhansu/{manhanvien})
    public function update($manhanvien)
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid input']);
            return;
        }
        $this->model->update('hsnhansu', $input, "WHERE Manv = '$manhanvien'");
        echo json_encode(['message' => 'Sửa nhân viên thành công!']);
    }

    // Xóa nhân sự (DELETE /api/admin/HSnhansu/{manhanvien})
    public function destroy($manhanvien)
    {
        $result = $this->model->delete('hsnhansu', "WHERE Manv = '$manhanvien'");
        if ($result) {
            echo json_encode(['message' => 'Xóa nhân viên thành công!']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Không tìm thấy nhân viên!']);
        }
    }

    // Lấy chi tiết 1 nhân sự (GET /api/admin/HSnhansu/{manhanvien})
    public function show($manhanvien)
    {
        $data = $this->model->select([], 'hsnhansu', "WHERE Manv = '$manhanvien'");
        if ($data && count($data) > 0) {
            echo json_encode(['data' => $data[0]]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Không tìm thấy nhân viên!']);
        }
    }
}



if ($action === 'SuaHSnhansu' && $manv) {
    $nhansu = $db->select([], 'hsnhansu', "WHERE Manv = '$manv'");
    $nhansu = $nhansu ? $nhansu[0] : null;
    include __DIR__ . '/../../views/SuaHSnhansu.php';
    exit;
}