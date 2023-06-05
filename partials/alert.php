<?php 

if (isset($_GET['edit_profile']) && isset($_GET['profile'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <?= isset($_GET['lrnexist']) ? 'LRN exists already.' : (isset($_GET['empty']) ? 'Fill up all input.' : (isset($_GET['sy']) ? 'Invalid school year.' : (isset($_GET['specialchars']) ? 'Text fields cannot contain special characters.' : (isset($_GET['lrnerr']) ? 'Invalid LRN.' : (isset($_GET['emailexist']) ? 'Email already taken.' : (isset($_GET['contact']) ? 'Invalid contact number.' : (isset($_GET['file']) ? 'Select valid file for upload.' : 'Successfully updated profile.')))))))?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}

if (isset($_GET['edit_account'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <?= isset($_GET['lrnexist']) ? 'LRN exists already.' : (isset($_GET['empty']) ? 'Fill up all input.' : (isset($_GET['sy']) ? 'Invalid school year.' : (isset($_GET['specialchars']) ? 'Text fields cannot contain special characters.' : (isset($_GET['pwdsame']) ? 'Passwords are not same.' : (isset($_GET['emailexist']) ? 'Email already taken.' : (isset($_GET['exist']) ? 'Username already taken.' : (isset($_GET['notfound']) ? 'Incorrect old password.' : 'Successfully updated account.')))))))?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}

if (isset($_GET['enrollment'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <?= isset($_GET['lrnexist']) ? 'LRN exists already.' : (isset($_GET['empty']) ? 'Fill up all input.' : (isset($_GET['sy']) ? 'Invalid school year.' : (isset($_GET['nameerr']) ? 'Text fields cannot contain special characters.' : (isset($_GET['lrnerr']) ? 'Invalid LRN.' : (isset($_GET['bdateerr']) ? 'Cannot enroll students below 5 years old.' : (isset($_GET['contacterr']) ? 'Invalid contact number.' : (isset($_GET['file']) ? 'Select valid file for upload.' : 'Successfully enrolled student.')))))))?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}

if (isset($_GET['edit_enrollment']) && isset($_GET['edit'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <?= isset($_GET['lrnexist']) ? 'LRN exists already.' : (isset($_GET['empty']) ? 'Fill up all input.' : (isset($_GET['sy']) ? 'Invalid school year.' : (isset($_GET['nameerr']) ? 'Text fields cannot contain special characters.' : (isset($_GET['lrnerr']) ? 'Invalid LRN.' : (isset($_GET['bdateerr']) ? 'Cannot enroll students below 5 years old.' : (isset($_GET['contacterr']) ? 'Invalid contact number.' : 'Successfully enrolled student.'))))))?>
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
    <?= isset($_GET['exist']) ? 'Student already enrolled to the year/grade level.' : (isset($_GET['empty']) ? 'Fill up all input.' : (isset($_GET['sy']) ? 'Invalid school year.' : (isset($_GET['level']) ? 'Invalid grade level.' : 'History submitted.')))?>
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
      <?= isset($_GET['exist']) ? 'Grades are already submitted.' : (isset($_GET['empty']) ? 'Fill up all grades input.' : (isset($_GET['unenrolled']) ? 'Student not enrolled to the grade level submitted.' : (isset($_GET['value']) ? 'Grades cannot be lower than 60, and higher than 100.' : (isset($_GET['characters']) ? 'Grades only accept number values.' : (isset($_GET['permission']) ? 'You are not permitted to submit grade to this student.' : (isset($_GET['schedule']) ? 'Grading period is closed.' : (isset($_GET['remark']) ? 'Review grade before submitting.' : 'Submitted grades for student ' . $_GET['lrn'] . '.')))))))?>
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
    <?= isset($_GET['contacterr']) ? 'Invalid contact number.' : (isset($_GET['empty']) ? 'Fill up all input.' : (isset($_GET['special']) ? 'Text fields cannot contain special characters.' : (isset($_GET['filetype']) ? 'Choose valid file type. e.g,(jpg, jpeg, png).' : (isset($_GET['passworderr']) ? 'Incorrect password.' : (isset($_GET['length']) ? 'Username or password minimum character is eight (8).' : (isset($_GET['exist']) ? 'Username or email is existing.' : 'Account added.'))))))?>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}

if (isset($_GET['login'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <?= isset($_GET['user']) ? 'Incorrect username or password.' : (isset($_GET['empty']) ? 'Fill up all input.' : (isset($_GET['status']) ? 'This account is marked inactive.' : ''))?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}
  

if (isset($_GET['returnee'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <?= isset($_GET['active']) ? 'Student is actively enrolled to the system.' : (isset($_GET['empty']) ? 'Fill up all input.' : (isset($_GET['lrn']) ? 'Invalid learners reference number.' : (isset($_GET['gradelevel']) ? 'Cannot enroll student to selected grade level.' : (isset($_GET['transferree']) ? 'Student is not a returnee student.' : ''))))?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}

if (isset($_GET['reset_password'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <?= isset($_GET['submitted']) ? 'Password is resetted for user #' . $_GET['acc'] : ''?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}

if (isset($_GET['update_status'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <?= isset($_GET['submitted']) ? 'Changed status for user #' . $_GET['acc'] . '.' : ''?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}

if (isset($_GET['operations'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <?= isset($_GET['exist']) ? 'Row already existing.' : (isset($_GET['value']) ? 'Cannot input special characters.' : 'Row successfully submited.')?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}

if (isset($_GET['promotion'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <!-- Button trigger modal -->
      Promoted selected students.
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}

if (isset($_GET['retention'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <!-- Button trigger modal -->
      Retained selected students.
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}

if (isset($_GET['account'])) {
  ?>
  <div class="alert alert-<?= isset($_GET['error']) ? 'danger' : (isset($_GET['submitted']) ? 'success' : '')  ?> d-flex align-items-center alert-dismissible fade show" role="alert">
  <?php require isset($_GET['error']) ? 'danger_icon.php' : (isset($_GET['submitted']) ? 'success_icon.php' : '') ?>
    <div>
      <?= isset($_GET['superadmin']) ? 'Cannot submit changes for this account.' : ''?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}