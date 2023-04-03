<div class="modal fade" id="subjectsModal" tabindex="-1" aria-labelledby="subjectsModalLabel" aria-hidden="true">
    <form class="modal-dialog" action="./includes/operations.inc.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectsModalLabel">Subjects</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="subjects">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Grade level</label>
                    <select class="form-select grade-level-select" id="grade-level" aria-label="Default select example" name="grade-lvl">
                        <option value="Kindergarten">Kindergarten</option>
                    </select>
                    <div id="emailHelp" class="form-text">The students who will take the subject.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="subjects-submit">Submit</button>
            </div>
        </div>
    </form>
</div>