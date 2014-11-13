<?php
        
        #######     OBJ USUARIO


      #  $user_nome
      #  $user_email
      #  $user_foto
      #  $user_cargo 
      #  $user_pais
      #  $user_estado 
      #  $user_cidade 
      #  $user_empresa 
      #  $user_sobre 
      #  $user_idFacebook

?>
<div id="edit-profile-wrapper" style="display:none;"><!-- candidate to object -->
    <div id="edit-profile-img">
        <div id="edit-profile-img-wrap">
            <img src="images/21.png">
            <div class="clear"></div>
        </div>
    </div>
    <div id="edit-profile-form">
        <div id="edit-profile-col-left">
            <table>
                <tr>
                    <td style="background:url(<?php echo $foto_user; ?>) no-repeat center center;background-size:cover;" class="userPhotoProfile">
                        <img src="images/09.jpg" style="visibility:hidden;">
                    </td>
                </tr>
                <tr>
                    <td height="9"></td>
                </tr>
                <tr>
                    <td onclick="$('.edit-profile-form-photo').click();">
                        <img src="images/22.png" width="100%" id="edit-profile-form-button">
                    </td>
                </tr>
            </table>
        </div>
        <form id="edit-profile-form-file">
            <input type="file" class="edit-profile-form-photo" id="editProfilePhoto">
        </form>
        <div id="edit-profile-col-right">

            <form id="" action="" method="post">
            <input type="hidden" name="eFoto" value="<?php $user_foto; ?>">
                <table>
                    <tr><td id="edit-profile-col-right-title">Edit Profile</td></tr>
                    <tr><td><input name="eEmail" type="email" class="form-control" id="" placeholder="Email" value="<?php echo $user_email; ?>" required></td></tr>
                    <tr><td><input name="ePais" type="text" class="form-control" id="" placeholder="Country" value="<?php echo $user_pais; ?>" required></td></tr>
                    <tr><td><input name="eEstado" type="text" class="form-control" id="" placeholder="State" value="<?php echo $user_estado; ?>" required></td></tr>
                    <tr><td><input name="eCidade" type="text" class="form-control" id="" placeholder="City" value="<?php echo $user_cidade; ?>" required></td></tr>
                    <tr><td><input name="eEmpresa" type="text" class="form-control" id="" placeholder="Company" value="<?php echo $user_empresa; ?>" required></td></tr>
                    <tr><td><input name="eCargo" type="text" class="form-control" id="" placeholder="Occupation" value="<?php echo $user_cargo; ?>" required></td></tr>
                    <tr><td><textarea name="eSobre" placeholder="Write something about you..." id="edit-profile-col-right-textarea" required><?php echo $user_sobre; ?></textarea></td></tr>
                    <tr><td><button type="submit" class="btn btn-info">Save</button></td></tr>
                </table>

            </form>

        </div>
        <div class="clear"></div>
    </div><!-- end of edit profile form -->
</div><!-- end of edit profile wrapper -->