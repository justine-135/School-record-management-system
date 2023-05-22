<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= $view == 'masterlist' ? 'active' : '' ?>" aria-current="page" href="masterlist.php">Masterlist</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $view == 'all_students' ? 'active' : '' ?>" href="students.php">Student records</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  <?= $view == 'grading' ? 'active' : '' ?>" href="grading.php">Grading</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  <?= $view == 'promotion' ? 'active' : '' ?>" href="promotion.php">Promotion and retention</a>
    </li>
</ul>