<?php include "partials/header.php"; ?>

<?php $header = "/operations"; ?>

<?php include "partials/nav.php"; ?>

<main class="container-fluid w-90 border mt-4 p-4 bg-white operations">
    <h4 class="">Operations</h4>
    <!-- Modal -->
    <?php include './partials/subjects_modal.php'; ?>
    <?php include './partials/sections_modal.php'; ?>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                Subjects
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" >
                <div class="accordion-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6>List of all subjects</h6>
                        <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#subjectsModal">
                        Add
                        <?php require './partials/add_icon.php' ?>
                        </button>                
                    </div>
                    <table class="table table-hover border mb-0 mt-3 sections-table"></table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Sections
            </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
                <div class="accordion-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6>List of all sections</h6>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#gradeLevelsModal">
                            Add
                            <?php require './partials/add_icon.php' ?>
                        </button>   
                    </div>
                    <table class="table table-hover border mb-0 mt-3 grade-level-table"></table>
                </div>
            </div>
        </div>
        </div>
</main>

<script src="js/operations.js"></script>