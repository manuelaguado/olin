        <section class="page-top">
            <div class="container">
                <div class="col-md-4 col-sm-4">
                    <h1>Contact Us</h1>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="pull-right breadcrumb">
                        <li>
                            <a href="javascript:;" data-file="index" data-folder="index" class="load-content">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                Pages
                            </a>
                        </li>
                        <li class="active">
                            Contact Us
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="wrapper no-padding">
            <div id="map"></div>
        </section>
        <section class="wrapper padding50">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div id="contactSuccess" class="alert alert-success hidden">
                            <strong>Success!</strong> Your message has been sent to us.
                        </div>
                        <div id="contactError" class="alert alert-error hidden">
                            <strong>Error!</strong> There was an error sending your message.
                        </div>
                        <h2>Contact Us</h2>
                        <form type="post" id="contactForm" action="" novalidate="novalidate">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label>
                                            Your name <span class="symbol required"></span>
                                        </label>
                                        <input type="text" id="name" name="name" class="form-control" maxlength="100" data-msg-required="Please enter your name." value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            Your email address <span class="symbol required"></span>
                                        </label>
                                        <input type="email" id="email" name="email" class="form-control" maxlength="100" data-msg-email="Please enter a valid email address." data-msg-required="Please enter your email address." value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>
                                            Subject
                                        </label>
                                        <input type="text" id="subject" name="subject" class="form-control" maxlength="100" data-msg-required="Please enter the subject." value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>
                                            Message <span class="symbol required"></span>
                                        </label>
                                        <textarea id="message" name="message" class="form-control" rows="10" data-msg-required="Please enter your message." maxlength="5000"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" data-loading-text="Loading..." class="btn btn-main-color" value="Send Message">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h4>Get in touch</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus.
                        </p>
                        <hr>
                        <h4>The Office</h4>
                        <ul class="list-unstyled">
                            <li>
                                <i class="icon icon-map-marker"></i><strong>Address:</strong> 1234 Street Name, City Name, United States
                            </li>
                            <li>
                                <i class="icon icon-phone"></i><strong>Phone:</strong> (123) 456-7890
                            </li>
                            <li>
                                <i class="icon icon-envelope"></i><strong>Email:</strong>
                                <a href="mailto:mail@example.com">
                                    mail@example.com
                                </a>
                            </li>
                        </ul>
                        <hr class="right">
                        <h4>Business Hours</h4>
                        <ul class="list-unstyled">
                            <li>
                                <i class="icon icon-time"></i> Monday - Friday 9am to 5pm
                            </li>
                            <li>
                                <i class="icon icon-time"></i> Saturday - 9am to 2pm
                            </li>
                            <li>
                                <i class="icon icon-time"></i> Sunday - Closed
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="wrapper wrapper-grey">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="promobox">
                            <p class="center">
                                Clip-One Template makes it easy to create a World class website with a unique style and many new awesome features!
                            </p>
                            <p class="center">
                                <a href="http://themeforest.net/item/clipone-bootstrap-3-responsive-admin-template/5881143?ref=Cliptheme" class="btn btn-bricky">
                                    Buy Now
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <script>
        jQuery(document).ready(function() {
            map = new GMaps({
                div: '#map',
                lat: -12.043333,
                lng: -77.028333
            });
            map.addMarker({
                lat: -12.043333,
                lng: -77.03,
                title: 'Lima',
                details: {
                    database_id: 42,
                    author: 'HPNeo'
                },
                click: function(e) {
                    if (console.log)
                        console.log(e);
                    alert('You clicked in this marker');
                }
            });
            map.addMarker({
                lat: -12.042,
                lng: -77.028333,
                title: 'Marker with InfoWindow',
                infoWindow: {
                    content: '<p>HTML Content</p>'
                }
            });
        });
    </script>