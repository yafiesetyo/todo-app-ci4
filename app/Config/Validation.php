<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    // public $todo = [
    //     'title' => [
    //         'rules' => 'required|min_length[5]|max_length[25]',
    //         'errors' => [
    //             'min_length[5]' => 'Title must have five min character',
    //             'max_length[25]' => 'Title must have 25 max character',
    //             'required' => 'Title required'
    //         ]
    //     ],
    //     'description' => [
    //         'rules' => 'required',
    //         'errors' => [
    //             'required' => 'Description required'
    //         ]
    //     ]
    // ];
}
