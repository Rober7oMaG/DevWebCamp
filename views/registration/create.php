<main class="register">
    <h2 class="register__heading"><?php echo $title; ?></h2>
    <p class="register__description">Choose your Plan</p>

    <main class="bundles">
        <div class="bundles__grid">
            <div class="bundle">
                <h3 class="bundle__name">Free Pass</h3>
                <ul class="bundle__list">
                    <li class="bundle__element">Virtual Access to DevWebCamp</li>
                </ul>

                <p class="bundle__price">$0</p>

                <form method="POST" action="/finish-registration/free">
                    <input type="submit" class="bundles__submit" value="Free Inscription">
                </form>
            </div>

            <div class="bundle">
                <h3 class="bundle__name">On-Site Pass</h3>
                <ul class="bundle__list">
                    <li class="bundle__element">On-Site Access to DevWebCamp</li>
                    <li class="bundle__element">Two-day Pass</li>
                    <li class="bundle__element">Access to Conferences and Workshops</li>
                    <li class="bundle__element">Access to Recordings</li>
                    <li class="bundle__element">Event Themed T-shirt</li>
                    <li class="bundle__element">Food and Drink</li>
                </ul>

                <p class="bundle__price">$199</p>

                <div id="smart-button-container">
                    <div style="text-align: center;">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>

            <div class="bundle">
                <h3 class="bundle__name">Virtual Pass</h3>
                <ul class="bundle__list">
                    <li class="bundle__element">On-Site Access to DevWebCamp</li>
                    <li class="bundle__element">Two-day Pass</li>
                    <li class="bundle__element">Access to Conferences and Workshops</li>
                    <li class="bundle__element">Access to Recordings</li>
                </ul>

                <p class="bundle__price">$49</p>

                <div id="smart-button-container">
                    <div style="text-align: center;">
                        <div id="paypal-button-container-virtual"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</main>

    <script src="https://www.paypal.com/sdk/js?client-id=AVNU94FiEXtTTjv3p773BMZWL55O-oFTvb-tiYC79LogbItaWzL8WGAiee-ntUSnQgUfdFyjkc8I1AP8&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
    <script>
        function initPayPalButton() {
            paypal.Buttons({
                style: {
                    shape: 'rect',
                    color: 'blue',
                    layout: 'vertical',
                    label: 'pay',
                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{"description":"1","amount":{"currency_code":"USD","value":199}}]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {
                        const data = new FormData();
                        data.append('bundle_id', orderData.purchase_units[0].description);
                        data.append('payment_id', orderData.purchase_units[0].payments.captures[0].id);

                        fetch('/finish-registration/pay', {
                            method: 'POST',
                            body: data
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.result) {
                                actions.redirect('http://localhost:3000/finish-registration/conferences');
                            }
                        });
                    });
                },

                onError: function(err) {
                    console.log(err);
                }
            }).render('#paypal-button-container');

            paypal.Buttons({
                style: {
                    shape: 'rect',
                    color: 'blue',
                    layout: 'vertical',
                    label: 'pay',
                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{"description":"2","amount":{"currency_code":"USD","value":49}}]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {
                        const data = new FormData();
                        data.append('bundle_id', orderData.purchase_units[0].description);
                        data.append('payment_id', orderData.purchase_units[0].payments.captures[0].id);

                        fetch('/finish-registration/pay', {
                            method: 'POST',
                            body: data
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.result) {
                                actions.redirect('http://localhost:3000/finish-registration/conferences');
                            }
                        });
                    });
                },

                onError: function(err) {
                    console.log(err);
                }
            }).render('#paypal-button-container-virtual');
        }

        initPayPalButton();
  </script>