<div class="event">
    <p class="event__hour"><?php echo $event->hour->hour; ?></p>

    <div class="event__info">
        <h4 class="event__name"><?php echo $event->name; ?></h4>

        <p class="event__introduction"><?php echo $event->description; ?></p>

        <div class="event__speaker-info">
            <picture>
                <source srcset="<?php echo $_ENV['HOST']; ?>/img/speakers/<?php echo $event->speaker->image; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST']; ?>/img/speakers/<?php echo $event->speaker->image; ?>.png" type="image/png">
                <img loading="lazy" class="event__speaker-image" src="<?php echo $_ENV['HOST']; ?>/img/speakers/<?php echo $event->speaker->image; ?>.png" width="200" height="300" alt="Speaker Image">
            </picture>

            <p class="event__speaker-name">
                <?php echo $event->speaker->name . " " . $event->speaker->last_name; ?>
            </p>
        </div>

        <button
            type="button"
            data-id="<?php echo $event->id; ?>"
            class="event__add"
            <?php echo ($event->available === '0') ? 'disabled' : ''; ?>
        >
            <?php echo ($event->available === '0') ? 'Unavailable' : 'Add (' . $event->available . ' available)'; ?>
        </button>
    </div>
</div>