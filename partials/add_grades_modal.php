<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-fullscreen modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Modal 1</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="">
        <table class="table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>1st quarter</th>
                    <th>2nd quarter</th>
                    <th>3rd quarter</th>
                    <th>4th quarter</th>
                    <th>Average</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Science</td>
                    <td><input type="text" name="" id=""></td>
                    <td><input type="text" name="" id=""></td>
                    <td><input type="text" name="" id=""></td>
                    <td><input type="text" name="" id=""></td>
                    <td><input type="text" name="" id="" disabled></td>
                </tr>
                <tr>
                    <td>Science</td>
                    <td><input type="text" name="" id=""></td>
                    <td><input type="text" name="" id=""></td>
                    <td><input type="text" name="" id=""></td>
                    <td><input type="text" name="" id=""></td>
                    <td><input type="text" name="" id="" disabled></td>
                </tr>
                
            </tbody>
        </table>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Hide this modal and show the first with the button below.
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button>
      </div>
    </div>
  </div>
</div>
