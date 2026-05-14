<?php include 'admin/partials/header.php'; ?>

<body class="login-page">

    <!-- LOGO -->
    <div class="login-navbar">

        <div class="logo-area">

            <img src="assets/img/logo-trava.png"
            class="logo-img">

        </div>

    </div>

    <!-- BOX -->
    <div class="login-box">

        <div class="login-card">

            <h2>SIGN UP!</h2>

            <p>
                Buat akun dan mulai jelajahi
                wisata terbaik Cirebon
            </p>

            <form action="proses/proses_register.php"
            method="POST">

                <!-- NAMA -->
                <div class="input-box">

                    <input type="text"
                    name="nama"
                    placeholder="Nama Lengkap"
                    required>

                </div>

                <!-- EMAIL -->
                <div class="input-box">

                    <input type="email"
                    name="email"
                    placeholder="Email"
                    required>

                </div>

                <!-- PASSWORD -->
                <div class="input-box">

                    <input type="password"
                    name="password"
                    placeholder="Password"
                    required>

                </div>

                <!-- BUTTON -->
                <button type="submit"
                class="btn-login">

                    Register

                </button>

            </form>

            <!-- LINK -->
            <div class="register-link">

                Sudah punya akun?

                <a href="login.php">
                    Login
                </a>

            </div>

        </div>

    </div>

</body>
</html>