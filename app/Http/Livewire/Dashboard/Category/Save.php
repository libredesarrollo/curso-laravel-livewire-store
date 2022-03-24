<?php

namespace App\Http\Livewire\Dashboard\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Save extends Component
{
    use WithFileUploads;

    public $title;
    public $text;
    public $image;
    public $category;

    protected $rules = [
        'title' => "required|min:2|max:255",
        'text' => "nullable",
        'image' => "nullable|image|max:1024",
    ];

    public function mount($id = null)
    {
        if ($id != null) {
            $this->category = Category::findOrFail($id);
            $this->title = $this->category->title;
            $this->text = $this->category->text;
        }
    }

    public function render()
    {
        //Log::info("render");
        return view('livewire.dashboard.category.save');
    }

    public function submit()
    {

        // validate

        $this->validate();

        // save

        if ($this->category){
            $this->category->update([
                'title' => $this->title,
                'text' => $this->text,
            ]);
            $this->emit("updated");
        }else{
           $this->category = Category::create(
            [
                'title' => $this->title,
                'slug' => str($this->title)->slug(),
                'text' => $this->text,
                ]
            );
            $this->emit("created");
        }

        // upload
        if($this->image){
            $imageName = $this->category->slug . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('images', $imageName,'public_upload');
    
            $this->category->update([
                'image'=> $imageName
            ]);

        }
    }

    /*
    public function boot()
    {
        Log::info("boot");
    }
 
    public function booted()
    {
        Log::info("booted");
    }
 
    public function mount()
    {
        Log::info("mount");
    }
 
    public function hydrateTitle($value)
    {
        Log::info("hydrateTitle $value");
    }
 
    public function dehydrateFoo($value)
    {
        Log::info("dehydrateFoo $value");
    }
 
    public function hydrate()
    {
       
        Log::info("hydrate");
    }
 
    public function dehydrate()
    {
        Log::info("dehydrate");
    }
 
    public function updating($name, $value)
    {
        $this->title = "Pepe";
        Log::info("updating $name $value");
    }
 
    public function updated($name, $value)
    {
        Log::info("updated $name $value");
    }
 
    public function updatingTitle($value)
    {
        Log::info("updatingTitle $value");
    }
 
    public function updatedTitle($value)
    {
         Log::info("updatedTitle $value");
    }
 
  */
}
