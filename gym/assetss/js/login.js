function loginform() {
    var username = document.forms["login"]["username"].values;
    var password = document.forms["login"]["passowrd"].values;

    if (username === "example@example.com" && password === "password") {
        // Đăng nhập thành công, hiển thị thông báo
        alert("Đăng nhập thành công!");
      } else {
        // Hiển thị thông báo lỗi
        alert("Email hoặc mật khẩu không chính xác!");
      }

      // Ngăn chặn form được gửi đi
      return false;

}