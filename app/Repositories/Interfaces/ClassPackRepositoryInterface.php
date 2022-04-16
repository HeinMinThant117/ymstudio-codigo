<?php


namespace App\Repositories\Interfaces;

interface ClassPackRepositoryInterface
{
    public function getAllClassPacks();
    public function getClassPackByID($classpackID);
}
