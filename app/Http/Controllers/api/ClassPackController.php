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
        return response()->json([
            'data' => $this->classPackRepository->getAllClassPacks()
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'data' => $this->classPackRepository->getClassPackByID($id)
        ]);
    }
}
