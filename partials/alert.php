<?php 

if (isset($_GET['enrolled'])) {
  ?>
<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
    <?php require 'success_icon.php' ?>
  <div>
    Successfully enrolled a learner.
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}

if (isset($_GET['err'])) {
?>
<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
<?php require 'danger_icon.php' ?>
  <div>
    Learner not enrolled.
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}

if (isset($_GET['history'])) {
?>
<div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
<?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
  <div>
    <?= isset($_GET['exist']) ? 'Student already enrolled to the year/grade level.' : (isset($_GET['empty']) ? 'Fil up all input.' : (isset($_GET['sy']) ? 'Invalid school year.' : (isset($_GET['level']) ? 'Invalid grade level.' : 'History submitted.')))?>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}

if (isset($_GET['grades'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <?= isset($_GET['exist']) ? 'Grades are already submitted.' : (isset($_GET['empty']) ? 'Fil up all grades input.' : (isset($_GET['unenrolled']) ? 'Student not enrolled to the grade level submitted.' : 'Grades submitted.'))?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
  }
  
if (isset($_GET['register'])) {
?>
<div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
<?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
  <div>
    <?= isset($_GET['contacterr']) ? 'Invalid contact number.' : (isset($_GET['empty']) ? 'Fil up all input.' : (isset($_GET['special']) ? 'Text fields cannot contain special characters.' : (isset($_GET['filetype']) ? 'Choose valid file type. e.g,(jpg, jpeg, png).' : (isset($_GET['passworderr']) ? 'Incorrect password.' : (isset($_GET['length']) ? 'Username or password minimum character is eight (8).' : (isset($_GET['exist']) ? 'Username or email is existing.' : 'History submitted.'))))))?>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}