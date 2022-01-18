$(function () {

    'use strict';

    // Remove placeholder when focus

    $('[placeholder]').focus(function () {

        $(this).attr('data-text', $(this).attr('placeholder'));

        $(this).attr('placeholder', '');

    }).blur(function () {

        $(this).attr('placeholder', $(this).attr('data-text'));

    });

    // Show Password
    
    var passField = $('.login .mail-pass');

    $('.login .field i').hover(function () {

        passField.attr('type','text');
     
    }, function () {

        passField.attr('type', 'password');

    });

    // Message Section 

    $('.message .sections div').click(function () {

        $(this).css({"color" : "#FFF","background-color":"#3498db"}).siblings().css({"color" : "#3498db","background-color":"#FFF"})

    })

    // Manage Section 

    $('.manage .left div').click(function () {

        $(this).css({"color" : "#FFF","background-color":"#3498db"}).siblings().css({"color" : "#1568a0","background-color":"#FFF"})

    })

    // manage right section
    // change name
    $('.manage .left .left-n').click(function () {

        $('.manage .change-n').slideDown();
        $('.manage .change-e').hide();
        $('.manage .change-p').hide();
    });
    // change email
    $('.manage .left .left-e').click(function () {
        $('.manage .change-e').slideDown();
        $('.manage .change-n').hide();
        $('.manage .change-p').hide();
    });
    // change password
    $('.manage .left .left-p').click(function () {
        $('.manage .change-p').slideDown();
        $('.manage .change-n').hide();
        $('.manage .change-e').hide();
    });


    



    
});