
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" crossorigin="anonymous"/>
  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    crossorigin="anonymous"></script>
  <title>Thêm lịch sử công tác</title>
  <style>
    html, body { width: 100vw; height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .coat { display: flex; align-items: center; justify-content: center; width: 100vw; height: 100vh; background-color: #e8e8e8; }
    .container-fluid { width: 800px; padding: 30px; background-color: white; box-shadow: 0px 0px 10px rgba(128,128,128,0.2);}
    .desc { text-align: center; width: 100%; font-size: 2rem; font-weight: 600; }
  </style>
</head>
<body>
  <a href="<?=_WEB_HOST?>/Lichsucongtac" class="btn btn-danger" style="position: absolute; top: 20px; left: 20px;">
    Quay lại
  </a>
  <div class="coat">
    <div class="container-fluid">
      <div class="desc">Form Thêm Lịch Sử Công Tác</div>
      <form id="form-them-lichsu" autocomplete="off">
        <div class="form-group mt-3">
          <label for="Manv">Mã nhân viên</label>
          <select name="Manv" id="Manv" class="form-control" required>
            <option value="">Chọn mã nhân viên</option>
            <?php foreach ($nhanvien as $nv): ?>
            <option value="<?= $nv['Manv'] ?>" data-hocvi="<?= htmlspecialchars($nv['Hocvi']) ?>">
              <?= $nv['Manv'] ?>
            </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group mt-3">
          <label for="Noilamviec">Nơi làm việc</label>
          <input type="text" name="Noilamviec" id="Noilamviec" class="form-control" placeholder="Nhập nơi làm việc" required />
        </div>
        <div class="form-group mt-3">
          <label for="Vitricongtac">Vị trí công tác</label>
          <input type="text" name="Vitricongtac" id="Vitricongtac" class="form-control" placeholder="Nhập vị trí công tác" required />
        </div>
        <div class="form-group mt-3">
          <label for="Ngaybatdaulam">Ngày bắt đầu làm</label>
          <input type="date" name="Ngaybatdaulam" id="Ngaybatdaulam" class="form-control" required />
        </div>
        <div class="form-group mt-3">
          <label for="Ngayketthuclam">Ngày kết thúc làm</label>
          <input type="date" name="Ngayketthuclam" id="Ngayketthuclam" class="form-control" required />
        </div>
        <div class="form-group mt-3">
          <label for="Hopdonglaodong">Hợp đồng lao động</label>
          <input type="text" name="Hopdonglaodong" id="Hopdonglaodong" class="form-control" placeholder="Nhập hợp đồng lao động" required />
        </div>
        <div class="form-group mt-3">
          <label for="Hocvi">Học vị</label>
          <input type="text" name="Hocvi" id="Hocvi" class="form-control" placeholder="Học vị sẽ tự động điền" readonly required />
        </div>
        <div class="mt-5 d-flex align-items-center">
          <button type="submit" id="btnThem" class="btn btn-success mx-auto">
            Xác nhận Thêm
          </button>
        </div>
      </form>
    </div>
  </div>
  <script>
    // Tự động điền học vị theo mã nhân viên
    document.getElementById('Manv').addEventListener('change', function() {
      var hocvi = this.options[this.selectedIndex].getAttribute('data-hocvi') || '';
      document.getElementById('Hocvi').value = hocvi;
    });

    // Gửi dữ liệu qua API
    document.getElementById('form-them-lichsu').addEventListener('submit', function(e) {
      e.preventDefault();
      const data = {
        Manv: document.getElementById('Manv').value,
        Noilamviec: document.getElementById('Noilamviec').value,
        Vitricongtac: document.getElementById('Vitricongtac').value,
        Ngaybatdaulam: document.getElementById('Ngaybatdaulam').value,
        Ngayketthuclam: document.getElementById('Ngayketthuclam').value,
        Hopdonglaodong: document.getElementById('Hopdonglaodong').value,
        Hocvi: document.getElementById('Hocvi').value
      };
      fetch('/Baitaplon/api/admin/Lichsucongtac', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      })
      .then(res => res.json())
      .then(res => {
        alert(res.message || res.error);
        if (!res.error) window.location.href = "<?= _WEB_HOST ?>/Lichsucongtac";
      });
    });
  </script>
</body>
</html>