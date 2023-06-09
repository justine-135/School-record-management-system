<!-- Modal -->
<div class="modal fade" id="enrollment-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="enrollment-modalLabel" aria-hidden="true">
  <form class="modal-dialog" action="../sabanges/includes/enrollment.inc.php" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="enrollment-modalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php 
        $id = $result[0]['student_id'];
        $lrn = $result[0]['lrn'];
        ?>
        <div class="mb-3">
          <label for="lrn-input" class="form-label">LRN</label>
          <input type="text" class="form-control" name="lrn" id="lrn-input" value="<?= $lrn ?>" hidden>
          <input type="text" class="form-control" name="lrn-display" id="lrn-input" value="<?= $lrn ?>" disabled>
          <input type="text" class="form-control" name="id" id="id" value="<?= $id ?>" hidden>
        </div>
        <div class="row mb-3">
          <div class="col">
            <label for="from-sy-input" class="form-label">From sy</label>
            <input type="text" class="form-control" id="from-sy-input" name="from-sy" placeholder="Enter start of school year">
          </div>
          <div class="col">
            <label for="to-sy-input" class="form-label">To sy</label>
            <input type="text" class="form-control" id="to-sy-input" name="to-sy" placeholder="Enter end of school year">
          </div>
        </div>
        <div class="mb-3">
          <label for="grade-lvl-select" class="form-label">Grade level</label>
            <select class="form-select grade-select" id="grade-level-select" aria-label="Default select example" name="grade-lvl">
              <option value="Kindergarten" selected>Kindergarten</option>
              <option value="1">Grade 1</option>
              <option value="2">Grade 2</option>
              <option value="3">Grade 3</option>
              <option value="4">Grade 4</option>
              <option value="5">Grade 5</option>
              <option value="6">Grade 6</option>
            </select>
        </div>
        <div class="mb-3">
          <label for="section-select" class="form-label">Section</label>
            <select class="form-select section-select" id="section-select" aria-label="Default select example" name="section"></select>
        </div>
        <!-- <div class="mb-3">
          <label for="status-select" class="form-label">Status</label>
            <select class="form-select" id="status-select" aria-label="Default select example" name="status">
              <option value="Retained">Retained</option>
              <option value="Completed" selected>Completed</option>
            </select>
        </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add-enrollment-history" class="btn btn-primary">Add</button>
      </div>
    </div>
  </form>
</div>