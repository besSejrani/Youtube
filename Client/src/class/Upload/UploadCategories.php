<?php

namespace App\Upload;

require (dirname(__DIR__, 3)) . "/vendor/autoload.php";

use App\Model\Mysql;

class UploadCategories
{
    public static function getCategories()
    {
        $sql = "SELECT * FROM youtube.category";
        $db = new Mysql();
        return $db->executeQuery($sql);
    }
}