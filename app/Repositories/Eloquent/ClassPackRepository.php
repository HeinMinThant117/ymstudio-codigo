<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ClassPackRepositoryInterface;
use App\Models\ClassPack;

class ClassPackRepository implements ClassPackRepositoryInterface
{
    public function getAllClassPacks()
    {
        return ClassPack::all()->makeHidden(['created_at', 'updated_at']);
    }

    public function getClassPackByID($classpackID)
    {
        return ClassPack::where('pack_id', $classpackID)->first()->makeHidden(['created_at', 'updated_at']);
    }
}
