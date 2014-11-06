<div id="edit-profile-wrapper"><!-- candidate to object -->
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
                    <td>
                        <img src="images/09.jpg">
                    </td>
                </tr>
                <tr>
                    <td onclick="$('.edit-profile-form-photo').click();">
                        <img src="images/22.png" width="100%" id="edit-profile-form-button">
                    </td>
                </tr>
            </table>
        </div>
        <form id="edit-profile-form-file">
            <input type="file" class="edit-profile-form-photo">
        </form>
        <div id="edit-profile-col-right">
            <table>
                <tr><td id="edit-profile-col-right-title">Edit Profile</td></tr>
                <tr><td><input type="email" class="form-control" id="" placeholder="Email"></td></tr>
                <tr><td><input type="text" class="form-control" id="" placeholder="Country"></td></tr>
                <tr><td><input type="text" class="form-control" id="" placeholder="State"></td></tr>
                <tr><td><input type="text" class="form-control" id="" placeholder="City"></td></tr>
                <tr><td><input type="text" class="form-control" id="" placeholder="Company"></td></tr>
                <tr><td><input type="text" class="form-control" id="" placeholder="Occupation"></td></tr>
                <tr><td><textarea placeholder="Write something about you..." id="edit-profile-col-right-textarea"></textarea></td></tr>
                <tr><td><button class="btn btn-info">Save</button></td></tr>
            </table>
        </div>
        <div class="clear"></div>
    </div><!-- end of edit profile form -->
</div><!-- end of edit profile wrapper -->