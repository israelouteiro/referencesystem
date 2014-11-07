
<div id="uo-option"><!-- candidate to object -->
    <table>
        <tr>
            <td width="60" style="background:url(<?php echo $foto_user; ?>) no-repeat center center; background-size:cover;"  class="userPhotoProfile"><img src="images/02.png" style="visibility:hidden;"></td>
            <td width="12">&nbsp;</td>
            <td width="158">
                <p class="uo-name"><?php echo $user_nome; ?></p>
                <p onclick="setEditProfile()" class="uo-edit">Edit profile</p>
            </td>
            <td width="12">&nbsp;</td>
            <td width="56"><img src="images/04.png" id="logOutButton" onclick="location.href=('includes/logout.php');"></td>
            <td width="12">&nbsp;</td>
        </tr>
    </table>
</div>