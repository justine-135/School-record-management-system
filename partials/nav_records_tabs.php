<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= $view == 'masterlist' ? 'active' : '' ?>" aria-current="page" href="masterlist.php">Enrolled students</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $view == 'all_students' ? 'active' : '' ?>" href="students.php">All students</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  <?= $view == 'grading' ? 'active' : '' ?>" href="grading.php">Grading</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  <?= $view == 'promotion' ? 'active' : '' ?>" href="promotion.php">Promotion/Retention</a>
    </li>
    <?php if ($view === 'grading' || $view === 'promotion') { ?>
    <button type="button" class="btn text-primary ms-auto" id="subjects-toast-btn">Help ?</button>
    <?php } ?>
</ul>

<div class="toast-container position-fixed p-3">
  <div id="subjects-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">Help</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        <?php switch ($view) {
            case 'grading': ?>
            <p>Submit grades to each students in this page.</p>
            <hr>
            <span class="fw-semibold">Instruction:</span>
            <ol>
                <li>Locate the student shown below at the table.</li>
                <li>Click the 'Grade' button and a modal will appear in the screen.</li>
                <li>Modal will display the name, lrn, and class of the student.</li>
                <li>Input the grades from first (1st) to fourth (4th) quarter.</li>
                <li>Click the 'Review' button to compute the final average and show remarks of the inputted grade.</li>
            </ol>
            <hr>
            <span class="fw-semibold">Note:</span>
            <ul>
                <li>System only accepts number and decimal values from 65.00 up to 100.00.</li>
                <li>Input 'INC' if quarter grade is incomplete.</li>
                <li>System will display error on wrong input and will not submit grade.</li>
                <li>Teachers' with designated classes/advisories can only submit grade of student enrolled to the class.</li>
            </ul>
                <?php break;
            case 'promotion': ?>
            <p>Promote and retain student grade level in this page.</p>
            <hr>
            <span class="fw-semibold">Instruction:</span>
            <ol>
                <li>Select students by checking the box located at the first (1st) column of each rows.</li>
                <li>Promote students by selecting the 'Promote' option located at the right upmost part of the table.</li>
                <li>Retain students by selecting the 'Retain' option located at the said location of the select option.</li>
                <li>If students will transfer, select the 'Promote and transfer' option.</li>
                <li>Click the 'Submit' button to submit promote or retain students.</li>
            </ol>
            <hr>
            <span class="fw-semibold">Note:</span>
            <ul>
                <li>Kindergarten students are only valid for 'Promotion', and 'Promotion and transfer'.</li>
                <li>Students can only be promoted if remark is for 'Promotion'.</li>
                <li>Students can only be retained if remark is for 'Retention'.</li>
                <li>Otherwise, system will show error.</li>
                <li>Guidance can only access this page.</li>
            </ul>
                <?php break;
            
            default: ?>
            <p>Schedule grading period to this page.</p>
            <hr>
            <ol>
                <li>Click the 'Schedule' button to open modal.</li>
                <li>Select date of the starting period, and the end date of period.</li>
                <li>Submit grade.</li>
            </ol>
            <hr>
            <ul>
                <li>Schedules of grading periods are shown at a table.</li>
                <li>Author can delete sections.</li>
            </ul>
                <?php break;
        } ?>
    </div>
  </div>
</div>
