<?php

namespace App\models;

class Design
{
    public int $designId;
    public string $designName;
    public int $splitPercent;

    /**
     * @param int $designId
     * @param string $desigName
     * @param int $splitPercent
     */
    public function __construct(int $designId, string $designName, int $splitPercent)
    {
        $this->designId = $designId;
        $this->designName = $designName;
        $this->splitPercent = $splitPercent;
    }


}