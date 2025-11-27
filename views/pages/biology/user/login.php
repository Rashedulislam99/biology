


<?php

?>

<style>
/* Full height & centered login card */
body, html {
    height: 100%;
    margin: 0;
    background-color: #f5f5f5;
}

.login-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    padding: 15px;
}

.login-card {
    width: 100%;
    max-width: 400px;
    padding: 2rem;
    border-radius: 10px;
    background-color: #ffffff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.login-card h3 {
    color: #333;
}

.login-card .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    font-weight: 500;
}

.alert {
    font-size: 0.9rem;
    margin-bottom: 1rem;
}
</style>

<div class="login-wrapper">
    <div class="login-card">
        <h3 class="text-center mb-4">Login</h3>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="<?= $base_url ?>/user/loginsubmit" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>


