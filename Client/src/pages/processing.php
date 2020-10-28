<?php

require (dirname(__DIR__, 2)) . "/vendor/autoload.php";

use App\Upload\ProcessingContent;
use App\Upload\ContentProcess;

$title = "Processing | Youtube";
?>

<h1>Processing</h1>

<?php

if (!isset($_POST['myButton'])) {
    echo "no file was sent to the page";
    exit();
}

$upload = new ProcessingContent(
    $_FILES['File'],
    $_POST['Title'],
    $_POST['Description'],
    $_POST['Visibility'],
    $_POST['Categories'],
    "REPLACETHIS"
);

$contentProcess = new ContentProcess();
$wasSuccessful = $contentProcess->upload($upload);

if ($wasSuccessful) {
    echo "Upload successful";
}
?>


<?php
$js = '';
?>