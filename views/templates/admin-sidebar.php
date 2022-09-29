<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__link <?php echo current_page('/dashboard') ? 'dashboard__link--active' : '' ?>">
            <i class="fa-solid fa-house dashboard__icon"></i>
            <span class="dashboard__menu-text">
                Home
            </span>
        </a>

        <a href="/admin/speakers" class="dashboard__link <?php echo current_page('/speakers') ? 'dashboard__link--active' : '' ?>">
            <i class="fa-solid fa-microphone dashboard__icon"></i>
            <span class="dashboard__menu-text">
                Speakers
            </span>
        </a>

        <a href="/admin/events" class="dashboard__link <?php echo current_page('/events') ? 'dashboard__link--active' : '' ?>">
            <i class="fa-solid fa-calendar dashboard__icon"></i>
            <span class="dashboard__menu-text">
                Events
            </span>
        </a>

        <a href="/admin/registered" class="dashboard__link <?php echo current_page('/registered') ? 'dashboard__link--active' : '' ?>">
            <i class="fa-solid fa-users dashboard__icon"></i>
            <span class="dashboard__menu-text">
                Registered
            </span>
        </a>

        <a href="/admin/gifts" class="dashboard__link <?php echo current_page('/gifts') ? 'dashboard__link--active' : '' ?>">
            <i class="fa-solid fa-gift dashboard__icon"></i>
            <span class="dashboard__menu-text">
                Gifts
            </span>
        </a>
    </nav>
</aside>