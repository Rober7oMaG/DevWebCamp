<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<main class="blocks">
    <div class="blocks__grid">
        <div class="block">
            <h3 class="block__heading">Latest Registrations</h3>

            <?php foreach ($registrations as $registration) { ?>
                <div class="block__content">
                    <p class="block__text"><?php echo $registration->user->name . " " . $registration->user->last_name; ?></p>
                </div>
            <?php } ?>
        </div>

        <div class="block">
            <h3 class="block__heading">Income</h3>
            <p class="block__text--amount">$<?php echo $income; ?></p>
        </div>

        <div class="block">
            <h3 class="block__heading">Events with Lower Availability</h3>
            <?php foreach ($least_available as $event) { ?>
                <p class="block__text"><?php echo $event->name . " (" . $event->available . " available)"; ?></p>
            <?php } ?>
        </div>

        <div class="block">
            <h3 class="block__heading">Events with Higher Availability</h3>
            <?php foreach ($most_available as $event) { ?>
                <p class="block__text"><?php echo $event->name . " (" . $event->available . " available)"; ?></p>
            <?php } ?>
        </div>
    </div>
</main>