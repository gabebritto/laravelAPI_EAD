<?php

namespace App\Http\Controllers\Api;

use App\Repositories\SupportRepository;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupportResource;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $lessonRepository)
    {
        $this->repository = $lessonRepository;
    }

    public function index(Request $request)
    {
        return SupportResource::collection($this->repository->getSupports($request->all()));
    }

}