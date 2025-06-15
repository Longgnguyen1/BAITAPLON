
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý hồ sơ nhân sự</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"/>
    <style>
        body { margin: 0; padding: 0; background: #f5f6fa; }
        .header {
            width: 100%; height: 70px; background: #2980b9; color: #fff;
            display: flex; align-items: center; padding-left: 32px; font-size: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        .body-con {
            display: flex; min-height: calc(100vh - 70px);
        }
        .sidebar {
            width: 220px; background: #34495e; color: #fff; padding: 0; flex-shrink: 0;
            display: flex; flex-direction: column; align-items: stretch;
        }
        .sidebar a, .sidebar ul li a {
            color: #fff; text-decoration: none; display: block; padding: 16px 24px;
            transition: background 0.2s;
        }
        .sidebar a.menu-toggle { font-weight: bold; background: #2c3e50; }
        .sidebar a:hover, .sidebar ul li a:hover { background: #2980b9; }
        .sidebar ul { list-style: none; padding: 0; margin: 0; }
        .sidebar ul li { border-bottom: 1px solid #22313a; }
        .sidebar .menu-icon { width: 20px; height: 20px; margin-right: 8px; vertical-align: middle; }
        .content {
            flex: 1; padding: 32px; background: #fff; min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="font-size:1.7rem; margin:0;">Chào mừng ADMIN</h1>
    </div>
    <div class="body-con">
        <div class="sidebar">
            <a href="#" class="menu-toggle">
                <img src="/Baitaplon/public/img/menu.png" alt="Menu" class="menu-icon">
                Menu
            </a>
            <ul>
                <li><a href="<?=_WEB_HOST?>/HSnhansu">Quản lý hồ sơ nhân sự</a></li>
                <li><a href="<?=_WEB_HOST?>/Phongban">Quản lý phòng ban</a></li>
                <li><a href="<?=_WEB_HOST?>/Quanlycongviec">Quản lý công việc</a></li>
                <li><a href="<?=_WEB_HOST?>/Lichsucongtac">Quản lý lịch sử công tác</a></li>
                <li><a href="<?=_WEB_HOST?>/NghiPhep">Quản lý nghỉ phép</a></li>
                <li><a href="<?=_WEB_HOST?>/Taikhoan">Quản lý tài khoản</a></li>
            </ul>
            <a href="<?=_WEB_HOST?>/Login">
                <img src="/Baitaplon/public/img/dangxuat.png" alt="Đăng xuất" class="menu-icon">
                Đăng xuất
            </a>
        </div>
        <div class="content">
            <!-- Chèn bảng dữ liệu nhân sự hoặc nội dung khác ở đây -->
            <div class="table-data">
                <!-- Ví dụ: bảng nhân sự -->
                <a href="<?=_WEB_HOST?>/HSnhansu/ThemHSnhansu" class="btn btn-success mb-3">Thêm nhân viên</a>
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã NV</th>
                            <th>Tên NV</th>
                            <th>SĐT</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Chức vụ</th>
                            <th>Học vị</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($table)): foreach ($table as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['Manv']) ?></td>
                            <td><?= htmlspecialchars($row['Tennv']) ?></td>
                            <td><?= htmlspecialchars($row['Sodt']) ?></td>
                            <td><?= htmlspecialchars($row['Email']) ?></td>
                            <td><?= htmlspecialchars($row['Diachi']) ?></td>
                            <td><?= htmlspecialchars($row['Chucvu']) ?></td>
                            <td><?= htmlspecialchars($row['Hocvi']) ?></td>
                            <td>
                                <a href="<?= _WEB_HOST ?>/HSnhansu/SuaHSnhansu/<?= $row['Manv'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                <button class="btn btn-danger btn-delete btn-sm" data-id="<?= $row['Manv'] ?>">Xóa</button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="8" style="text-align:center">Không có dữ liệu</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    // Xóa nhân sự
    document.querySelectorAll('.btn-delete').forEach(btn => {
      btn.addEventListener('click', function() {
        if (confirm('Xác nhận xóa!')) {
          const manv = this.getAttribute('data-id');
          fetch('/Baitaplon/api/admin/HSnhansu/' + manv, {
            method: 'DELETE'
          })
          .then(res => res.json())
          .then(data => {
            alert(data.message || data.error);
            if (!data.error) window.location.href = "<?= _WEB_HOST ?>/HSnhansu";
          });
        }
      });
    });
    </script>
</body>
</html>