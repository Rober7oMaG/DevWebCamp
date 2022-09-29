<main class="auth">
    <h2 class="auth__heading"><?php echo $title ?></h2>
    <p class="auth__text">Enter and Confirm your New Password</p>

    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>

    <?php if (!$error) { ?>
        <form method="POST" class="form">
            <div class="form__field">
                <label for="password" class="form__label">New Password</label>
                <input
                    type="password"
                    class="form__input"
                    placeholder="Your new password"
                    id="password"
                    name="password"
                >
            </div>

            <div class="form__field">
                <label for="password2" class="form__label">New Password Confirmation</label>
                <input
                    type="password"
                    class="form__input"
                    placeholder="Repeat your new password"
                    id="password2"
                    name="password2"
                >
            </div>

            <input type="submit" class="form__submit" value="Save Password">
        </form>

        <div class="actions">
            <a href="/login" class="actions__link">Already have an account? Log in</a>
            <a href="/register" class="actions__link">Don't have an account? Create one</a>
        </div>
    <?php } ?>
</main>