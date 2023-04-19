<?php include "partials/header.php"; ?>

<?php $header = "/enrollment"; ?>

<?php include "partials/nav.php"; ?>

<?php include './partials/alert.php'; ?>

<?php
if (empty($_SESSION['username']) && empty($_SESSION['account_id'])) {
  header("Location: ./login.php");
}
?>

<form class="container-fluid w-90 border mt-4 p-4 bg-white mb-3" action="./includes/enrollment.inc.php" method="post" enctype="multipart/form-data">
    <h4 class="">Enroll a Learner</h4>
    <div class="border mt-3">
      <div>
        <h5 class="border-bottom p-3">Enrollment information</h5>
        <div class="row g-3 p-3">
          <div class="col-md-4">
            <label for="lrn" class="form-label">LRN</label>
            <input type="text" class="form-control" id="lrn" placeholder="Enter learner reference number" name="lrn" value="<?= isset($_GET['lrn']) ? $_GET['lrn'] : "" ?>" required>
          </div>
          <div class="col-md-4">
            <label for="from-sy" class="form-label">Start of school year</label>
            <input type="number" class="form-control from-sy-textbox" id="from-sy" placeholder="Enter year" name="from-sy" value="<?= isset($_GET['from_sy']) ? $_GET['from_sy'] : "" ?>" required>
              
          </div>
          <div class="col-md-4">
            <label for="to-sy" class="form-label">End of school Year</label>
            <input type="number" class="form-control to-sy-textbox" id="to-sy" placeholder="Enter year" name="to-sy" value="<?= isset($_GET['to_sy']) ? $_GET['to_sy'] : "" ?>" required>
          </div>
          
        </div>
        <div class="row g-3 p-3">
          <div class="col-md-4">
            <label for="grade-level" class="form-label">Grade Level</label>
            <input type="hidden" name="grade-lvl-input" value="<?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] : "" ?>"  id="">
            <select class="form-select grade-select" id="grade-level" aria-label="Default select example" name="grade-lvl">
              <option value="Kindergarten" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "Kindergerten" ? 'selected' : "" : "" ?>>Kindergarten</option>
              <option value="1" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "1" ? 'selected' : "" : "" ?>>1</option>
              <option value="2" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "2" ? 'selected' : "" : "" ?>>2</option>
              <option value="3" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "3" ? 'selected' : "" : "" ?>>3</option>
              <option value="4" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "4" ? 'selected' : "" : "" ?>>4</option>
              <option value="5" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "5" ? 'selected' : "" : "" ?>>5</option>
              <option value="6" <?= isset($_GET['grade_lvl']) ? $_GET['grade_lvl'] == "6" ? 'selected' : "" : "" ?>>6</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="grade-level" class="form-label">Section</label>
            <input type="hidden" name="grade-section-input" value="<?= isset($_GET['section']) ? $_GET['section'] : "" ?>"  id="">
            <select class="form-select section-select" id="section" aria-label="Default select example" name="section">
              <option value="None" selected>Choose</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="file" class="form-label">Upload student picture</label>
            <input type="file" class="form-control" id="file" name="file" accept="image/png, image/gif, image/jpeg" value="<?= isset($_GET['file']) ? $_GET['file'] : "" ?>" required>
            <div id="emailHelp" class="form-text ps-3" >*Choose jpeg/jpg, and png only.</div>
          </div>
        </div>
        <h5 class="border-top border-bottom p-3">Basic information</h5>
        <div class="row g-3 p-3">
          <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Surname</label>
            <input type="text" class="form-control" id="validationCustom01" placeholder="Enter surname" name="sname" value="<?= isset($_GET['surname']) ? $_GET['surname'] : "" ?>" required>
          </div>
          <div class="col-md-4">
            <label for="validationCustom02" class="form-label">First name</label>
            <input type="text" class="form-control" id="validationCustom02" placeholder="Enter first name" name="fname" value="<?= isset($_GET['fname']) ? $_GET['fname'] : "" ?>" required>
          </div>
          <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Middle name</label>
            <input type="text" class="form-control" id="validationCustom02" placeholder="Enter middle name" name="mname" value="<?= isset($_GET['mname']) ? $_GET['mname'] : "" ?>" required>          
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
            <input type="date" class="form-control" id="bdate" name="birth-date" value="<?= isset($_GET['bdate']) ? $_GET['bdate'] : "" ?>" required>
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
            <label for="validationCustom02" class="form-label">Religion</label>
            <input type="text" class="form-control" id="validationCustom02" name="religion" placeholder="Enter religion" value="<?= isset($_GET['religion']) ? $_GET['religion'] : "" ?>" required>
          </div>
        </div>

        <h5 class="border-bottom border-top  p-3">Address</h5>
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
      </div>

      <div>
        <h5 class="border-bottom border-top p-3">Parent/Guardian Information</h5>
        <div class="row g-3 p-3">
          <div class="col-md-4 ">
            <h6 class="text-center">Father</h6>
            <div class="d-flex flex-column">
              <span for="f-surname" class="form-label">Surname</span>
              <input type="text" class="form-control mb-2" id="f-surname" placeholder="Enter surname" name="f-surname" value="<?= isset($_GET['father_surname']) ? $_GET['father_surname'] : "" ?>" required>
              <span for="f-fname" class="form-label">First name</span>
              <input type="text" class="form-control mb-2" id="f-fname" placeholder="Enter surname" name="f-fname" value="<?= isset($_GET['father_fname']) ? $_GET['father_fname'] : "" ?>" required>
              <span for="f-mname" class="form-label">Middle name</span>
              <input type="text" class="form-control" id="f-mname" placeholder="Enter surname" name="f-mname" value="<?= isset($_GET['father_mname']) ? $_GET['father_mname'] : "" ?>" required>
            </div>
          </div>
          <div class="col-md-4 ">
            <h6 class="text-center">Mother</h6>
            <div class="d-flex flex-column">
              <span for="m-surname" class="form-label">Surname</span>
              <input type="text" class="form-control mb-2" id="m-surname" placeholder="Enter surname" name="m-surname" value="<?= isset($_GET['mother_surname']) ? $_GET['mother_surname'] : "" ?>" required>
              <span for="m-fname" class="form-label">First name</span>
              <input type="text" class="form-control mb-2" id="m-fname" placeholder="Enter surname" name="m-fname" value="<?= isset($_GET['mother_fname']) ? $_GET['mother_fname'] : "" ?>" required>
              <span for="m-mname" class="form-label">Middle name</span>
              <input type="text" class="form-control" id="m-mname" placeholder="Enter surname" name="m-mname" value="<?= isset($_GET['mother_mname']) ? $_GET['mother_mname'] : "" ?>" required>
            </div>
          </div>
          <div class="col-md-4 ">
            <h6 class="text-center">Guardian</h6>
            <div class="d-flex flex-column">
              <span for="g-surname" class="form-label">Surname</span>
              <input type="text" class="form-control mb-2" id="g-surname" placeholder="Enter surname" name="g-surname" value="<?= isset($_GET['guardian_surname']) ? $_GET['guardian_surname'] : "" ?>" required>
              <span for="g-fname" class="form-label">First name</span>
              <input type="text" class="form-control mb-2" id="g-fname" placeholder="Enter first name" name="g-fname" value="<?= isset($_GET['guardian_fname']) ? $_GET['guardian_fname'] : "" ?>" required>
              <span for="g-mname" class="form-label">Middle name</span>
              <input type="text" class="form-control" id="g-mname" placeholder="Enter middle name" name="g-mname" value="<?= isset($_GET['guardian_mname']) ? $_GET['guardian_mname'] : "" ?>" required>            
            </div>
          </div>
        </div>
        <div class="row g-3 p-3">
          <div class="col-md-4 ">
            <span class="d-block mb-2">Highest Educational Attainment</span>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="f-elementary-graduate" name="f-highest-education" value="Elementary Graduate"  <?= isset($_GET['father_education']) ? ($_GET['father_education'] === "Elementary Graduate") ? "checked" : "" : "checked" ?>  required>
              <label class="form-check-label" for="f-elementary-graduate">Elementary Graduate</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="f-highschool-graduate" name="f-highest-education" value="Highschool Graduate"  <?= isset($_GET['father_education']) ? ($_GET['father_education'] === "Highschool Graduate") ? "checked" : "" : "" ?>   required>
              <label class="form-check-label" for="f-highschool-graduate">Highschool Graduate</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="f-college-graduate" name="f-highest-education" value="College Graduate"  <?= isset($_GET['father_education']) ? ($_GET['father_education'] === "College Graduate") ? "checked" : "" : "" ?>    required>
              <label class="form-check-label" for="f-college-graduate">College Graduate</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="f-vocational" name="f-highest-education" value="Vocational"  <?= isset($_GET['father_education']) ? ($_GET['father_education'] === "Vocational") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="f-vocational">Vocational</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="f-master-degree" name="f-highest-education" value="Master's Doctorate Degree"  <?= isset($_GET['father_education']) ? ($_GET['father_education'] === "Master's Doctorate Degree") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="f-master-degree">Master's Doctorate Degree</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="f-not-attend-school" name="f-highest-education" value="Did not attend school" <?= isset($_GET['father_education']) ? ($_GET['father_education'] === "Did not attend school") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="f-not-attend-school">Did not attend school</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input other-education-radio education-radio" id="f-others" name="f-highest-education" value="Others"  <?= isset($_GET['father_education']) ? ($_GET['father_education'] === "Others") ? "checked" : "" : ""  ?> required>
              <label class="form-check-label" for="f-others">Others</label>
              <input type="<?= isset($_GET['father_education']) ? $_GET['father_education'] === "Others" ? "text" : "hidden" : "hidden" ?>" class="form-control other-education-textbox" id="f-other" name="f-others-textbox" placeholder="Please specify" value="<?= isset($_GET['father_education_textbox']) ? $_GET['father_education_textbox'] : "" ?>" <?= isset($_GET['father_education']) ? $_GET['father_education'] === "Others" ? "" : "disabled" : "disabled" ?>>
            </div>
          </div>
          <div class="col-md-4 ">
            <span class="d-block mb-2">Highest Educational Attainment</span>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="m-elementary-graduate" name="m-highest-education" value="Elementary Graduate" <?= isset($_GET['mother_education']) ? ($_GET['mother_education'] === "Elementary Graduate") ? "checked" : "" : "checked" ?> required>
              <label class="form-check-label" for="m-elementary-graduate">Elementary Graduate</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="m-highschool-graduate" name="m-highest-education" value="Highschool Graduate" <?= isset($_GET['mother_education']) ? ($_GET['mother_education'] === "Highschool Graduate") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="m-highschool-graduate">Highschool Graduate</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="m-college-graduate" name="m-highest-education" value="College Graduate" <?= isset($_GET['mother_education']) ? ($_GET['mother_education'] === "College Graduate") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="m-college-graduate">College Graduate</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="m-vocational" name="m-highest-education" value="Vocational" <?= isset($_GET['mother_education']) ? ($_GET['mother_education'] === "Vocational") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="m-vocational">Vocational</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="m-master-degree" name="m-highest-education" value="Master's Doctorate Degree" <?= isset($_GET['mother_education']) ? ($_GET['mother_education'] === "Master's Doctorate Degree") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="m-master-degree">Master's Doctorate Degree</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="m-not-attend-school" name="m-highest-education" value="Did not attend school" <?= isset($_GET['mother_education']) ? ($_GET['mother_education'] === "Did not attend school") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="m-not-attend-school">Did not attend school</label>
            </div>
            <div class="form-check mb-3">
            <input type="radio" class="form-check-input other-education-radio education-radio" id="m-others" name="m-highest-education" value="Others"  <?= isset($_GET['mother_education']) ? ($_GET['mother_education'] === "Others") ? "checked" : "" : ""  ?> required>
              <label class="form-check-label" for="m-others">Others</label>
              <input type="<?= isset($_GET['mother_education']) ? $_GET['mother_education'] === "Others" ? "text" : "hidden" : "hidden" ?>" class="form-control other-education-textbox" id="m-other" name="m-others-textbox" placeholder="Please specify" value="<?= isset($_GET['mother_education_textbox']) ? $_GET['mother_education_textbox'] : "" ?>" <?= isset($_GET['mother_education']) ? $_GET['mother_education'] === "Others" ? "" : "disabled" : "disabled" ?>>
            </div>
          </div>
          <div class="col-md-4">
            <span class="d-block mb-2">Highest Educational Attainment</span>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="g-elementary-graduate" name="g-highest-education" value="Elementary Graduate" <?= isset($_GET['guardian_education']) ? ($_GET['guardian_education'] === "Elementary Graduate") ? "checked" : "" : "checked" ?> required>
              <label class="form-check-label" for="g-elementary-graduate">Elementary Graduate</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="g-highschool-graduate" name="g-highest-education" value="Highschool Graduate" <?= isset($_GET['guardian_education']) ? ($_GET['guardian_education'] === "Highschool Graduate") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="g-highschool-graduate">Highschool Graduate</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="g-college-graduate" name="g-highest-education" value="College Graduate" <?= isset($_GET['guardian_education']) ? ($_GET['guardian_education'] === "College Graduate") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="g-college-graduate">College Graduate</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="g-vocational" name="g-highest-education" value="Vocational" <?= isset($_GET['guardian_education']) ? ($_GET['guardian_education'] === "Vocational") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="g-vocational">Vocational</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="g-master-degree" name="g-highest-education" value="Master's Doctorate Degree" <?= isset($_GET['guardian_education']) ? ($_GET['guardian_education'] === "Master's Doctorate Degree") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="g-master-degree">Master's Doctorate Degree</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input education-radio" id="g-not-attend-school" name="g-highest-education" value="Did not attend school" <?= isset($_GET['guardian_education']) ? ($_GET['guardian_education'] === "Did not attend school") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="g-not-attend-school">Did not attend school</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input other-education-radio education-radio" id="g-others" name="g-highest-education" value="Others"  <?= isset($_GET['guardian_education']) ? ($_GET['guardian_education'] === "Others") ? "checked" : "" : ""  ?> required>
              <label class="form-check-label" for="g-others">Others</label>
              <input type="<?= isset($_GET['guardian_education']) ? $_GET['guardian_education'] === "Others" ? "text" : "hidden" : "hidden" ?>" class="form-control other-education-textbox" id="g-other" name="g-others-textbox" placeholder="Please specify" value="<?= isset($_GET['guardian_education_textbox']) ? $_GET['guardian_education_textbox'] : "" ?>" <?= isset($_GET['guardian_education']) ? $_GET['guardian_education'] === "Others" ? "" : "disabled" : "disabled" ?>>
            </div>
          </div>
        </div>
        <div class="row g-3 p-3">
          <div class="col-md-4 ">
            <span class="d-block mb-2">Employment Status</span>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="f-fulltime" name="f-employment-status" value="Full-time" <?= isset($_GET['father_employment']) ? ($_GET['father_employment'] === "Full-time") ? "checked" : "" : "checked" ?> required>
              <label class="form-check-label" for="f-fulltime">Full time</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="f-parttime" name="f-employment-status" value="Part-time" <?= isset($_GET['father_employment']) ? ($_GET['father_employment'] === "Part-time") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="f-parttime">Part time</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="f-selfemployed" name="f-employment-status" value="Self-employed"  <?= isset($_GET['father_employment']) ? ($_GET['father_employment'] === "Self-employed") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="f-selfemployed">Self-employed (i.e family business)</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="f-unemployed" name="f-employment-status" value="Unemployed" <?= isset($_GET['father_employment']) ? ($_GET['father_employment'] === "Unemployed") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="f-unemployed">Unemployed due to community quarantine</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="f-notworking" name="f-employment-status" value="Not Working" <?= isset($_GET['father_employment']) ? ($_GET['father_employment'] === "Not Working") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="f-notworking">Not working</label>
            </div>
          </div>

          <div class="col-md-4 ">
            <span class="d-block mb-2">Employment Status</span>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="m-fulltime" name="m-employment-status" value="Full-time" <?= isset($_GET['mother_employment']) ? ($_GET['mother_employment'] === "Full-time") ? "checked" : "" : "checked" ?> required>
              <label class="form-check-label" for="m-fulltime">Full time</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="m-parttime" name="m-employment-status" value="Part-time" <?= isset($_GET['mother_employment']) ? ($_GET['mother_employment'] === "Part-time") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="m-parttime">Part time</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="m-selfemployed" name="m-employment-status" value="Self-employed" <?= isset($_GET['mother_employment']) ? ($_GET['mother_employment'] === "Self-employed") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="m-selfemployed">Self-employed (i.e family business)</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="m-unemployed" name="m-employment-status" value="Unemployed" <?= isset($_GET['mother_employment']) ? ($_GET['mother_employment'] === "Unemployed") ? "checked" : "" : "" ?>  required>
              <label class="form-check-label" for="m-unemployed">Unemployed due to community quarantine</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="m-notworking" name="m-employment-status" value="Not Working" <?= isset($_GET['mother_employment']) ? ($_GET['mother_employment'] === "Not Working") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="m-notworking">Not working</label>
            </div>
          </div>

          <div class="col-md-4 ">
            <span class="d-block mb-2">Employment Status</span>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="g-fulltime" name="g-employment-status" value="Full-time" <?= isset($_GET['guardian_employment']) ? ($_GET['guardian_employment'] === "Full-time") ? "checked" : "" : "checked" ?>  required>
              <label class="form-check-label" for="g-fulltime">Full time</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="g-parttime" name="g-employment-status" value="Part-time" <?= isset($_GET['guardian_employment']) ? ($_GET['guardian_employment'] === "Part-time") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="g-parttime">Part time</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="g-selfemployed" name="g-employment-status" value="Self-employed" <?= isset($_GET['guardian_employment']) ? ($_GET['guardian_employment'] === "Self-employed") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="g-selfemployed">Self-employed (i.e family business)</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="g-unemployed" name="g-employment-status" value="Unemployed" <?= isset($_GET['guardian_employment']) ? ($_GET['guardian_employment'] === "Unemployed") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="g-unemployed">Unemployed due to community quarantine</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="g-notworking" name="g-employment-status" value="Not Working" <?= isset($_GET['guardian_employment']) ? ($_GET['guardian_employment'] === "Not Working") ? "checked" : "" : "" ?> required>
              <label class="form-check-label" for="g-notworking">Not working</label>
            </div>
          </div>
        </div>
        <div class="row g-3 p-3">
          <div class="col-md-4 ">
            <span class="d-block mb-2">Cellphone/Telephone Number</span>
              <input type="text" class="form-control" id="f-contact" name="f-contact-number" placeholder="Enter contact e.g., 09123456789" value="<?= isset($_GET['father_contact']) ? $_GET['father_contact'] : "" ?>" required>
          </div>
          <div class="col-md-4 ">
            <span class="d-block mb-2">Cellphone/Telephone Number</span>
              <input type="text" class="form-control" id="m-contact" name="m-contact-number" placeholder="Enter contact e.g., 09123456789" value="<?= isset($_GET['mother_contact']) ? $_GET['mother_contact'] : "" ?>" required>
          </div>
          <div class="col-md-4 ">
            <span class="d-block mb-2">Cellphone/Telephone Number</span>
              <input type="text" class="form-control" id="g-contact" name="g-contact-number" placeholder="Enter contact e.g., 09123456789" value="<?= isset($_GET['guardian_contact']) ? $_GET['guardian_contact'] : "" ?>" required>
          </div>
        </div>
        <div class="row g-3 p-3">
          <div class="col-md-4">
            <span class="d-block mb-2">Is your family member beneficiary of 4p's?</span>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="yes_beneficiary" name="is-beneficiary" value="1" checked required>
              <label class="form-check-label" for="yes_beneficiary">Yes</label>
            </div>
            <div class="form-check mb-3">
              <input type="radio" class="form-check-input" id="no_beneficiary" name="is-beneficiary" value="0" required>
              <label class="form-check-label" for="no_beneficiary">No</label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex">
      <input class="btn btn-primary mt-2 ms-auto" type="submit" value="Enroll Learner" name="enroll">
    </div>

</form>

<script src="js/form_validation.js"></script>
<script src="js/enrollment_form.js"></script>