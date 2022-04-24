<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface 
{
    public function getAll()
    {
        return Comment::tree()->get()->toTree();
    }

    public function create(array $comment)
    {
        return Comment::create($comment);
    }
}
