<?php 
session_start();
$pageTitle = "About Us";
include 'init.php';

?>

<div class="about">
    <div class="container">
        <div class="col-12 col-md-12 col-sm-12">
            <h2>Are you ready to face frankness?</h2>
            <p>Get honest feedback from your coworkers and friends.</p>
        </div>
        <div class="col-6 col-md-6 col-sm-12">
            <h3>At work</h3>
            <p>Strengthen Areas for Improvement</p>
            <p>Enhance your areas of strength</p>
        </div>
        <div class="col-6 col-md-6 col-sm-12">
            <h3>With Your Friends</h3>
            <p>Improve your friendship</p>
            <p>Let your friends be honest with you</p>     
        </div>
    </div>
</div>
<div class="aboutus">
    <div class="container">
        <div class="col-3 col-sm-12 col-md-12">
            <h4>1. Create your personal feedback URL.</h4>
            <a href="register">Here</a>
            <p>People will write anonymous and honest opinions about you on that URL.</p>
        </div>
        <div class="col-3 col-sm-12 col-md-12">
            <h4>2.Share the URL through Instagram, Twitter, Facebook etc.</h4>
        </div>
        <div class="col-3 col-sm-12 col-md-6">
            <h4>3. Read what people think about you.</h4>
            <p>The feedback you receive is private - only you can see it.</p>
        </div>
        <div class="col-3 col-sm-12 col-md-6">
            <h4>4. Publish your favorite feedbacks.</h4>
            <p>The feedback you receive is private - only you can see it.</p>
        </div>
    </div>
</div>

<?php include 'includes/templates/footer.php'; ?>