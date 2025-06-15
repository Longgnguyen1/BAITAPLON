
<!DOCTYPE html>
<html lang="vi">
  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Baitaplon/public/css/reset.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <title>Quản lý lịch sử công tác</title>
  <style>
    html, body { width: 100vw; height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .header { width: 100%; height: 70px; background: #3498db; color: #fff; display: flex; align-items: center; padding-left: 32px; font-size: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.07);}
    .body-con { display: flex; min-height: calc(100vh - 70px);}
    .sidebar { width: 220px; background: #2980b9; color: #fff; padding: 0; flex-shrink: 0; display: flex; flex-direction: column; align-items: stretch;}
    .sidebar a, .sidebar ul li a { color: #fff; text-decoration: none; display: block; padding: 16px 24px; transition: background 0.2s;}
    .sidebar a.menu-toggle { font-weight: bold; background: #2c3e50; }
    .sidebar a:hover, .sidebar ul li a:hover { background: #34495e; }
    .sidebar ul { list-style: none; padding: 0; margin: 0;}
    .sidebar ul li { border-bottom: 1px solid #22313a; }
    .sidebar .menu-icon { width: 20px; height: 20px; margin-right: 8px; vertical-align: middle; }
    .content { flex: 1; padding: 32px; background: #fff; min-height: 100vh;}
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
      <a href="<?=_WEB_HOST?>/Login/logout">
        <img src="/Baitaplon/public/img/dangxuat.png" alt="Đăng xuất" class="menu-icon">
        Đăng xuất
      </a>
    </div>
    <div class="content">
      <div class="table-data mb-3">
        <a href="<?=_WEB_HOST?>/Lichsucongtac/ThemLichsucongtac" class="btn btn-success">Thêm</a>
        <form class="d-inline-block float-end" method="get" action="<?=_WEB_HOST?>/Lichsucongtac">
          <input type="text" name="search-ma" placeholder="Tìm kiếm theo mã" value="<?= isset($_GET['search-ma']) ? htmlspecialchars($_GET['search-ma']) : '' ?>" class="form-control d-inline-block" style="width:180px;display:inline-block;">
          <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>
      </div>
      <div class="table_container" style="margin-top:20px">
        <table class="table table-hover table-bordered table-striped">
          <thead>
            <tr style="height: 40px; font-weight: bold;text-align: center">
              <th>Mã nhân viên</th>
              <th>Nơi làm việc trước đây</th>
              <th>Vị trí công tác</th>
              <th>Ngày bắt đầu làm</th>
              <th>Ngày kết thúc làm</th>
              <th>Hợp đồng lao động</th>
              <th>Học vị</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
          <?php if (!empty($data)): foreach ($data as $row): ?> 
            <tr>
                <td><?= htmlspecialchars($row['Manv']) ?></td>
                <td><?= htmlspecialchars($row['Noilamviec']) ?></td>
                <td><?= htmlspecialchars($row['Vitricongtac']) ?></td>
                <td><?= date('d/m/Y', strtotime($row['Ngaybatdaulam'])) ?></td>
                <td><?= date('d/m/Y', strtotime($row['Ngayketthuclam'])) ?></td>
                <td><?= htmlspecialchars($row['Hopdonglaodong']) ?></td>
                <td><?= htmlspecialchars($row['Hocvi']) ?></td>
                <td style="text-align: center">
                    <a href="<?= _WEB_HOST ?>/Lichsucongtac/SuaLichsucongtac/<?= $row['Manv'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="<?= _WEB_HOST ?>/Lichsucongtac/XoaLichsucongtac/<?= $row['Manv'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xác nhận xóa!')">Xóa</a>
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
    const menuToggle = document.querySelector('.menu-toggle');
    menuToggle.addEventListener('click', function () {
      this.classList.toggle('active');
    });
  </script>
</body>
</html>