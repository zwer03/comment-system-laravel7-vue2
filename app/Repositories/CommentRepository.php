<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface 
{
    public function getAll()
    {
        return Comment::tree()->orderBy('created_at', 'desc')->get()->toTree();
    }

    public function create(array $comment)
    {
        $comment = Comment::create($comment);
        $depth = Comment::find($comment->id)->ancestors()->get()->count();
        $comment->setAttribute('depth', $depth);
        return $comment;
    }
}
