<main class="auth">
    <h2 class="auth__heading"><?php echo $title ?></h2>

    <?php
        require_once __DIR__ . '/../templates/alerts.php';
    ?>

    <?php if (isset($alerts['success'])) { ?>
        <div class="actions actions--center">
            <a href="/login" class="actions__link">Log In</a>
        </div>
    <?php } ?>
</main>