<form action="./includes/grades.inc.php" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Grade learner</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="d-flex justify-content-between w-50">
            <div class="">
              <label class="form-check-label" for="lrn">Learner reference number</label>
              <input class="form-control" type="text" name="lrn" value="<?= $result[0]['lrn'] ?>" id="lrn" readonly>
              <input class="form-control" type="text" name="id" value="<?= $_GET['id'] ?>" id="lrn" hidden>
            </div>
            <div>
              <label class="form-check-label" for="current-grade-lvl">Grade level</label>
              <input class="form-control" type="text" name="current-grade-level" value="<?= $result[0]['grade_level'] ?>" id="current-grade-level" readonly>
            </div>
            <div>
              <label class="form-check-label" for="section">Section</label>
              <input class="form-control" type="text" name="section" value="<?= $result[0]['section'] ?>" id="section" readonly>
            </div>
          </div>
          <select class="form-select mt-2 add-grade-select" name="grade-lvl" id="grade-lvl">
            <option value="Kindergarten" selected disabled>Select grade level ---</option>
            <option value="Kindergarten">Kindergarten</option>
            <option value="1">Grade 1</option>
            <option value="2">Grade 2</option>
            <option value="3">Grade 3</option>
            <option value="4">Grade 4</option>
            <option value="5">Grade 5</option>
            <option value="6">Grade 6</option>
          </select>
          <table class="table add-grade-table border border-top-0"></table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit" name="submit-grade" value="submit">Submit</button>
        </div>
      </div>
    </div>
  </div>
</form>

