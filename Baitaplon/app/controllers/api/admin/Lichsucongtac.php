<?php


class Lichsucongtac
{
    private $model;

    function __construct()
    {
        require_once __DIR__ . '/../../../models/Database.php';
        $this->model = new Database();
        header('Content-Type: application/json');
    }

    // Lấy danh sách hoặc tìm kiếm lịch sử công tác (GET /api/admin/Lichsucongtac?search-ma=...)
    public function index()
    {
        $condition = '';
        if (isset($_GET['search-ma']) && $_GET['search-ma'] !== '') {
            $searchMa = htmlspecialchars($_GET['search-ma']);
            $condition = "WHERE Manv = '$searchMa'";
        }
        $data = $this->model->select([], 'lichsucongtac', $condition);
        echo json_encode(['data' => $data]);
    }

    // Thêm lịch sử công tác (POST /api/admin/Lichsucongtac)
    public function store()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            http_response_code(400);
            echo json_encode(['error' => 'Dữ liệu gửi lên không hợp lệ!']);
            return;
        }
        if (!isset($input['Manv'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Thiếu mã nhân viên!']);
            return;
        }
        $check = $this->model->isDuplicate('lichsucongtac', 'Manv', $input['Manv']);
        if ($check == 0) {
            $result = $this->model->insert('lichsucongtac', $input);
            if ($result) {
                echo json_encode(['message' => 'Thêm lịch sử công tác thành công!']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Thêm lịch sử công tác thất bại!']);
            }
        } else {
            http_response_code(409);
            echo json_encode(['error' => 'Trùng mã nhân viên!']);
        }
    }

    // Sửa lịch sử công tác (PUT /api/admin/Lichsucongtac/{manhanvien})
    public function update($manhanvien)
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            http_response_code(400);
            echo json_encode(['error' => 'Dữ liệu gửi lên không hợp lệ!']);
            return;
        }
        $result = $this->model->update('lichsucongtac', $input, "WHERE Manv = '$manhanvien'");
        if ($result) {
            echo json_encode(['message' => 'Sửa lịch sử công tác thành công!']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Không tìm thấy lịch sử công tác để sửa!']);
        }
    }

    // Xóa lịch sử công tác (DELETE /api/admin/Lichsucongtac/{manhanvien})
    public function destroy($manhanvien)
    {
        $result = $this->model->delete('lichsucongtac', "WHERE Manv = '$manhanvien'");
        if ($result) {
            echo json_encode(['message' => 'Xóa lịch sử công tác thành công!']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Không tìm thấy lịch sử công tác để xóa!']);
        }
    }

    // Lấy chi tiết 1 lịch sử công tác (GET /api/admin/Lichsucongtac/{manhanvien})
    public function show($manhanvien)
    {
        $data = $this->model->select([], 'lichsucongtac', "WHERE Manv = '$manhanvien'");
        if ($data && count($data) > 0) {
            echo json_encode(['data' => $data[0]]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Không tìm thấy lịch sử công tác!']);
        }
    }
}