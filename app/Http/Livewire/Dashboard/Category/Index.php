<?php

namespace App\Http\Livewire\Dashboard\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public function render()
    {
        $categories = Category::paginate(10);
        return view('livewire.dashboard.category.index',compact('categories'));
    }

    public function delete(Category $category)
    {
        $category->delete();
    }

}
