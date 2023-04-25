<ul class="nav nav-tabs justify-content-center bg-white border-bottom">
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
    <a class="nav-link <?= $header === "/promotion" ? "active" : "" ?>" href="promotion.php">Promotion and retention</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/accounts" ? "active" : "" ?>" href="accounts.php">Accounts</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $header === "/operations" ? "active" : "" ?>" href="operations.php">Operations</a>
  </li>
</ul>