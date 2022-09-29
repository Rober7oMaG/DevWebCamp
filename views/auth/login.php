<main class="auth">
    <h2 class="auth__heading"><?php echo $title ?></h2>
    <p class="auth__text">Log In to DevWebCamp</p>

    <?php
        require_once __DIR__ . './../templates/alerts.php';
    ?>

    <form method="POST" action="/login" class="form">
        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input
                type="email"
                class="form__input"
                placeholder="Your email"
                id="email"
                name="email"
                value="<?php echo($user->email); ?>"
            >
        </div>

        <div class="form__field">
            <label for="password" class="form__label">Password</label>
            <input
                type="password"
                class="form__input"
                placeholder="Your password"
                id="password"
                name="password"
            >
        </div>

        <input type="submit" class="form__submit" value="Log In">
    </form>

    <div class="actions">
        <a href="/register" class="actions__link">Don't have an account? Create one</a>
        <a href="/forgot" class="actions__link">Forgot your password?</a>
    </div>
</main>