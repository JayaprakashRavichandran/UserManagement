<?php

if (isset($updateFlag) && $updateFlag == true) {
    $userId = $userData['USER_ID'];
    $name = $userData['NAME'];
    $username = $userData['USERNAME'];
    $emailId = $userData['EMAIL_ID'];
    $mobileNumber = $userData['MOBILE_NUMBER'];
    $imgUrl = $userData['USER_PROFILE_IMG'];
    $dob = $userData['DOB'];
    $status = $userData['STATUS'];
    $createdDttm = $userData['CREATED_DTTM'];
    $address = $userData['ADDRESS'];
    $city = $userData['CITY'];
    $state = $userData['STATE'];
    $country = $userData['COUNTRY'];
    $url = base_url() . 'UserController/updateUser/' . $userId;
} else {
    $updateFlag = false;
    $url = base_url() . 'UserController/createUser';
}
?>
<?php require APPPATH . 'views/User/Header.php' ?>
<div class="container">
    <form action="<?= $url ?>"
          method="post"
          id="create_users_container"
          enctype="multipart/form-data">

        <div id="header">
            <label><?= $title ?> </label>
        </div>
        <?php if ($updateFlag == true) { ?>
            <div class="main_column">
                <div class="profileImg">
                    <img src="<?= base_url() . '../dummy1_2021_03_13_17:10:14.png' ?>" alt="profile" class="uploaded_img"/>
                </div>
                <div class="clear"></div>
            </div>
        <?php } ?>


        <div id="content">
            <div class="main_column">
                <div class="sub_column">
                    <label>Name<span class="formInput-required">*</span> </label>
                </div>
                <div class="sub_column">
                    <input type="text"
                           name="user_fullName"
                           value="<?= isset($userData['NAME']) ? $userData['NAME'] : null?>"
                           required>
                </div>
                <div class="clear"></div>
            </div>
            <div class="main_column">
                <div class="sub_column">
                    <label>username<span class="formInput-required">*</span></label>
                </div>
                <div class="sub_column">
                    <input type="text"
                           name="user_userName"
                           value="<?= isset($userData['USERNAME']) ? $userData['USERNAME'] : null ?>"
                           <?php if ($updateFlag == true) echo "readonly"; ?>
                           required>
                </div>
                <div class="clear"></div>
            </div>
            <div class="main_column">
                <div class="sub_column">
                    <label>Email ID<span class="formInput-required">*</span></label>
                </div>
                <div class="sub_column">
                    <input type="text"
                           name="user_emailId"
                           value="<?= isset($userData['EMAIL_ID']) ? $userData['EMAIL_ID'] : null ?>"
                           <?php if ($updateFlag == true) echo "readonly"; ?>
                           required>
                </div>
                <div class="clear"></div>
            </div>
            <div class="main_column">
                <div class="sub_column">
                    <label>Mobile Number<span class="formInput-required">*</span></label>
                </div>
                <div class="sub_column">
                    <input type="text"
                           name="user_mobileNumber"
                           value="<?= isset($userData['MOBILE_NUMBER']) ? $userData['MOBILE_NUMBER'] : null ?>"
                           required>
                </div>
                <div class="clear"></div>
            </div>
            <?php if ($updateFlag == false) { ?>
                <div class="main_column">
                    <div class="sub_column">
                        <label>User profile Image</label>
                    </div>
                    <div class="sub_column">
                            <input type="file" name="profilePicture" id="profilePicture" value="Upload Image">
                            <!--   --><?php //$this->upload->do_upload('profilePicture');?>

                    </div>
                    <div class="clear"></div>
                </div>
            <?php } ?>
            <div class="main_column">
                <div class="sub_column">
                    <label>DOB<span class="formInput-required">*</span></label>
                </div>
                <div class="sub_column">
                    <input type="text"
                           name="user_dob"
                           value="<?= isset($userData['DOB']) ? $userData['DOB'] : null ?>"
                           required>
                </div>
                <div class="clear"></div>
            </div>
            <div class="main_column">
                <div class="sub_column">
                    <label>Address<span class="formInput-required">*</span></label>
                </div>
                <div class="sub_column">
                    <textarea name="user_Address"
                              required><?= isset($userData['ADDRESS']) ? $userData['ADDRESS'] : null ?>
                    </textarea>
                </div>
                <div class="clear"></div>
            </div>
            <div class="main_column">
                <div class="sub_column">
                    <label>City<span class="formInput-required">*</span></label>
                </div>
                <div class="sub_column">
                    <input type="text"
                           name="user_city"
                           value="<?= isset($userData['CITY']) ? $userData['CITY'] : null ?>"
                           required>
                </div>
                <div class="clear"></div>
            </div>
            <div class="main_column">
                <div class="sub_column">
                    <label>State<span class="formInput-required">*</span></label>
                </div>
                <div class="sub_column">
                    <input type="text"
                           name="user_state"
                           value="<?= isset($userData['STATE']) ? $userData['STATE'] : null ?>"
                           required>
                </div>
                <div class="clear"></div>
            </div>
            <div class="main_column">
                <div class="sub_column">
                    <label>Country<span class="formInput-required">*</span></label>
                </div>
                <div class="sub_column">
                    <input type="text"
                           name="user_country"
                           value="<?= isset($userData['COUNTRY']) ? $userData['COUNTRY'] : null ?>"
                           required>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div id="footer">
            <input type="submit" value="SUBMIT">
        </div>
    </form>
</div>
</body>
</html>
