<ul class="nav nav-tabs justify-content-center bg-white border-bottom">
  <li class="nav-item">
    <a class="nav-link <?= $header === "/" ? "active" : "" ?>" aria-current="page" href="index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/masterlist" || $header === "/all_students" || $header === "/student_informations" || $header === "/grading" || $header === "/promotion" ? "active" : "" ?>" href="masterlist.php">Records</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/enrollment" ? "active" : "" ?>" href="enrollment.php">Enrollment</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/accounts" ? "active" : "" ?>" href="accounts.php">Accounts</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/operations_subjects" ? "active" : "" ?>" href="operations_subjects.php">Operations</a>
  </li>
</ul>