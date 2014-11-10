// var myWidth = $('#undercover_option_01').width();

// var UO_OPTION_WIDTH = 300;
// var UO1_PHOTOS_WIDTH = 660;
var changeReferenceState = false;
var editProfileState = true;
var showProfileInfos = false;

$(document).ready(function() {
    
    changeReference();
    setEditProfile();
    // setPhotosLeft();
    setPostMenu();
    setProfileRight();
    
    $('#post-area-middle-textarea').autosize(); // textarea autosize vertically
    $('.post-comment-textarea').autosize();
    $('#edit-profile-col-right-textarea').autosize();
    $('#modal-textarea').autosize();
    
    /* more comments */
   // $('.more-comment-container').hide();
    $('.post-profile-infos-popup').hide();
    
    /* show comments when click on 'View Comments' */
/*    $('.more-comment-expand').bind('click', function() {
        $(this).parent().next('.more-comment-container').show();
    })
*/

    
    /* Show profile popup infos */
   /* $('.uo-name').bind('click', function() {
        if (showProfileInfos == false) {
            $(this).next('.post-profile-infos-popup').show();
            showProfileInfos = true;
        } else {
            $(this).next('.post-profile-infos-popup').hide();
            showProfileInfos = false;
        }
    });*/
    
    /* Show profile popup infos */
    $('.user-module-name').bind('click', function() {
        if (showProfileInfos == false) {
            $(this).parent().next('.post-profile-infos-popup').show();
            showProfileInfos = true;
        } else {
            $(this).parent().next('.post-profile-infos-popup').hide();
            showProfileInfos = false;
        }
    });



    
    /* change src image from 17.png to 18.png */
    $('.post-liked-hearth').bind('click', function() {
        $(this).attr('src','images/18.png');
    });
    $('.adminToolButton').bind('click', function() {
        //alert('Admin Tools'); // replace this code
       
            location.href=('admin.php');
        
    });
    $('#morePhotosButton').bind('click', function() {
        alert('Load More Photos'); // replace this code
    });
    $('#logOutButton').bind('click', function() {
        //alert('Log Out'); // replace this code
    });
    $('.uo_edit').bind('click', function() {
       // alert('Edit Profile'); // replace this code
    })
});

$(window).resize(function() {
    var plataformaWindow = $(window).width();
    // setPhotosLeft();
    setPostMenu();
    setProfileRight();
});

function setPostMenu() {
    var windowWidth = $(window).width();
    if (windowWidth < 768) {
        $('#post-area-top-left').css('float', 'left');
        $('#post-area-top-left').css('width', '90%');
        $('#post-area-top-left').css('margin-left', '10px');
        //
        $('#post-area-top-right').css('float', 'left');
        $('#post-area-top-right').css('width', '90%');
        $('#post-area-top-right').css('margin-left', '10px');
    } else {
        $('#post-area-top-left').css('float', 'right');
        $('#post-area-top-left').css('width', 'auto');
        $('#post-area-top-left').css('margin-left', '10px');
        $('#post-area-top-left').css('margin-right', '10px');
        //
        $('#post-area-top-right').css('float', 'left');
        $('#post-area-top-right').css('width', 'auto');
        $('#post-area-top-right').css('margin-left', '10px');
    }
}

/* No float left photos, overflow hidden on left size when resize */
/* function setPhotosLeft() {
    undercoverWidth = $('#undercover_option_01').width() - 2;
    uo1_photosLeft = UO1_PHOTOS_WIDTH - (undercoverWidth - UO_OPTION_WIDTH);
    $('#uo1_photos').css('left', -(uo1_photosLeft));
} */

function changeReference() {
    if (changeReferenceState == true) {
        $('#postReferenceImg').attr('src','images/20_off.png');
        $('#postRequestImg').attr('src','images/19_on.png');
        $('.postReference').css('color','#717171');
        $('.postRequest').css('color','#ee943c');
        $('.postReference').css('font-weight','normal');
        $('.postRequest').css('font-weight','bold');
        changeReferenceState = false;
    } else {
        $('#postReferenceImg').attr('src','images/20_on.png');
        $('#postRequestImg').attr('src','images/19_off.png');
        $('.postRequest').css('color','#717171');
        $('.postReference').css('color','#39a0c9');
        $('.postRequest').css('font-weight','normal');
        $('.postReference').css('font-weight','bold');
        changeReferenceState = true;
    }
}

function setProfileRight() {
    var windowWidth = $(window).width();
    var containerWidth = $('.container').width();
    var marginRight = Math.floor((windowWidth - containerWidth) / 2);
    $('#edit-profile-wrapper').css('right', marginRight);
}

function setEditProfile() {
    if (editProfileState == false) {
        $('#edit-profile-wrapper').show();
        editProfileState = true;
    } else {
        $('#edit-profile-wrapper').hide();
        editProfileState = false;
    }
}