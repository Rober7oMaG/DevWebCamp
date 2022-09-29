<h2 class="page__heading"><?php echo $title; ?></h2>
<p class="page__description">Choose up to five events to attend presentially.</p>

<div class="registration-events">
    <main class="registration-events__list">
        <h3 class="registration-events__heading--conferences">&lt;Conferences /></h3>

        <p class="registration-events__date">Friday, October 5th</p>
        <div class="registration-events__grid">
            <?php foreach ($events['conferences_friday'] as $event) { ?>
                <?php include __DIR__ . '/event.php'; ?>
            <?php } ?>
        </div>

        <p class="registration-events__date">Saturday, October 6th</p>
        <div class="registration-events__grid">
            <?php foreach ($events['conferences_saturday'] as $event) { ?>
                <?php include __DIR__ . '/event.php'; ?>
            <?php } ?>
        </div>

        <h3 class="registration-events__heading--workshops">&lt;Workshops /></h3>

        <p class="registration-events__date">Friday, October 5th</p>
        <div class="registration-events__grid events--workshops">
            <?php foreach ($events['workshops_friday'] as $event) { ?>
                <?php include __DIR__ . '/event.php'; ?>
            <?php } ?>
        </div>

        <p class="registration-events__date">Saturday, October 6th</p>
        <div class="registration-events__grid events--workshops">
            <?php foreach ($events['workshops_saturday'] as $event) { ?>
                <?php include __DIR__ . '/event.php'; ?>
            <?php } ?>
        </div>
    </main>

    <aside class="registration">
        <h2 class="registration__heading">Your Registration</h2>

        <div id="registration-summary" class="registration__summary"></div>

        <div class="registration__gift">
            <label for="gift" class="registration__label">Select a Gift</label>
            <select id="gift" class="registration__select">
                <option value="">>-- Select your Gift --<</option>
                <?php foreach ($gifts as $gift) { ?>
                    <option value="<?php echo $gift->id; ?>"><?php echo $gift->name; ?></option>
                <?php } ?>
            </select>
        </div>

        <form id="registration" action="" class="form">
            <div class="form__field">
                <input type="submit" value="Register" class="form__submit form__submit--full">
            </div>
        </form>
    </aside>
</div>