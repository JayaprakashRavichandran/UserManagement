<?php
$allUsers = $users;
?>

<?php require APPPATH . 'views/User/Header.php' ?>

<div class="container">
    <div class="main-container">
        <div id="table_search" style="display: flex">
            <div class="filter-icon" style="width: 5%">
                <a><i class="fa fa-filter" style="font-size: 24px; color: black; font-weight: 500"></i></a>
            </div>
            <div style="width: 35%"></div>
            <div style="width: 20%; margin-top: 5px">
                <select name="user-filter" id="user-filter" style="width: 80%;">
                    <option>--select--</option>
                    <?php foreach ($filters as $key => $eachUserFilter) {?>
                    <option value="<?= $key ?>"
                            <?php if ($ActiveFilters == $key) { echo "selected"; } ?>>
                        <?= $eachUserFilter ?></option>
                    <?php } ?>
                </select>
            </div>
            <div id="search-fields" style="width: 25%; margin-top: 5px">
                <input type="text" id="userName" name="username" value="<?= $ActiveValue ?>">
                <input type="email" id="emailId" name="emailId" value="<?= $ActiveValue ?>">
                <input type="text" id="mobileNumber" name="mobileNumber" value="<?= $ActiveValue ?>">
                <input type="date" id="createdDate" name="createdDttm" value="<?= $ActiveValue ?>">
                <input type="date" id="dob" name="dob" value="<?= $ActiveValue ?>">
            </div>
            <div class="filter-submit" style="width: 10%">
                <button id="filter-btn">Submit</button>
            </div>
            <?php if (! empty($ActiveFilters)) { ?>
            <div style="width: 5%;">
                <a id="downloadCsv"><i class="fa fa-file" style="font-size: 24px; color: black; font-weight: 500"></i></a>
            </div>
            <?php } else { ?>
                <div style="width: 5%"></div>
            <?php } ?>
        </div>
        <div id="table_content">
            <table style="width:100%">
                <tr>
                    <th>SNo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($allUsers as $key => $eachUser) { ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $eachUser->NAME ?></td>
                        <td><?= $eachUser->EMAIL_ID ?></td>
                        <td><?= $eachUser->MOBILE_NUMBER ?></td>
                        <td><?php if ($eachUser->STATUS == 1) {
                            echo 'Active';
                        } else {
                            echo 'InActive';
                        } ?></td>
                        <td>
                            <a href="<?= base_url() ?>UserController/getUserById/<?= $eachUser->USER_ID ?>">
                                <i class="fa fa-edit" style="font-size: 24px; color: black; font-weight: 500"></i>
                            </a>
                            <a href="<?= base_url() ?>UserController/deleteUser/<?=$eachUser->USER_ID?>">
                                <i class="fa fa-trash-o" style="font-size: 24px; color: black; font-weight: 500"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
