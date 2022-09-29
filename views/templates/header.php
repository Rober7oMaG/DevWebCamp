<header class="header">
    <div class="header__container">
        <nav class="header__navigation">
            <?php if (is_auth()) { ?>
                <a href="<?php echo is_admin() ? '/admin/dashboard' : '/finish-registration'; ?>" class="header__link">Manage</a>
                <form method="POST" action="/logout" class="header__form">
                    <input type="submit" value="Logout" class="header__submit">
                </form>
            <?php } else { ?>
                <a href="/register" class="header__link">Register</a>
                <a href="/login" class="header__link">Log In</a>
            <?php } ?>
        </nav>

        <div class="header__content">
            <a href="/">
                <h1 class="header__logo">
                    &#60;DevWebCamp />
                </h1>
            </a>

            <p class="header__text">October 5-6, 2023</p>
            <p class="header__text header__text--modality">Online - On-site</p>

            <a href="/register" class="header__button">Get Pass</a>
        </div>
    </div>
</header>

<div class="bar">
    <div class="bar__content">
        <a href="/">
            <h2 class="bar__logo">
                &#60;DevWebCamp />
            </h2>
        </a>

        <nav class="navigation">
            <a href="/about" class="navigation__link <?php echo current_page('/about') ? 'navigation__link--current' : ''; ?>">About</a>
            <a href="/bundles" class="navigation__link <?php echo current_page('/bundles') ? 'navigation__link--current' : ''; ?>">Bundles</a>
            <a href="/events" class="navigation__link <?php echo current_page('/events') ? 'navigation__link--current' : ''; ?>">Conferences & Workshops</a>
            <a href="/register" class="navigation__link <?php echo current_page('/register') ? 'navigation__link--current' : ''; ?>">Get Pass</a>
        </nav>
    </div>
</div>