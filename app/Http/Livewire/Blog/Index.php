<?php

namespace App\Http\Livewire\Blog;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    protected $queryString = ['type','posted','category_id','search', 'from', 'to'];

    public $confirmingDeletePost;
    public $postToDelete;

    // filters
    public $type;
    public $category_id;
    public $posted;

    // search
    public $search;

    // dates
    public $from;
    public $to;

    // order

    public $columns=[
        'id' => "Id",
        'title' => "Título",
        'date' => "Fecha",
        'description' => "Descripción",
        'posted' => "Posted",
        'type' => "Típo",
        'category_id' => "Categoría",
    ];

    public function render()
    {
        $posts = Post::where('posted','yes');

        if ($this->search)
            $posts->where(function ($query) {
                $query->orWhere("id", 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('title', 'like', '%' . $this->search . '%');
            });


        if ($this->from && $this->to) {
            $posts->whereBetween('date', [ date($this->from), date($this->to) ]);
        }

        if ($this->type) {
            $posts->where('type', $this->type);
        }
        if ($this->category_id) {
            $posts->where('category_id', $this->category_id);
        }
        if ($this->posted) {
            $posts->where('posted', $this->posted);
        }

        $categories = Category::pluck("title", "id");

        $posts = $posts->paginate(10);


        return view('livewire.blog.index', compact('posts', 'categories'))->layout('layouts.web');
    }

   


}
