<header class="text-center m-4">

    <h2>CORPORE SANO</h2>
    <h5>Fitness center for your health</h5>
</header>
<div class="main-image"></div>

<main>
    <div class="serviceContainer d-flex flex-wrap justify-content-center justify-content-around align-items-center">

        <div class="service">
            <div class="service-photo">
                <img src="https://www.verywellfit.com/thmb/acDVI-Q6F7i0fTJLHDKpHt_A6Ko=/2578x2578/smart/filters:no_upscale()/gym-for-health-854060456-5a2ff352494ec90036071828.jpg" alt="">
            </div>
            <div class="text-area">
                <p class="service-title">YOGA</p>
                <p class="service-desc text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis
                    fuga
                    ipsa numquam perferendis tempora velit vero voluptatum? Alias assumenda eum fuga fugit </p>
            </div>
        </div>


        <div class="service">
            <div class="service-photo">
                <img class="" src="https://2rdnmg1qbg403gumla1v9i2h-wpengine.netdna-ssl.com/wp-content/uploads/sites/3/2016/10/womanWeights-946365998-770x533-1-745x490.jpg" alt="">
            </div>
            <div class="text-area">
                <p class="service-title">WEIGHT TRAINING</p>
                <p class="service-desc text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit quasi
                    quia quis quod quos sequi! Amet eaque iste rem rerum. </p>
            </div>

        </div>

        <div class="service">
            <div class="service-photo">
                <img src="https://urstrongfitness.com/wp-content/uploads/2018/08/AdobeStock_197214851-1024x683.jpeg" alt="">
            </div>
            <div class="text-area">
                <p class="service-title">PERSONAL TRAINING</p>
                <p class="service-desc text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus
                    cupiditate laborum minus, nobis perspiciatis quam qui quos </p>
            </div>
        </div>

    </div>

    <div id="map"></div>

    <script>

        function initMap() {

            const location = {lat: 54.723534, lng: 25.337852};
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }
    </script>

    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAY7tHiIJw8P73aYiAk2cFKRPrGMvgMIFc&callback=initMap&libraries=&v=weekly"
            async
    ></script>


</main>



