<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__button-container ">
    <a href="/admin/events" class="dashboard__button">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Go Back
    </a>
</div>

<div class="dashboard__form">
    <?php
        include_once __DIR__ . './../../templates/alerts.php';
    ?>

    <form method="POST" action="/admin/events/create" class="form">
        <?php include_once __DIR__ . '/form.php'; ?>

        <input type="submit" value="Register Event" class="form__submit form__submit--register">
    </form>
</div>