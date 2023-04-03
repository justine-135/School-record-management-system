<div class="modal fade" id="gradeLevelsModal" tabindex="-1" aria-labelledby="gradeLevelsModalLabel" aria-hidden="true">
    <form class="modal-dialog" action="./includes/operations.inc.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gradeLevelsModalLabel">Subjects</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Grade level</label>
                    <select class="form-select" id="grade-level" aria-label="Default select example" name="grade-lvl">
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
                    <label for="exampleInputPassword1" class="form-label">Section</label>
                    <input type="text" class="form-control" id="section" name="section">
                    <div id="emailHelp" class="form-text">Add section to this grade level.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="grade-level-submit">Submit</button>
            </div>
        </div>
    </form>
</div>