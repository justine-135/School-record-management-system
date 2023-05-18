<div class="modal fade" id="subjectsModal" tabindex="-1" aria-labelledby="subjectsModalLabel" aria-hidden="true">
    <form class="modal-dialog" action="./includes/operations.inc.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectsModalLabel">Subjects</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <label for="exampleInputPassword1" class="form-label">Grade level</label>
                        <!-- <button class="btn btn-primary ms-auto add-grade-level" type="button">Add</button> -->
                    </div>
                    <div class="grade-level-list">
                        <select class="form-select grade-level-select-subject" id="grade-level" aria-label="Default select example" name="grade-lvl">
                            <!-- <option value="Kindergarten" selected>Kindergarten</option> -->
                            <option value="1">Grade 1</option>
                            <option value="2">Grade 2</option>
                            <option value="3">Grade 3</option>
                            <option value="4">Grade 4</option>
                            <option value="5">Grade 5</option>
                            <option value="6">Grade 6</option>
                        </select>
                    </div>
                    <div id="emailHelp" class="form-text">The students who will take the subject.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="subjects" placeholder="Enter subject name here ...">
                </div>
                <div class="mb-3 quarters-select">
                    <label for="exampleInputEmail1" class="form-label">Subject quarter availability</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="quarter1" id="quarter1" checked>
                        <label class="form-check-label" for="quarter1">
                            Quarter 1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="quarter2" id="quarter2" checked>
                        <label class="form-check-label" for="quarter2">
                            Quarter 2
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="quarter3" id="quarter3" checked>
                        <label class="form-check-label" for="quarter3">
                            Quarter 3
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="quarter4" id="quarter4" checked>
                        <label class="form-check-label" for="quarter4">
                            Quarter 4
                        </label>
                    </div>
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