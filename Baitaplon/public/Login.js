function check() {
    let tdn = document.getElementById("name").value;
    let mk = document.getElementById("password").value;
    if (tdn == "ltc" && mk == "ltc") {
        alert("Đăng nhập thành công");
        window.location.href = "Home";
    } else {
        alert("Tài khoản hoặc mật khẩu không chính xác");
    }
}
