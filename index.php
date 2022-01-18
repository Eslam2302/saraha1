<?php 
session_start();
$pageTitle = "Login";
include 'init.php';

if (isset($_SESSION['username'])) {
    header('location: messages');
}



?>


<div class="container">
    <h1 class="text-center">Login</h1>    
    <form class="login" action="" method="POST" enctype="multipart/form-data" id="myform">
        <div class="field">
            <input class="mail-name" type="text" name="name" placeholder="User name">
        </div>
        <div class="field">
            <i class="fas fa-eye"></i>
            <input class="mail-pass" type="password" name="password" placeholder="Password">
        </div>
        <p class="form-message"></p>
        <p class="form-success"></p>
        <p class="form-wait"></p>
        <div class="field">
            <input class="mail-submit" type="submit" name="login" value="Login">
        </div>
    </form>
</div>


<?php include 'includes/templates/footer.php'; ?>


<script>
     // login validation with ajax
     $(document).on('submit','#myform',function(e){
        e.preventDefault();
        $.ajax({
            url:"login",
            type:"post",
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
                    $('.form-wait').hide();
                    $(".form-success").html("Logging in, please wait...");
                    $('.login input').removeClass("input-error");
                    location.href = "messages"
                }
            },
            error: function (d) {
                console.log(d);
            }
        });
    });
</script>
