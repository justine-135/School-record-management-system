<ul class="nav nav-tabs d-flex">
    <li class="nav-item">
        <a class="nav-link <?= $view == 'operations_subjects' ? 'active' : '' ?>" aria-current="page" href="operations_subjects.php">Subjects</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $view == 'operations_sections' ? 'active' : '' ?>" href="operations_sections.php">Sections</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  <?= $view == 'operations_grading' ? 'active' : '' ?>" href="operations_grading.php">Grading</a>
    </li>
    <button type="button" class="btn text-primary ms-auto" id="subjects-toast-btn">Help ?</button>
</ul>

<div class="toast-container position-fixed p-3">
  <div id="subjects-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">Help</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        <?php switch ($view) {
            case 'operations_subjects': ?>
            <p>Insert subjects in this page.</p>
            <hr>
            <ol>
                <li>Click the 'Add' button to open modal.</li>
                <li>Select grade level who will take the subject.</li>
                <li>Enter subject name.</li>
                <li>Select quarter availability of the subject. Teachers are able to input grades to the selected quarter.</li>
                <li>Submit grade.</li>
            </ol>
            <hr>
            <ul>
                <li>Subjects ar show at a table.</li>
                <li>Author can delete subjects.</li>
            </ul>
                <?php break;
            case 'operations_sections': ?>
            <p>Insert sections to grade levels in this page.</p>
            <hr>
            <ol>
                <li>Click the 'Add' button to open modal.</li>
                <li>Select grade level.</li>
                <li>Enter section name to be added to the selected grade level.</li>
                <li>Submit grade.</li>
            </ol>
            <hr>
            <ul>
                <li>Grade levels and sections are shown at a table.</li>
                <li>Author can delete sections.</li>
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

<script src="js/operations.js"></script>