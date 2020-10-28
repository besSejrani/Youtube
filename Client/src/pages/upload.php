<?php

require (dirname(__DIR__, 2)) . "/vendor/autoload.php";

use App\Form\Form;
use App\Upload\UploadCategories;

ob_start();
$title = "Upload | Youtube";
?>

<div class="column">
    <?php
    $categoryOptions = UploadCategories::getCategories();

    $visibilityOptions = [
        "0" => ["id" => '1', 0 => "1", "name" => "public", 1 => "public"],
        "1" => ["id" => '2', 0 => "2", "name" => "private", 1 => "private"]
    ];

    $form = new Form();
    $form->startForm("/processing", "POST", "multipart/form-data")
        ->myFile("File", "myFile")
        ->myInput("text", "Title", "myTitle", null)
        ->myTextArea("Description", "myDescription", 5)
        ->myDropDown("Visibility", "myVisibility", $visibilityOptions)
        ->myDropDown("Categories", "myOptions", $categoryOptions)
        ->mySubmit("myButton")
        ->endForm();
    ?>

</div>

<!-- Modal -->
<div class="modal fade" id="loadingModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="loadingModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content d-flex">
            <div class="modal-body justify-center align-center">
                <h2>
                    Please wait. This might take a while
                </h2>
                <img src="static/assets/loading-spinner.gif" alt="loadings pinner">
            </div>
        </div>
    </div>
</div>


<?php
$js = '
<script>$("form").submit(()=>{
    $("#loadingModal").modal("show");
})
</script>';

$content = ob_get_clean();
require dirname(__DIR__) . "/layout/layout.php";