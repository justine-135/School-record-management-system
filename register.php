<?php include "partials/header.php"; ?>

<?php $header = "/teachers"; ?>
<?php $view="teachers"; ?>
<?php $h4="Teachers"; ?>

<?php include "partials/nav.php"; ?>
<?php include './partials/alert.php'; ?>

<form class="container-fluid w-90 border mt-4 p-4 bg-white mb-3" action="./includes/teachers.inc.php" method="post" enctype="multipart/form-data">
    <h4 class="">Registeration form</h4>
    <div class="border mt-3">
      <div>
        <h5 class="border-bottom p-3">Teacher information</h5>
        <div id="emailHelp" class="form-text ps-3">*All text fields cannot contain special characters. e.g.(!,@,#, etc..)</div>

        <div class="row g-3 p-3">
          <div class="col-md-4">
            <label for="surname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" placeholder="Enter surname" name="sname" value="<?= isset($_GET['surname']) ? $_GET['surname'] : "" ?>" required>
          </div>
          <div class="col-md-4">
            <label for="fname" class="form-label">First name</label>
            <input type="text" class="form-control" id="fname" placeholder="Enter first name" name="fname" value="<?= isset($_GET['fname']) ? $_GET['fname'] : "" ?>" required>
          </div>
          <div class="col-md-4">
            <label for="mname" class="form-label">Middle name</label>
            <input type="text" class="form-control" id="mname" placeholder="Enter middle name" name="mname" value="<?= isset($_GET['mname']) ? $_GET['mname'] : "" ?>" required>         
          </div>
        </div>

        <div class="row g-3 p-3">
          <div class="col-md-4">
            <label for="ext" class="form-label">Extension</label>
            <select class="form-select" id="ext" aria-label="Default select example" name="extname">
              <option value="None" <?= isset($_GET['extname']) ? $_GET['extname'] === "None" ? "selected" : "" : ""?>>N/A</option>
              <option value="Jr." <?= isset($_GET['extname']) ? $_GET['extname'] === "Jr." ? "selected" : "" : ""?>>Jr</option>
              <option value="I" <?= isset($_GET['extname']) ? $_GET['extname'] === "I" ? "Selected" : "" : ""?>>I</option>
              <option value="II" <?= isset($_GET['extname']) ? $_GET['extname'] === "II" ? "selected" : "" : ""?>>II</option>
              <option value="III" <?= isset($_GET['extname']) ? $_GET['extname'] === "III" ? "selected" : "" : ""?>>III</option>
              <option value="IV" <?= isset($_GET['extname']) ? $_GET['extname'] === "IV" ? "selected" : "" : ""?>>IV</option>
              <option value="V" <?= isset($_GET['extname']) ? $_GET['extname'] === "V" ? "selected" : "" : ""?>>V</option>
              <option value="VI" <?= isset($_GET['extname']) ? $_GET['extname'] === "VI" ? "selected" : "" : ""?>>VI</option>
              <option value="VII" <?= isset($_GET['extname']) ? $_GET['extname'] === "VII" ? "selected" : "" : ""?>>VII</option>
              <option value="VIII" <?= isset($_GET['extname']) ? $_GET['extname'] === "VIII" ? "selected" : "" : ""?>>VIII</option>
              <option value="IX" <?= isset($_GET['extname']) ? $_GET['extname'] === "IX" ? "selected" : "" : ""?>>IX</option>
              <option value="X" <?= isset($_GET['extname']) ? $_GET['extname'] === "X" ? "selected" : "" : ""?>>X</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="bdate" class="form-label">Birthdate</label>
            <input type="date" class="form-control w-50" id="bdate" name="birth-date" value="<?= isset($_GET['bdate']) ? $_GET['bdate'] : "" ?>" required>
          </div>
          <div class="col-md-4">
            <span>Gender</span>
            <div class="d-flex mt-3">
              <div class="form-check me-3">
                <input type="radio" class="form-check-input" id="male-gender" name="gender" value="Male" <?= isset($_GET['gender']) ? ($_GET['gender'] === "Male") ? "checked" : "" : "checked" ?> required>
                <label class="form-check-label" for="male-gender">Male</label>
              </div>
              <div class="form-check">
                <input type="radio" class="form-check-input" id="female-gender" name="gender" value="Female" <?= isset($_GET['gender']) ? ($_GET['gender'] === "Female") ? "checked" : "" : "" ?> required>
                <label class="form-check-label" for="female-gender">Female</label>
              </div>
            </div>
          </div>
        </div>

        <div class="row g-3 p-3">
          <div class="col-md-4">
            <label for="contact" class="form-label">Contact number</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact number" value="<?= isset($_GET['contact']) ? $_GET['contact'] : "" ?>" required>
            <div id="emailHelp" class="form-text ps-3">*Format e.g., (09XXXXXXXXX)</div>
          </div>
          <div class="col-md-4">
            <label for="religion" class="form-label">Religion</label>
            <input type="text" class="form-control" id="religion" name="religion" placeholder="Enter religion" value="<?= isset($_GET['religion']) ? $_GET['religion'] : "" ?>" required>
          </div>
        </div>

        <h5 class="border-bottom border-top p-3">Address</h5>
        <div id="emailHelp" class="form-text ps-3">*All text fields cannot contain special characters. e.g.(!,@,#, etc..)</div>

        <div class="row g-3 p-3">
          <div class="col-md-4">
            <label for="house-number-street" class="form-label">House Number & Street</label>
            <input type="text" class="form-control" id="house-number-street" placeholder="Enter house number & street" name="house-number-street" value="<?= isset($_GET['house_street']) ? $_GET['house_street'] : "" ?>" required>
          </div>
          <div class="col-md-4">
            <label for="subdv-village-zone" class="form-label">Subdivision/Village/Zone</label>
            <input type="text" class="form-control" id="subdv-village-zone" placeholder="Enter subdivision/village/zone" name="subdv-village-zone" value="<?= isset($_GET['subd']) ? $_GET['subd'] : "" ?>" required>
          </div>
          <div class="col-md-4">
            <label for="barangay" class="form-label">Barangay</label>
            <input type="text" class="form-control" id="barangay" placeholder="Enter barangay" name="barangay" value="<?= isset($_GET['barangay']) ? $_GET['barangay'] : "" ?>" required>
          </div>
        </div>

        <div class="row g-3 p-3">
          <div class="col-md-4">
            <label for="city-municipality" class="form-label">City/Municipality</label>
            <input type="text" class="form-control" id="city-municipality" placeholder="Enter city/municipality" name="city-municipality" value="<?= isset($_GET['city']) ? $_GET['city'] : "" ?>" required>
          </div>
          <div class="col-md-4">
            <label for="province" class="form-label">Province</label>
            <input type="text" class="form-control" id="province" placeholder="Enter province" name="province" value="<?= isset($_GET['province']) ? $_GET['province'] : "" ?>" required>
          </div>
          <div class="col-md-4">
            <label for="region" class="form-label">Region</label>
            <input type="text" class="form-control" id="region" placeholder="Enter region" name="region" value="<?= isset($_GET['region']) ? $_GET['region'] : "" ?>" required>
          </div>
        </div>

        <h5 class="border-bottom border-top p-3">Account information</h5>
        <div id="emailHelp" class="form-text ps-3">*All text fields cannot contain special characters. e.g.(!,@,#, etc..)</div>
        <div class="row g-3 p-3">
            <div class="col-md-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?= isset($_GET['username']) ? $_GET['username'] : "" ?>" required>
                <div id="emailHelp" class="form-text ps-3">*Minimum characters is eight (8).</div>
              </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?= isset($_GET['email']) ? $_GET['email'] : "" ?>" required>
            </div>
            <div class="col-md-4">
                <label for="file" class="form-label">Profile image</label>
                <input type="file" class="form-control" id="file" name="file" accept="image/png, image/gif, image/jpeg" value="<?= isset($_GET['file']) ? $_GET['file'] : "" ?>" required>
                <div id="emailHelp" class="form-text ps-3" >*Choose jpeg/jpg, and png only.</div>
              </div>
        </div>
        <div class="row g-3 p-3">
            <div class="col-md-4">
                <label for="username" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="<?= isset($_GET['password']) ? $_GET['password'] : "" ?>" required>
                <div id="emailHelp" class="form-text ps-3">*Minimum characters is eight (8).</div>
            </div>
            <div class="col-md-4">
                <label for="confirm_password" class="form-label">Confirm password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter password" value="<?= isset($_GET['confirm_password']) ? $_GET['confirm_password'] : "" ?>" required>
            </div>
        </div>
      </div>
    </div>

    <div class="d-flex">
      <input class="btn btn-primary mt-2 ms-auto" type="submit" value="Register" name="register">
    </div>

</form>