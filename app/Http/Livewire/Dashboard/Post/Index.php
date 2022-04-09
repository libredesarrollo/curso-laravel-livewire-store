<?php

namespace App\Http\Livewire\Dashboard\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $confirmingDeletePost;
    public $postToDelete;

    public function render()
    {
        //$this->confirmingDeletePost = true;
        $posts = Post::paginate(10);
        return view('livewire.dashboard.post.index',compact('posts'));
    }

    public function seletedPostToDelete(Post $post)
    {
        $this->confirmingDeletePost = true;
        $this->postToDelete = $post;
    }

    public function delete()
    {
        $this->emit("deleted");
        $this->confirmingDeletePost = false;
        $this->postToDelete->delete();
    }

}
