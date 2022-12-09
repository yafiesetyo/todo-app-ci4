<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Todo;

class TodoModel extends Model
{
    protected $table = 'todo';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['title', 'description', 'isDone'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField = 'createdAt';
    protected $updatedField = 'updatedAt';
    protected $deletedField = 'deletedAt';

    protected $skipValidation = false;
    protected $validationRules = [
        'title' => 'required|min_length[5]|max_length[25]',
        'description' => 'required'
    ];
    protected $validationMessages = [
        'title' => [
            'min_length' => 'Title must have five min character',
            'max_length' => 'Title must have 25 max character',
            'required' => 'Title required'
        ],
        'description' => [
            'required' => 'Description required'
        ]
    ];

    protected $returnType = Todo::class;
}
