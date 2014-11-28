<!-- Contact -->
<section id="contact" class="contact padded">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="white">Contact.</h4>
                <p class="sub-heading">What can I help you with?</p>
            </div>
        
            <?php 
            $email_send_attributes = array("method" => "post", "name" => "sendEmail" );

            $name_attributes = array("type" => "text", "name" => "name", "placeholder" => "Name", "class" => "form-control");
            $email_attributes = array("type" => "email", "name" => "email", "placeholder" => "Email Address", "class" => "form-control");
            $message_attributes = array("type" => "text", "name" => "message", "placeholder" => "Message", "class" => "form-control", "rows" => "5");

            ?>

            <div class="col-lg-8 col-lg-offset-2">
                <?php echo form_open("email/send_email", $email_send_attributes); ?>
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Name</label>
                        <?php echo form_input($name_attributes); ?>
                        <p class="help-block text-danger"></p>
                    </div>
      
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Email Address</label>
                        <?php echo form_input($email_attributes); ?><p class="help-block text-danger"></p>
                    </div>
         
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label>Message</label>
                        <?php echo form_textarea($message_attributes); ?>
                    </div>

               
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-success btn-lg disabled">Send</button>
                    </div>
                <?php echo form_close(); ?>
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
                 &copy; <a href="https://twitter.com/janezsarlah">@janezsarlah</a> 2014
            </div>
        </div>
    </footer>
</section>