<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <form class="modal-dialog" action="./includes/operations.inc.php" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">Subjects</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-1">
                        <label class="fw-semibold" for="exampleInputPassword1" class="form-label">Start of period</label>
                    </div>
                    <input class="form-control" type="date" name="start" id="">
                </div>
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-1">
                        <label class="fw-semibold" for="exampleInputPassword1" class="form-label">End of period</label>
                    </div>
                    <input class="form-control" type="date" name="end" id="">
                    <div id="emailHelp" class="form-text">Start and end date of grading period.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="schedule-submit">Submit</button>
            </div>
        </div>
    </form>
</div>