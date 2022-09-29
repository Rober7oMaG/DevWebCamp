<?php
    include_once __DIR__ . '/events.php';
?>

<section class="summary">
    <div class="summary__grid">
        <div data-aos="fade-up" class="summary__block">
            <p class="summary__text summary__text--number"><?php echo $speakers_count; ?></p>
            <p class="summary__text">Speakers</p>
        </div>
        <div data-aos="fade-down" class="summary__block">
            <p class="summary__text summary__text--number"><?php echo $conferences_count; ?></p>
            <p class="summary__text">Conferences</p>
        </div>
        <div data-aos="fade-right" class="summary__block">
            <p class="summary__text summary__text--number"><?php echo $workshops_count; ?></p>
            <p class="summary__text">Workshops</p>
        </div>
        <div data-aos="fade-left" class="summary__block">
            <p class="summary__text summary__text--number"><?php echo $registered_count; ?></p>
            <p class="summary__text">Assistants</p>
        </div>
    </div>
</section>

<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__description">Know our DevWebCamp experts</p>

    <div class="speakers__grid">
        <?php foreach ($speakers as $speaker) { ?>
            <div class="speaker">
                <picture>
                    <source srcset="img/speakers/<?php echo $speaker->image; ?>.webp" type="image/webp">
                    <source srcset="img/speakers/<?php echo $speaker->image; ?>.png" type="image/png">
                    <img loading="lazy" class="speaker__image" src="img/speakers/<?php echo $speaker->image; ?>.png" width="200" height="300" alt="Speaker Image">
                </picture>
    
                <div class="speaker__info">
                    <h4 class="speaker__name"><?php echo $speaker->name . " " . $speaker->last_name; ?></h4>
                    <p class="speaker__location"><?php echo $speaker->city . ", " . $speaker->country; ?></p>
    
                    <nav class="speaker-social">
                        <?php
                            $social = json_decode($speaker->social);
                        ?>
                        <?php if (!empty($social->facebook)) { ?>
                            <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $social->facebook; ?>">
                                <span class="speaker-social__hide">Facebook</span>
                            </a> 
                        <?php } ?>
    
                        <?php if (!empty($social->twitter)) { ?>
                            <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $social->twitter; ?>">
                                <span class="speaker-social__hide">Twitter</span>
                            </a> 
                        <?php } ?>
    
                        <?php if (!empty($social->youtube)) { ?>
                            <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $social->youtube; ?>">
                                <span class="speaker-social__hide">YouTube</span>
                            </a> 
                        <?php } ?>
    
                        <?php if (!empty($social->instagram)) { ?>
                            <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $social->instagram; ?>">
                                <span class="speaker-social__hide">Instagram</span>
                            </a> 
                        <?php } ?>
    
                        <?php if (!empty($social->tiktok)) { ?>
                            <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $social->tiktok; ?>">
                                <span class="speaker-social__hide">Tiktok</span>
                            </a> 
                        <?php } ?>
    
                        <?php if (!empty($social->github)) { ?>
                            <a class="speaker-social__link" rel="noopener noreferrer" target="_blank" href="<?php echo $social->github; ?>">
                                <span class="speaker-social__hide">Github</span>
                            </a>
                        <?php } ?>
                    </nav>
    
                    <ul class="speaker__skills-list">
                        <?php 
                            $tags = explode(',', $speaker->tags);
                            foreach ($tags as $tag) {
                        ?>
                            <li class="speaker__skill"><?php echo $tag; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<div id="map" class="map"></div>

<div class="tickets">
    <h2 class="tickets__heading">Tickets and Prices</h2>
    <p class="tickets__description">Prices for DevWebCamp</p>

    <div class="tickets__grid">
        <div class="ticket ticket--on-site">
            <h4 class="ticket__logo">&#60;DevWebCamp /></h4>
            <p class="ticket__plan">On-Site</p>
            <p class="ticket__price">$199</p>
        </div>
        <div class="ticket ticket--virtual">
            <h4 class="ticket__logo">&#60;DevWebCamp /></h4>
            <p class="ticket__plan">Virtual</p>
            <p class="ticket__price">$49</p>
        </div>
        <div class="ticket ticket--free">
            <h4 class="ticket__logo">&#60;DevWebCamp /></h4>
            <p class="ticket__plan">Free</p>
            <p class="ticket__price">$0</p>
        </div>
    </div>

    <div class="ticket__link-container">
        <a href="/bundles" class="ticket__link">See Bundles</a>
    </div>
</div>