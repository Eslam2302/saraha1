<?php
session_start();
if (isset($_SESSION['username'])) {
    $pageTitle = 'Profile';
    include 'init.php';

    if (isset($_GET['u']) && is_numeric($_GET['u'])) {

        $guestid    = $_GET['u'];   // user that u will send him message
        $userid     = isLoggedIn(); // user who logged in 

        $gueststmt  = $con->prepare("SELECT * FROM users WHERE id = ?");
        $gueststmt->execute(array($guestid));
        $fetchguest = $gueststmt->fetch();


    }

} else {
    header("location:index");
}

?>

<div class="container">
    <div class="mainprofile">
        <div class="info">
        <img src="<?php
            if ($fetchguest['user_img'] == null) {echo 'photos/profile.png';}
            else {echo 'photos/'.$fetchguest['user_img'];} 
        ?>" alt="">
        <p class="user-name"><?php echo ucwords($fetchguest['user_name']) ?></p>
        </div>
        <div class="sendmessage">
            <form action="" id="sendmessage" method="post">
                <textarea class="" placeholder="Type Your message" name="message"></textarea>
                <input type="submit" class="" value="SEND">
            </form>
            <p class="form-message"></p>
            <p class="form-success" style="color:green"></p>
            <p class="form-wait"></p>
        </div>
    </div>
</div>

<?php include 'includes/templates/footer.php' ?>

<script>
    // login validation with ajax
    $(document).on('submit','#sendmessage',function(e){
        e.preventDefault();
        $.ajax({
            url: "sendmessage?u=<?php echo $_GET['u'] ?>",
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
                
                if (response == '') {
                    $(".form-success").html("Message sent successfully, please wait...");
                    setTimeout(function(){location.reload()}, 500);
                }
            },
            error:function(error){
                
            }
        });
    });
</script>