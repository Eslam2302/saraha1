<?php 

$pageTitle = "Register";
include 'init.php';
?>



<div class="container">
    <h1 class="text-center">Register</h1>    
    <form class="login" action="" method="POST" id="signup">
        <div class="field">
            <input class="name" type="text" name="name" placeholder="User name">
        </div>
        <div class="field">
            <i class="fas fa-eye"></i>
            <input class="mail-pass" type="password" name="password1" placeholder="Password">
        </div>
        <div class="field">
            <i class="fas fa-eye"></i>
            <input class="pass" type="password" name="password2" placeholder="Confirm Password">
        </div>
        <div class="field">
            <input class="email" type="email" name="email" placeholder="Email">
        </div>
        <p class="form-message"></p>
        <p class="form-success" style="color:green"></p>
        <p class="form-wait"></p>
        <div class="field">
            <input type="submit" name="register" value="Register">
        </div>
    </form>
</div>

<?php include 'includes/templates/footer.php' ?>

<script>
    // rigester validation with ajax
    $(document).on('submit','#signup',function(e){
        e.preventDefault();
        let formData = $('#signup').serialize();
        $.ajax({
            url: "phpregister",
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
                $('.login input').addClass("input-error").delay(3000).queue(function(next){
                    $(this).removeClass("input-error");
                    next();
                });
                if (response == '') {
                    $(".form-success").html("Signup successfully !<br>Logging in, please wait...");
                    $('.login input').removeClass("input-error");
                    location.href = "index"
                }
            },
            error:function(error){
                
            }
        });
    });
</script>
