<!-- Contact -->
<section id="contact" class="contact padded">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="white">Contact.</h4>
                <p class="sub-heading">What can I help you with?</p>
            </div>
    
            <div class="col-lg-8 col-lg-offset-2">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Name</label>
                        <input type="text" class="form-control ime" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                        <p class="help-block text-danger"></p>
                    </div>
      
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Email Address</label>
                        <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                        <p class="help-block text-danger"></p>
                    </div>
         
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Message</label>
                        <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
               
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-success btn-lg ">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<section id="footer"> 
    <footer class="text-center container">
        <div class="row"><a href="">
            <div class="col-md-6 col-md-offset-3">
                <a href="https://www.facebook.com/klemen.sarlah?fref=ts" target="_blank"><i class="btn-social btn-outline fa fa-facebook"></i></a>
                <a href="http://sarlah.deviantart.com/" target="_blank"><i class="btn-social btn-outline fa fa-deviantart"></i></a>
                <div class="tooltip" title="Not yet added!"><i class="btn-social btn-outline fa fa-linkedin"></i></div>
                <div class="tooltip" title="klemen.sarlah"><i class="btn-social btn-outline fa fa-skype"></i></div>
                <div class="tooltip" title="Not yet added!" href=""><i class="btn-social btn-outline fa fa-twitter"></i></div>

            </div>

            <div class="col-lg-12 space">
                Copyright &copy; Janez Šarlah 2014
            </div>
        </div>
    </footer>
</section>