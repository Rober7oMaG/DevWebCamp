<main class="page">
    <h2 class="page__heading"><?php echo $title; ?></h2>
    <p class="page__description">Your Ticket - We recommend you to save it, you can share it on your social media.</p>

    <div class="virtual-ticket">
        <div class="ticket ticket--<?php echo strtolower($registration->bundle->name); ?> ticket--access">
            <div class="ticket_content">
                <h4 class="ticket__logo">&#60;DevWebCamp /></h4>
                <p class="ticket__plan"><?php echo $registration->bundle->name; ?></p>
                <p class="ticket__name"><?php echo $registration->user->name . " " . $registration->user->last_name; ?></p>
            </div>

            <p class="ticket__code"><?php echo '#' . $registration->token; ?></p>
        </div>
    </div>
</main>