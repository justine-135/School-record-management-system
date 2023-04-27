<?php
namespace Views;

// include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/grade_levels.class.php';

class GradeLevelsView extends \Models\GradeLevels{
    public function initIndexSelect($section_params){
        $results = $this->indexSelect($section_params);
        foreach ($results as $row) { ?>
        <option value="<?= $row['section'] ?>"><?= $row['section'] ?></option>
            <?php
        }
    }
    public function initIndexSelectEnrollmentEdit($section_params){
        $results = $this->indexSelect($section_params);
        var_dump($results);
        foreach ($results as $row) { ?>
        <option value="<?= $row['section'] ?>" ><?= $row['section'] ?></option>
            <?php
        }
    }

    public function sectionLink($section_params){
        $rows = isset($_GET['row']) ? $_GET['row'] : '20';
        $page_no = isset($_GET['page_no']) ? $_GET['page_no'] : '1';
        $status = isset($_GET['status']) ? $_GET['status'] : 'active';
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $level = isset($_GET['level']) ? $_GET['level'] : "";
        $section = isset($_GET['section']) ? $_GET['section'] : "";
        $results = $this->indexSelect($section_params);
        foreach ($results as $row) { ?>
        <li>
            <a class="dropdown-item" href="?row=<?= $rows ?>&page_no=<?= $page_no ?>&status=<?= $status ?>&level=<?= $level ?>&section=<?= $row['section'] ?>&query=<?= $query ?>" ><?= $row['section'] ?></a>
        </li>
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