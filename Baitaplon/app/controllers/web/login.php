<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../../core/SqlConnection.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';

    // Kết nối DB
    $db = new SqlConnection();
    $conn = $db->getConnection();

    // Kiểm tra tài khoản admin (ví dụ bảng admins)
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $admin = $stmt->fetch();

    if ($admin) {
        $_SESSION['admin'] = $admin['username'];
        header('Location: /Baitaplon/HSnhansu');
        exit;
    } else {
        $error = 'Sai tài khoản hoặc mật khẩu!';
    }
}
?>
<!DOCTYPE html>--
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/Baitaplon/public/css/Login.css" />
    <title>Đăng Nhập</title>
  </head>
  <body>
      <div class="circle"></div>
      <div class="card">
        <div class="logo">
          <i class="bx bx-bitcoin"></i>
        </div>
        <h2>Đăng nhập Admin</h2>
        <?php if (!empty($error)): ?>
            <div style="color:red; text-align:center;"><?= $error ?></div>
        <?php endif; ?>
        <form class="form" action="" method="post">
          <input type="text" name="name" placeholder="Tên" id="name" required />
          <input
            type="password"
            name="password"
            id="password"
            placeholder="Mật Khẩu"
            required
          />
          <button type="submit">Đăng Nhập</button>
        </form>
        <footer>
        Đăng nhập với quyền người dùng
        <a href="/Baitaplon/loginuser">Tại Đây</a>
      </footer>
      </div>
  </body>
</html>