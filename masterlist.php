<?php include "partials/header.php"; ?>

<?php $header = "/masterlist"; ?>
<?php $view="masterlist"; ?>

<?php include "partials/nav.php"; ?>

<main class="container-fluid w-90 border mt-4 p-4 bg-white">
  <h4 class="">Masterlist</h4>
  <div class="border mt-3">
    <div>
      <div class="d-flex justify-content-between align-items-center pt-3 px-3 border-bottom">
        <h5>Enrolled</h5>
        <form class="input-group mb-3 w-25" action="">
            <input type="text" class="form-control" placeholder="Enter here" />
            <button
            class="btn btn-primary"
            id="button-addon2"
            type="submit"
            >
            Search
            </button>
        </form> 
      </div>
    </div>
    <div class="table-responsive">
      <?php include 'includes/student_view.inc.php'; ?>
    </div>
  </div>
</main>