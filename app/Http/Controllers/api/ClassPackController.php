<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ClassPackRepositoryInterface;
use Illuminate\Http\Request;

class ClassPackController extends Controller
{
    private ClassPackRepositoryInterface $classPackRepository;

    public function __construct(ClassPackRepositoryInterface $classPackRepository)
    {
        $this->classPackRepository = $classPackRepository;
    }

    public function index()
    {

        $classPacks = $this->classPackRepository->getAllClassPacks();

        return response()->json([
            'errorCode' => 0,
            'message' => 'Success',
            'data' => [
                'total_item' => count($classPacks),
                'total_page' => 1,
                'mem_tier' => 'newbie',
                'total_expired_class' => 0,
                'pack_list' => $this->classPackRepository->getAllClassPacks()
            ]
        ]);
    }

    public function show($id)
    {

        return response()->json([
            'data' => $this->classPackRepository->getClassPackByID($id)
        ]);
    }
}
