<?php
session_start();

if (isset($_SESSION['username'])) {

    $pageTitle = 'Manage';
    include 'init.php';

} else {
    header("location:index");
}

?>

<div class="container">
    <div class="manage">
        <div class="left col-3 col-sm-12 col-md-3">
            <div class="left-n" style="background-color: #3498db;color:#FFF"><i class="far fa-user"></i> Change name</div>
            <div class="left-e"><i class="fas fa-at"></i> Change email</div>
            <div class="left-p"><i class="fas fa-lock"></i> Change password</div>
        </div>
        <div class="col-1 col-sm-12" style="background-color: rgb(245, 244, 244);"></div>
        <div class="change-n right col-8 col-sm-12 col-md-8">
            <h1>Change name</h1>
            <hr>
            <form class="" action="" id="change-name" method="post">
                <span class="name">Name: </span>
                <input type="text" class="input-text" name="name" placeholder="Type new name">
                <input type="submit" value="Change" name="post" class="">
                <p class="form-message" style="text-align: center;"></p>
                <p class="form-success" style="text-align: center;"></p>
                <p class="form-wait" style="text-align: center;"></p>
            </form>
        </div>
        <div class="change-e right col-8 col-sm-12 col-md-8" style="display:none">
            <h1>Change Email</h1>
            <hr>
            <form class="" action="" id="change-email" method="post">
                <span class="name">Email: </span>
                <input type="email" class="input-text" name="email" placeholder="Type a valid email">
                <input type="submit" value="Change" name="post" class="">
                <p class="form-message" style="text-align: center;"></p>
                <p class="form-success" style="text-align: center;"></p>
                <p class="form-wait" style="text-align: center;"></p>
            </form>
        </div>
        <div class="change-p right col-8 col-sm-12 col-md-8" style="display:none">
            <h1>Change Password</h1>
            <hr>
            <form class="" action="" id="change-pass" method="post">
                <input type="password" class="input-text" name="oldpassword" placeholder="Type your old password">
                <input type="password" class="input-text" name="newpassword" placeholder="Type your new password">
                <input type="password" class="input-text" name="rnewpassword" placeholder="Repeat your new password">
                <input type="submit" value="Change" name="post" class="">
                <p class="form-message" style="text-align: center;"></p>
                <p class="form-success" style="text-align: center;"></p>
                <p class="form-wait" style="text-align: center;"></p>
            </form>
        </div>
    </div>
</div>


<?php include 'includes/templates/footer.php'; ?>

<script>
    // change name with ajax
    $(document).on('submit','#change-name',function(e){
        e.preventDefault();
        $('#change-email .form-message').hide();
        $('#change-pass .form-message').hide();
        $('#change-name .form-message').show();
        $.ajax({
            url:"phpchangename",
            type:"post",
            data: $(this).serialize(),
            cache: false,
            processData:false,
            beforeSend: function (before) {
                $('#change-name .form-wait').html("<i class='fas fa-spinner fa-spin fa-lg'></i> Please wait ...");
            },
            success: function (response) {
                $('#change-name .form-wait').hide();
                $('#change-name .form-message').html(response).delay(3000).queue(function(next){
                    $(this).hide();next();});
                $('#change-name  .input-text').addClass("input-error").css("border","none").delay(3000).queue(function(next){
                    $(this).removeClass("input-error").css("border","1px solid #3498db");
                    next();
                });
                if (response == '') {
                    $('#change-name .form-wait').hide();
                    $("#change-name .form-success").html("Changed successfuly, please wait...");
                    $('#change-name  input').removeClass("input-error").css("border","1px solid #3498db");
                    setTimeout(function(){location.reload()}, 500);
                }
            },
            error: function (d) {
                console.log(d);
            }
        });
    });
    // change email with ajax
    $(document).on('submit','#change-email',function(e){
        e.preventDefault();
        $('#change-name .form-message').hide();
        $('#change-pass .form-message').hide();
        $('#change-email .form-message').show();
        $.ajax({
            url:"phpchangeemail",
            type:"post",
            data: $(this).serialize(),
            cache: false,
            processData:false,
            beforeSend: function (before) {
                $('#change-email .form-wait').html("<i class='fas fa-spinner fa-spin fa-lg'></i> Please wait ...");
            },
            success: function (response) {
                $('#change-email .form-wait').hide();
                $('#change-email .form-message').html(response).delay(3000).queue(function(next){
                    $(this).hide();next();});
                $('#change-email  .input-text').addClass("input-error").css("border","none").delay(3000).queue(function(next){
                    $(this).removeClass("input-error").css("border","1px solid #3498db");
                    next();
                });
                if (response == '') {
                    $('#change-email .form-wait').hide();
                    $("#change-email .form-success").html("Changed successfuly, please wait...");
                    $('#change-email  input').removeClass("input-error").css("border","1px solid #3498db");
                    setTimeout(function(){location.reload()}, 500);
                }
            },
            error: function (d) {
                console.log(d);
            }
        });
    });
    // change password with ajax
    $(document).on('submit','#change-pass',function(e){
        e.preventDefault();
        $('#change-name .form-message').hide();
        $('#change-email .form-message').hide();
        $('#change-pass .form-message').show();
        $.ajax({
            url:"phpchangepass",
            type:"post",
            data: $(this).serialize(),
            cache: false,
            processData:false,
            beforeSend: function (before) {
                $('#change-pass .form-wait').html("<i class='fas fa-spinner fa-spin fa-lg'></i> Please wait ...");
            },
            success: function (response) {
                $('#change-pass .form-wait').hide();
                $('#change-pass .form-message').html(response).delay(3000).queue(function(next){
                    $(this).hide();next();});
                $('#change-pass  .input-text').addClass("input-error").css("border","none").delay(3000).queue(function(next){
                    $(this).removeClass("input-error").css("border","1px solid #3498db");
                    next();
                });
                if (response == '') {
                    $('#change-pass .form-wait').hide();
                    $("#change-pass .form-success").html("Changed successfuly, please wait...");
                    $('#change-pass  input').removeClass("input-error").css("border","1px solid #3498db");
                    setTimeout(function(){location.reload()}, 500);
                }
            },
            error: function (d) {
                console.log(d);
            }
        });
    });
</script>