
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        crossorigin="anonymous" 
    />
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        crossorigin="anonymous" 
    ></script>
    <title>Sửa lịch sử công tác</title>
    <style>
        html, body { width: 100vw; height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .coat { display: flex; align-items: center; justify-content: center; width: 100vw; height: 100vh; background-color: #e8e8e8; }
        .container-fluid { width: 800px; height: 95%; padding: 30px; background-color: white; box-shadow: 0px 0px 10px rgba(128, 128, 128, 0.508); }
        .desc { text-align: center; width: 100%; font-size: 2rem; font-weight: 600; }
    </style>
</head>
<body>
    <a 
        href="http://localhost/baitaplon/Lichsucongtac" 
        class="btn btn-danger"
        style="
            position: absolute;
            border: none;
            background-color: transparent;
            color: black;
        "
    >
        Quay lại
    </a>
    <?php if (isset($row) && is_array($row)): ?>
    <form id="form-sua-lichsu" autocomplete="off">
        <div class="coat">
            <div class="container-fluid">
                <div class="desc">Form sửa lịch sử công tác</div>
                <div class="form-group mt-3">
                    <label for="Manv">Mã nhân viên</label>
                    <input
                        type="text"
                        name="Manv"
                        id="Manv"
                        class="form-control"
                        value="<?= htmlspecialchars($row['Manv']) ?>"
                        readonly
                    />
                </div>
                <div class="form-group mt-3">
                    <label for="Noilamviec">Nơi làm việc trước đây</label>
                    <input
                        type="text"
                        name="Noilamviec"
                        id="Noilamviec"
                        class="form-control"
                        value="<?= htmlspecialchars($row['Noilamviec']) ?>"
                        required
                    />
                </div>
                <div class="form-group mt-3">
                    <label for="Vitricongtac">Vị trí công tác</label>
                    <input
                        type="text"
                        name="Vitricongtac"
                        id="Vitricongtac"
                        class="form-control"
                        value="<?= htmlspecialchars($row['Vitricongtac']) ?>"
                        required
                    />
                </div>
                <div class="form-group mt-3">
                    <label for="Ngaybatdaulam">Ngày bắt đầu làm</label>
                    <input
                        type="date"
                        name="Ngaybatdaulam"
                        id="Ngaybatdaulam"
                        class="form-control"
                        value="<?= htmlspecialchars($row['Ngaybatdaulam']) ?>"
                        required
                    />
                </div>
                <div class="form-group mt-3">
                    <label for="Ngayketthuclam">Ngày kết thúc làm</label>
                    <input
                        type="date"
                        name="Ngayketthuclam"
                        id="Ngayketthuclam"
                        class="form-control"
                        value="<?= htmlspecialchars($row['Ngayketthuclam']) ?>"
                        required
                    />
                </div>
                <div class="form-group mt-3">
                    <label for="Hopdonglaodong">Hợp đồng lao động</label>
                    <input
                        type="text"
                        name="Hopdonglaodong"
                        id="Hopdonglaodong"
                        class="form-control"
                        value="<?= htmlspecialchars($row['Hopdonglaodong']) ?>"
                        required
                    />
                </div>
                <div class="form-group mt-3">
                    <label for="Hocvi">Học vị</label>
                    <input
                        type="text"
                        name="Hocvi"
                        id="Hocvi"
                        class="form-control"
                        value="<?= htmlspecialchars($row['Hocvi']) ?>"
                        required
                    />
                </div>
                <div class="mt-5 d-flex align-items-center">
                    <button
                        type="submit"
                        id="btnSua"
                        class="btn btn-success mx-auto"
                        style="width: 100vw"
                    >
                        Xác nhận sửa
                    </button>
                </div>
            </div>
        </div>
    </form>
    <script>
    document.getElementById('form-sua-lichsu').addEventListener('submit', function(e) {
        e.preventDefault();
        const manv = document.getElementById('Manv').value;
        const data = {
            Noilamviec: document.getElementById('Noilamviec').value,
            Vitricongtac: document.getElementById('Vitricongtac').value,
            Ngaybatdaulam: document.getElementById('Ngaybatdaulam').value,
            Ngayketthuclam: document.getElementById('Ngayketthuclam').value,
            Hopdonglaodong: document.getElementById('Hopdonglaodong').value,
            Hocvi: document.getElementById('Hocvi').value
        };
        fetch('/baitaplon/api/admin/Lichsucongtac/' + manv, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(res => {
            alert(res.message || res.error);
            if (!res.error) window.location.href = "http://localhost/baitaplon/Lichsucongtac";
        });
    });
    </script>
    <?php endif; ?>
</body>
</html>