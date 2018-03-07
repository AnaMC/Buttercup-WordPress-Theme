<?php
    get_header();
    get_template_part('nav');
?>
<div style="height:80px"></div>

<section>
    <div class="container">
        <div class="row row-contact">
            <div class="col-lg-4 bg-primary">
                <div class="d-02"><i class="far fa-envelope fa-4x"></i></div>
                <div class="d-01">
                    <p>Please describe your product idea in a nutshell</p>
                </div>
                <div class="d-00">
                    
                    <p> we nedd your email to reach you back </p>
                </div>
            </div>
            <div class="col-lg-8">
                <form class="">
                    <div class="container contact-info">
                        <div class="">
                            <h1 class="">Hire us</h1>
                        </div>
                        <label class="">Mensaje</label><br>
                        <textarea></textarea><br>
                        <label class="">Your name</label>
                        <label class="">Your email</label><br>
                        <input class="" type="text" name=""/>
                        <input class="" type="text" name=""/><br>
                        <button class="" type="reset">cancel</button>
                        <button class="" type="submit">send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
