<?php

namespace App\Repositories;

use App\Interfaces\ClassPackRepositoryInterface;
use App\Models\ClassPack;

class ClassPackRepository implements ClassPackRepositoryInterface
{
    public function getAllClassPacks()
    {
        return ClassPack::all();
    }

    public function getClassPackByID($classpackID)
    {
        return ClassPack::findOrFail($classpackID);
    }
}
