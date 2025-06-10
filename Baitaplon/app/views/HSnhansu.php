<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/Baitaplon/public/css/reset.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    crossorigin="anonymous"
  />
  <title>Quản lý hồ sơ nhân sự</title>
</head>
<body>
  <div class="header">
    <h1>Chào mừng ADMIN</h1>
  </div>
  <div class="content">
    <div class="table-data">
      <a href="<?=_WEB_HOST?>/HSnhansu/ThemHSnhansu" class="btn btn-success" style="margin-top:20px">Thêm</a>
      <div class="table_container" style="margin-top:20px">
        <table class="table table-hover table-bordered table-striped">
          <thead>
            <tr>
              <th>Mã Nhân viên</th>
              <th>Tên nhân viên</th>
              <th>Số điện thoại</th>
              <th>Email</th>
              <th>Địa chỉ</th>
              <th>Chức vụ</th>
              <th>Học vị</th>
              <th>Xử lý</th>
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
                  <a href="<?= _WEB_HOST ?>/HSnhansu/SuaHSnhansu/<?= $row['Manv'] ?>" class="btn btn-warning">Sửa</a>
                  <button class="btn btn-danger btn-delete" data-id="<?= $row['Manv'] ?>">Xóa</button>
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
          if (!data.error) location.reload();
        });
      }
    });
  });

  // Thêm nhân sự (ở ThemHSnhansu.php)
  document.getElementById('form-them-nv').addEventListener('submit', function(e) {
      e.preventDefault();
      const data = {
          Manv: document.getElementById('Manv').value,
          Tennv: document.getElementById('Tennv').value,
          Sodt: document.getElementById('Sodt').value,
          Email: document.getElementById('Email').value,
          Diachi: document.getElementById('Diachi').value,
          Chucvu: document.getElementById('Chucvu').value,
          Hocvi: document.getElementById('Hocvi').value
      };
      fetch('/Baitaplon/api/admin/HSnhansu', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data)
      })
      .then(res => res.json())
      .then(res => {
          alert(res.message || res.error);
          // Sau khi xóa thành công
            if (!data.error) window.location.href = "/Baitaplon/HSnhansu";
      });
  });
  </script>
</body>
</html>