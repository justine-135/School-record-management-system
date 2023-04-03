<?php
namespace Views;

class SubjectsView extends \Models\Subjects{
    public function initIndex(){
        $results = $this->index();
        ?>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Added at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Subjects</th>
                <th scope="col">Grade level</th>
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
                <td><?= $row['subject'] ?></td>
                <td><?= $row['grade_level'] ?></td>
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