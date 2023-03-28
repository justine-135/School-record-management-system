<ul class="nav nav-pills justify-content-center bg-white border-bottom p-3">
  <li class="nav-item">
    <a class="nav-link <?= $header === "/" ? "active" : "" ?>" aria-current="page" href="index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/masterlist" ? "active" : "" ?>" href="masterlist.php">Masterlist</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/enrollment" ? "active" : "" ?>" href="enrollment.php">Enrollment</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/teachers" ? "active" : "" ?>" href="teachers.php">Teachers</a>
  </li>
</ul>