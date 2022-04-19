<?php

namespace App\Http\Livewire\Blog;

use App\Models\Post;
use Livewire\Component;

class Show extends Component
{

    public $post;

    public function mount($slug)
    {
        $this->post = Post::where("slug",$slug)->first();
    }

    public function render()
    {
        return view('livewire.blog.show')->layout("layouts.web");
    }
}
