<fieldset class="form__fieldset">
    <legend class="form__legend">Personal Information</legend>

    <div class="form__field">
        <label for="name" class="form__label">Name</label>
        <input 
            type="text"
            class="form__input"
            id="name"
            name="name"
            placeholder="Speaker's name"
            value="<?php echo $speaker->name ?? ''; ?>"
        >
    </div>

    <div class="form__field">
        <label for="last_name" class="form__label">Last Name</label>
        <input 
            type="text"
            class="form__input"
            id="last_name"
            name="last_name"
            placeholder="Speaker's last name"
            value="<?php echo $speaker->last_name ?? ''; ?>"
        >
    </div>

    <div class="form__field">
        <label for="city" class="form__label">City</label>
        <input 
            type="text"
            class="form__input"
            id="city"
            name="city"
            placeholder="Speaker's city"
            value="<?php echo $speaker->city ?? ''; ?>"
        >
    </div>

    <div class="form__field">
        <label for="country" class="form__label">Country</label>
        <input 
            type="text"
            class="form__input"
            id="country"
            name="country"
            placeholder="Speaker's country"
            value="<?php echo $speaker->country ?? ''; ?>"
        >
    </div>

    <div class="form__field">
        <label for="image" class="form__label">Image</label>
        <input 
            type="file"
            class="form__input form__input--file"
            id="image"
            name="image"
        >
    </div>

    <?php if (isset($speaker->current_image)) { ?>
        <p class="form__text">Current Image</p>
        <div class="form__image">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image; ?>.png" alt="Speaker Image">
            </picture>

        </div>
    <?php } ?>
</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Extra Information</legend>

    <div class="form__field">
        <label for="tags_input" class="form__label">Experience Areas (separated by comma)</label>
        <input 
            type="text"
            class="form__input"
            id="tags_input"
            placeholder="Example: Node.js, PHP, Laravel, React, UI/UX"
        >

        <div id="tags" class="form__list"></div>
        <input 
            type="hidden" 
            name="tags"
            value="<?php echo $speaker->tags ?? ''; ?>"
        >
    </div>

</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Social Media</legend>

    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-facebook"></i>
            </div>

            <input 
                type="text"
                class="form__input form__input--social"
                name="social[facebook]"
                placeholder="Facebook"
                value="<?php echo $social->facebook ?? ''; ?>"
            >
        </div>
    </div>

    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-twitter"></i>
            </div>

            <input 
                type="text"
                class="form__input form__input--social"
                name="social[twitter]"
                placeholder="Twitter"
                value="<?php echo $social->twitter ?? ''; ?>"
            >
        </div>
    </div>

    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-instagram"></i>
            </div>

            <input 
                type="text"
                class="form__input form__input--social"
                name="social[instagram]"
                placeholder="Instagram"
                value="<?php echo $social->instagram ?? ''; ?>"
            >
        </div>
    </div>

    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-youtube"></i>
            </div>

            <input 
                type="text"
                class="form__input form__input--social"
                name="social[youtube]"
                placeholder="Youtube"
                value="<?php echo $social->youtube ?? ''; ?>"
            >
        </div>
    </div>

    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-tiktok"></i>
            </div>

            <input 
                type="text"
                class="form__input form__input--social"
                name="social[tiktok]"
                placeholder="TikTok"
                value="<?php echo $social->tiktok ?? ''; ?>"
            >
        </div>
    </div>

    <div class="form__field">
        <div class="form__icon-container">
            <div class="form__icon">
                <i class="fa-brands fa-github"></i>
            </div>

            <input 
                type="text"
                class="form__input form__input--social"
                name="social[github]"
                placeholder="GitHub"
                value="<?php echo $social->github ?? ''; ?>"
            >
        </div>
    </div>  
</fieldset>