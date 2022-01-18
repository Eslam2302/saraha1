<?php 
session_start();
$pageTitle = "Contact Us";
include 'init.php';

?>

<div class="contact">
    <div class="container">
        <h4>You can contact us by filling in the form below</h4>
        <hr>
            <form class="login" id="contact" action="" method="POST">
                <div class="field">
                    <input type="text" name="name" placeholder="User name">
                </div>
                <div class="field">
                    <input type="email" name="email" placeholder="Email">
                </div>
                <div class="field">
                    <input type="text" name="title" placeholder="Message title">
                </div>
                <div class="field">
                    <textarea name="message" placeholder="Message..."></textarea>
                </div>
                <p class="form-message"></p>
                <p class="form-success"></p>
                <p class="form-wait"></p>
                <div class="field">
                    <input type="submit" name="login" value="Send">
                </div>
            </form>
    </div>
</div>

<?php include 'includes/templates/footer.php'; ?>

<script>
    // rigester validation with ajax
    $(document).on('submit','#contact',function(e){
        e.preventDefault();
        $.ajax({
            url: "phpcontact",
            type: "post",
            data: $(this).serialize(),
            cache: false,
            processData:false,
            beforeSend: function (before) {
                $('.form-wait').html("<i class='fas fa-spinner fa-spin fa-lg'></i> Please wait ...");
            },
            success: function (response) {
                $('.form-wait').hide();
                $('.form-message').html(response);
                $('.login input , .login textarea').addClass("input-error").delay(3000).queue(function(next){
                    $(this).removeClass("input-error");
                    next();
                });
                if (response == '') {
                    $(".form-success").html("Signup successfully !<br>Logging in, please wait...");
                    $('.login input , .login textarea').removeClass("input-error");
                    location.href = "messages"
                }
            },
            error:function(error){
                
            }
        });
    });
</script>
