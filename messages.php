<?php 

session_start();

if (isset($_SESSION['username'])) {

    $pageTitle = 'Messages';
    include 'init.php';

    $userid = isLoggedIn();

    // Select Name That Logged In 
    $userstmt = $con->prepare("SELECT * FROM users Where id = ?");
    $userstmt->execute(array($userid));
    $fetch = $userstmt->fetch();
    
    $messagestmt = $con->prepare("SELECT * FROM messages WHERE receiver = ?");
    $messagestmt->execute(array($userid));
    $fetchmessage = $messagestmt->fetchAll();
    $count = $messagestmt->rowCount();
    


} else {
    header("location:index");
}

?>
<div class="container">
    <!-- Profile Section -->
    <div class="profile">
        <div class="content">
            <img src="<?php
            if ($fetch['user_img'] == null) {echo 'photos/profile.png';}
            else {echo 'photos/'.$fetch['user_img'];} 
            ?>" alt="">
            <form action="" method="POST" id="change-photo" enctype="multipart/form-data">
                <i class="fas fa-plus"></i>
                <input class="file" type="file" name="image" >
            </form>
        </div>
        <p class="user-name"><?php echo ucwords($fetch['user_name']) ?></p>
        <p class="form-success" style="display: none;"></p>
        <p class="form-message" style="display: none;"></p>
        <p><a href="profile?u=<?php echo $fetch['id'] ?>">Saraha.test/profile?u=<?php echo $fetch['id']; ?></a></p>
    </div>
    <!-- Profile Section -->
    <!-- Messages Section -->
    <div class="message">
        <h1>Messages <i class="far fa-comments fa-lg"></i></h1>
        <div class="sections">
            <div class="col-4 col-md-4 col-sm-12" style="background-color: #3498db;color:#FFF">Received</div>
            <div class="col-4 col-md-4 col-sm-12">Favourates</div>
            <div class="col-4 col-md-4 col-sm-12">Sent</div>
        </div>
        
            <?php 
                if ($count > 0) {
                    foreach ($fetchmessage as $message) {
                        echo '<div class="messageinfo">';
                        echo '<p>'. $message['body'] .'</p>';
                        echo '<p>'. $message['date'] .'</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<h3>Sorry there\'s no messages.</h3>';
                }
            ?>
        
    </div>
    <!-- Messages Section -->
</div>

<?php include 'includes/templates/footer.php'; ?>

<script>
    // Change photo with ajax
$(document).ready(function() {
    $('.file').change(function() {
        $.ajax({
            url:"phpmessages",
            type:"post",
            data: new FormData($(this).closest('form').get(0)),
            contentType: false,
            cache: false,
            processData:false,
            success: function (response) {
                $('.form-message').css("display", "block").html(response).fadeOut(2000);;
                if (response == '') {
                    $(".form-success").show();
                    $(".form-success").html("Photo changed successfully").fadeOut(2000);
                    setTimeout(function(){location.reload()}, 500);
                }
            },
            error: function (d) {
                console.log(d);
            }
        });
    });
});
</script>