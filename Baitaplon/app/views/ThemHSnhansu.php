
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
        <title>Thêm nhân viên</title>
    </head>
    <body>
    <a 
        href="<?=_WEB_HOST?>/HSnhansu" 
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
    <form id="form-them-nv" autocomplete="off">
        <div
            class="coat"
            style="
                display: flex;
                align-items: center;
                width: 100vw;
                height: 100vh;
                padding: 0 400px;
                background-color: #e8e8e8;
            "
        >
            <div
                class="container-fluid"
                style="
                        height: 97%;
                        padding: 30px;
                        background-color: white;
                        box-shadow: 0px 0px 10px rgba(128, 128, 128, 0.508);
                    "
            >
                <div
                    class="desc"
                    style="
                        text-align: center;
                        width: 100%;
                        font-size: 2rem;
                        font-weight: 600;
                    "
                >
                    Form thêm
                </div>
                <div class="form-group mt-3">
                    <label for="Manv"> Mã nhân viên</label>
                    <input
                        type="text"
                        name="Manv"
                        id="Manv"
                        class="form-control"
                        placeholder="Nhập mã nhân viên"
                        required
                    />
                </div>
                <div class="form-group mt-3">
                    <label for="Tennv">Tên nhân viên</label>
                    <input
                        type="text"
                        name="Tennv"
                        id="Tennv"
                        class="form-control"
                        placeholder="Nhập tên nhân viên"
                        required
                    />
                </div>
                <div class="form-group mt-3">
                    <label for="Sodt">Điện thoại</label>
                    <input
                        type="text"
                        name="Sodt"
                        id="Sodt"
                        class="form-control"
                        placeholder="Nhập số điện thoại"
                        required
                    />
                </div>
                <div class="form-group mt-3">
                    <label for="Email">Email</label>
                    <input
                        type="email"
                        name="Email"
                        id="Email"
                        class="form-control"
                        placeholder="Nhập Email"
                        required
                    />
                </div>
                <div class="form-group mt-3">
                    <label for="Diachi">Địa chỉ</label>
                    <input
                        type="text"
                        name="Diachi"
                        id="Diachi"
                        class="form-control"
                        placeholder="Nhập địa chỉ"
                        required
                    />
                </div>
                <div class="form-group mt-3">
                    <label for="Chucvu">Chức vụ</label>
                    <input
                        type="text"
                        name="Chucvu"
                        id="Chucvu"
                        class="form-control"
                        placeholder="Nhập chức vụ"
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
                        placeholder="Nhập học vị"
                        required
                    />       
                </div>
                <div class="mt-5 d-flex align-items-center">
                    <button
                        type="submit"
                        id="btnThem"
                        class="btn btn-success mx-auto"
                        style="width: 100vw"
                    >
                        Xác nhận thêm
                    </button>
                </div>
            </div>
        </div>
    </form>
    <script>
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
         // Sau khi thêm/sửa thành công
if (!res.error) window.location.href = "/Baitaplon/HSnhansu";
        });
    });
    </script>
    </body>
</html>