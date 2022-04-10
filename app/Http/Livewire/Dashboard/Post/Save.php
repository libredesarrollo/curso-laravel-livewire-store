<?php

namespace App\Http\Livewire\Dashboard\Post;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Save extends Component
{
    use WithFileUploads;

    public $title;
    public $date;
    public $text;
    public $description;
    public $posted;
    public $type;
    public $category_id;
    public $image;

    public $post;

    protected $rules = [
        'title' => "required|min:2|max:255",
        'description' => "required|min:2|max:255",
        'date' => "required",
        'type' => "required",
        'category_id' => "required",
        'posted' => "required",
        'text' => "required|min:2|max:5000",
        'image' => "nullable|image|max:1024",
    ];

    public function mount($id = null)
    {
        if ($id != null) {
            $this->post = Post::findOrFail($id);
            $this->title = $this->post->title;
            $this->text = $this->post->text;
            $this->date = $this->post->date;
            $this->description = $this->post->description;
            $this->posted = $this->post->posted;
            $this->type = $this->post->type;
            $this->category_id = $this->post->category_id;
        }
    }

    public function render()
    {
       
        $categories = Category::get();
        return view('livewire.dashboard.post.save', compact('categories'));
    }

    public function submit()
    {

        // validate

        $this->validate();

        // save

        if ($this->post) {
            $this->post->update([
                'title' => $this->title,
                'text' => $this->text,
                'description' => $this->description,
                'date' => $this->date,
                'posted' => $this->posted,
                'type' => $this->type,
                'category_id' => $this->category_id,
            ]);
            $this->emit("updated");
        } else {
            $this->post = Post::create(
                [
                    'title' => $this->title,
                    'slug' => str($this->title)->slug(),
                    'text' => $this->text,
                    'description' => $this->description,
                    'date' => $this->date,
                    'posted' => $this->posted,
                    'type' => $this->type,
                    'category_id' => $this->category_id,
                ]
            );
            $this->emit("created");
        }

        // upload
        if ($this->image) {
            $imageName = $this->post->slug . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('images/post', $imageName, 'public_upload');

            $this->post->update([
                'image' => $imageName
            ]);
        }
    }
}
