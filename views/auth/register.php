<main class="auth">
    <h2 class="auth__heading"><?php echo $title ?></h2>
    <p class="auth__text">Create your DevWebCamp Account</p>

    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>

    <form method="POST" action="/register" class="form">
        <div class="form__field">
            <label for="name" class="form__label">Name</label>
            <input
                type="text"
                class="form__input"
                placeholder="Your name"
                id="name"
                name="name"
                value="<?php echo $user->name; ?>"
            >
        </div>

        <div class="form__field">
            <label for="last_name" class="form__label">Last Name</label>
            <input
                type="text"
                class="form__input"
                placeholder="Your last name"
                id="last_name"
                name="last_name"
                value="<?php echo $user->last_name; ?>"
            >
        </div>

        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input
                type="email"
                class="form__input"
                placeholder="Your email"
                id="email"
                name="email"
                value="<?php echo $user->email; ?>"
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

        <div class="form__field">
            <label for="password2" class="form__label">Password Confirmation</label>
            <input
                type="password"
                class="form__input"
                placeholder="Repeat your password"
                id="password2"
                name="password2"
            >
        </div>

        <input type="submit" class="form__submit" value="Create Account">
    </form>

    <div class="actions">
        <a href="/login" class="actions__link">Already have an account? Log in</a>
        <a href="/forgot" class="actions__link">Forgot your password?</a>
    </div>
</main>