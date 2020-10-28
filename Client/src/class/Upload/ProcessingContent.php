<?php

namespace App\Upload;

class ProcessingContent
{
    private $data;
    public $title, $description, $privacy, $category, $uploadedBy;

    public function __construct(array $data, string $title, string $description, string $privacy, string $category, ?string $uploadedBy)
    {
        $this->data = $data;
        $this->title = $title;
        $this->description = $description;
        $this->privacy = $privacy;
        $this->category = $category;
        $this->uploadedBy = $uploadedBy;
    }

    public function getData()
    {
        return $this->data;
    }
}