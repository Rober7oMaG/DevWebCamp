<main class="auth">
    <h2 class="auth__heading"><?php echo $title ?></h2>
    <p class="auth__text">Recover your Access to DevWebCamp</p>

    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>

    <form method="POST" action="/forgot" class="form">
        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input
                type="email"
                class="form__input"
                placeholder="Your email"
                id="email"
                name="email"
            >
        </div>

        <input type="submit" class="form__submit" value="Send Instructions">
    </form>

    <div class="actions">
        <a href="/login" class="actions__link">Already have an account? Log in</a>
        <a href="/register" class="actions__link">Don't have an account? Create one</a>
    </div>
</main>