<?php include 'admin/partials/header.php'; ?>

<div class="login-page">

    <!-- NAVBAR -->
    <div class="login-navbar">

        <!-- LOGO -->
        <div class="logo-area">

            <img src="/TRAVA/assets/img/logo-trava.png"
            class="logo-img">

        </div>

    </div>

    <!-- LOGIN BOX -->
    <div class="login-box">

        <div class="login-card">

            <h2>WELCOME!</h2>

            <p>
                Login untuk melanjutkan perjalananmu
            </p>

            <form action=""
            method="POST">

                <!-- EMAIL -->
                <div class="input-box">

                    <input type="email"
                    placeholder="Email"
                    required>

                </div>

                <!-- PASSWORD -->
                <div class="input-box">

                    <input type="password"
                    placeholder="Password"
                    required>

                </div>

                <!-- BUTTON -->
                <button type="submit"
                class="btn-login">

                    Login

                </button>

            </form>

            <!-- REGISTER -->
            <div class="register-link">

                Belum punya akun?

                <a href="register.php">
                    Daftar
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>