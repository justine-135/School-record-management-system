<ul class="nav nav-pills justify-content-center bg-white border-bottom p-3">
  <li class="nav-item">
    <a class="nav-link <?= $header === "/" ? "active" : "" ?>" aria-current="page" href="index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/masterlist" || $header === "/student_informations" ? "active" : "" ?>" href="masterlist.php">Masterlist</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/enrollment" ? "active" : "" ?>" href="enrollment.php">Enrollment</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/grades" ? "active" : "" ?>" href="grades.php">Grades</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/teachers" ? "active" : "" ?>" href="teachers.php">Teachers</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/operations" ? "active" : "" ?>" href="operations.php">Operations</a>
  </li>
</ul>