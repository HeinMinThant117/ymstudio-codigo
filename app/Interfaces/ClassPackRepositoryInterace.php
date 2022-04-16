<?php

namespace App\Interfaces;

interface ClassPackRepositoryInterface
{
    public function getAllClassPacks();
    public function getClassPackByID($classpackID);
}
