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

    /**
     * @OA\Post(
     ** path="/v1/comment",
     *   tags={"Post Comment"},
     *   summary="Store/Add comment",
     *   operationId="PostComment",
     *
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="comment",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Created",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Page Not found"
     *   ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content"
     *      )
     *)
     **/
    public function store(StoreCommentRequest $request)
    {
        return response()->json(
            $this->commentRepository->create($request->validated()),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Get(
     ** path="/v1/comment",
     *   tags={"Fetch Comments"},
     *   summary="Get list of comments",
     *   operationId="GetComment",
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function index()
    {
        return response()->json(
            $this->commentRepository->getAll(),
            Response::HTTP_OK
        );
    }
}
