<?php

namespace App\Interfaces;

interface CommentRepositoryInterface 
{
    public function getAll();
    public function create(array $orderDetails);
}