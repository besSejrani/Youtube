<?php

namespace App\Upload;

use App\Model\Mysql;

class Video
{

    public static function insertVideo(string $title, string $description, string $privacy, string $filePath, string $uploadedBy)
    {

        $sql = "INSERT INTO youtube.video(title,description,privacy,filePath,uploadedBy)
                VALUES('$title', '$description', '$privacy', '$filePath', '$uploadedBy');";

        $db = new Mysql();
        return $db->executeQuery($sql);
    }

    public static function deleteTemporaryVideo($filePath)
    {
        if (!unlink($filePath)) {
            echo "Could not delete file\n";
            return false;
        }
        return true;
    }

    public static function getVideoId()
    {
        $sql = "SELECT LAST_INSERT_ID(id) from youtube.video order by LAST_INSERT_ID(id) desc limit 1;";
        $db = new Mysql();
        return $db->executeQuery($sql);
    }

    public static function updateDuration(string $duration, string $videoId)
    {

        $hours = floor($duration / 3600);
        $mins = floor(($duration - ($hours * 3600)) / 60);
        $seconds = floor($duration % 60);

        $hours = $hours < 1 ? "" : $hours . ":";
        $mins = $mins < 10 ? "0" . $mins . ":" : $mins . ":";
        $seconds = $seconds < 10 ? "0" . $seconds : $seconds;

        $duration = $hours . $mins . $seconds;

        $sql = "UPDATE youtube.video SET duration='$duration' WHERE id='$videoId';";
        $db = new Mysql();
        $db->executeQuery($sql);
    }
}