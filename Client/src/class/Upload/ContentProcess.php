<?php

namespace App\Upload;

use App\Model\Mysql;

class ContentProcess
{

    private $sizeLimitBytes = 500000000;
    private $allowedTypes = ["mp4", "flv", "webm", "mkv", "vob", "ogv", 'ogg', "avi", "wmv", 'mov', "mpeg", 'mpg'];
    private $ffmpeg = "/usr/bin/ffmpeg";
    private $ffprobe = "/usr/bin/ffprobe";

    public function upload(ProcessingContent $contentData)
    {
        $targetDir = "static/uploads/videos/";
        $videoData = $contentData->getData();
        $tempPathFile = $targetDir . uniqid() . basename($videoData['name']);
        $tempPathFile = str_replace(" ", "_", $tempPathFile);
        $isValidData = $this->processData($videoData, $tempPathFile);

        if (!$isValidData) {
            return false;
        }

        if (move_uploaded_file($videoData["tmp_name"], $tempPathFile)) {

            $finalFilePath = $targetDir . uniqid() . ".mp4";
            if ($this->insertVideoData($contentData, $finalFilePath)) {
                echo "insert query failed";
                return false;
            };

            if (!$this->convertVideoToMp4($tempPathFile, $finalFilePath)) {
                echo "Upload failed";
                return false;
            }

            if (!Video::deleteTemporaryVideo($tempPathFile)) {
                echo "Upload failed";
                return false;
            }

            if (!$this->generateThumbnails($finalFilePath)) {
                echo "Could not generate thumbnail";
                return false;
            }

            return true;
        }
    }

    private function processData($videoData, $filePath)
    {
        $videoType = pathInfo($filePath, PATHINFO_EXTENSION);

        if (!$this->isValidSize($videoData)) {
            echo "File too large. Can't be more than " . $this->sizeLimitBytes . " bytes ";
            return false;
        } else if (!$this->isValidType($videoType)) {
            echo "invalid file type";
            return false;
        } else if ($this->hasError($videoData)) {
            echo "Error code: " . $videoData['error'];
            return false;
        }
        return true;
    }

    private function isValidSize($data)
    {
        return $data["size"] <= $this->sizeLimitBytes;
    }

    private function isValidType($type)
    {
        $lowercase = strtolower($type);
        return in_array($lowercase, $this->allowedTypes);
    }

    private function hasError($data)
    {
        return $data['error'] != 0;
    }

    private function insertVideoData($data, $filePath)
    {
        Video::insertVideo(
            $data->title,
            $data->description,
            $data->privacy,
            $filePath,
            $data->uploadedBy
        );
    }

    public function convertVideoToMp4($tempPathFile, $finalFilePath)
    {
        $cmd = "$this->ffmpeg -i $tempPathFile $finalFilePath 2>&1";
        $outputLog = array();
        exec($cmd, $outputLog, $returnCode);

        if ($returnCode != 0) {
            foreach ($outputLog as $line) {
                echo $line . "<br>";
            }
            return false;
        }

        return true;
    }



    public function generateThumbnails($filePath)
    {
        $thumbnailSize = "210x118";
        $numThumbnails = 3;
        $pathToThumbnail = "static/uploads/videos/thumbnails";

        $duration = $this->getDuration($filePath);
        $videoId = Video::getVideoId();
        $videoId = $videoId[0][0];



        Video::updateDuration($duration, $videoId);

        for ($num = 1; $num <= $numThumbnails; $num++) {
            $imageName = uniqid() . ".jpg";
            $interval = ($duration * 0.8) / $numThumbnails * $num;
            $fullThumbnailPath = "$pathToThumbnail/$videoId-$imageName";

            $cmd = "$this->ffmpeg -i $filePath -ss $interval -s $thumbnailSize -vframes 1 $fullThumbnailPath 2>&1";
            $outputLog = array();
            exec($cmd, $outputLog, $returnCode);

            if ($returnCode != 0) {
                foreach ($outputLog as $line) {
                    echo $line . "<br>";
                }
            }
            $selected = $num == 1 ? 1 : 0;

            $sql = "INSERT INTO youtube.thumbnail(videoId, filePath, selected)
                    VALUES('$videoId', '$fullThumbnailPath', '$selected');";

            $db = new Mysql();
            $db->executeQuery($sql);
        }
        return true;
    }

    private function getDuration($filePath)
    {
        return (int)shell_exec("$this->ffprobe -v error -select_streams v:0 -show_entries stream=duration -of default=noprint_wrappers=1:nokey=1 $filePath");
    }
}