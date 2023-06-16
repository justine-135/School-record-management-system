<?php
namespace Views;

// include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/schedule.class.php';

class ScheduleView extends \Models\Schedule{
    public function initIndex(){
        $results = $this->index();
        ?>
        <table class="table table-hover border mb-0 mt-2 sections-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Start of period</th>
                    <th scope="col">End of period</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            foreach ($results as $row) {
                $i++;
            ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $row['from'] ?></td>
                    <td><?= $row['to'] ?></td>
                    <td>
                        <form action="./includes/operations.inc.php" method="post" enctype="multipart/form-data">
                            <input type="text" name="id" value="<?= $row['id'] ?>" id="" hidden>
                            <button type="submit" name="delete-schedule" class="btn btn-danger">Delete </button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
}