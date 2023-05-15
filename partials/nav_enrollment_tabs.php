<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= $view == 'enrollment' ? 'active' : '' ?>" aria-current="page" href="enrollment.php">New student</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $view == 'batch_enrollment' ? 'active' : '' ?>" href="batch_enrollment.php">Batch enrollment</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  <?= $view == 'returnee' ? 'active' : '' ?>" href="returnee.php">Returnee student</a>
    </li>
</ul>