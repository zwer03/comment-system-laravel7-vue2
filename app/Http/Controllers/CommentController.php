<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\StoreCommentRequest;
use App\Interfaces\CommentRepositoryInterface;

class CommentController extends Controller
{
    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(StoreCommentRequest $request)
    {
        return response()->json(
            $this->commentRepository->create($request->all()),
            Response::HTTP_CREATED
        );
    }

    public function index()
    {
        return response()->json(
            $this->commentRepository->getAll(),
            Response::HTTP_OK
        );
    }
}
