<?php
namespace Views;

class GradeLevelsView extends \Models\GradeLevels{
    public function initIndexSelect($section_params){
        $results = $this->indexSelect($section_params);
        foreach ($results as $row) { ?>
        <option value="<?= $row['section'] ?>" ><?= $row['section'] ?></option>
            <?php
        }
    }

    public function initIndex(){
        $results = $this->index();
        ?>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Added at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Grade level</th>
                <th scope="col">Section</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($results as $row) {
        ?>
            <tr>
                <th scope="row"><?= $row['id'] ?></th>
                <td><?= $row['added_at'] ?></td>
                <td><?= $row['updated_at'] ?></td>
                <td><?= $row['grade'] ?></td>
                <td><?= $row['section'] ?></td>
                <td>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger">Delete </button>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
        <?php
    }
}