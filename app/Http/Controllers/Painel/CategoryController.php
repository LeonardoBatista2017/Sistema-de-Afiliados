<?php
namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Category;

class CategoryController extends StandardController
{
    protected $model;
    protected $name     = 'Categoria';
    protected $view     = 'painel.categories';
    protected $upload   = ['name' => 'image', 'path' => 'categories'];
    protected $route    = 'categorias';

    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}