<div class="modal fade" id="subjectsModal" tabindex="-1" aria-labelledby="subjectsModalLabel" aria-hidden="true">
    <form class="modal-dialog" action="./includes/operations.inc.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectsModalLabel">Subjects</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Grade level</label>
                    <select class="form-select grade-level-select-subject" id="grade-level" aria-label="Default select example" name="grade-lvl">
                        <option value="Kindergarten" selected>Kindergarten</option>
                        <option value="1">Grade 1</option>
                        <option value="2">Grade 2</option>
                        <option value="3">Grade 3</option>
                        <option value="4">Grade 4</option>
                        <option value="5">Grade 5</option>
                        <option value="6">Grade 6</option>
                    </select>
                    <div id="emailHelp" class="form-text">The students who will take the subject.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="subjects" placeholder="Enter subject name here ...">
                </div>
                <div class="mb-3 quarters-select">
                    <label for="exampleInputEmail1" class="form-label">Quarter</label>
                    <select class="form-select quarters-select" id="quarter" aria-label="Default select example" name="quarter">
                        <option value="1">1 quarter</option>
                        <option value="2">2 quarters</option>
                        <option value="3">3 quarters</option>
                        <option value="4">4 quarters</option>
                    </select>
                    <div id="emailHelp" class="form-text">Subject quarters.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="subjects-submit">Submit</button>
            </div>
        </div>
    </form>
</div>