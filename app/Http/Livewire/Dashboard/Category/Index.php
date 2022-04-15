<?php

namespace App\Http\Livewire\Dashboard\Category;

use App\Http\Livewire\Dashboard\OrderTrait;
use App\Models\Category;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    use OrderTrait;

    public $columns = [
        'id' => "Id",
        'title' => "Título",
    ];

    public $confirmingDeleteCategory;
    public $categoryToDelete;

    public function getCategoryProperty()
    {
        if ($this->categoryToDelete)
            return Category::find($this->categoryToDelete->id);
        return "Sin categoría seleccionada";
    }



    public function render()
    {
        //dd($this->category);
        //$this->confirmingDeleteCategory = true;
        $categories = Category::orderBy($this->sortColumn, $this->sortDirection)->paginate(10);
        return view('livewire.dashboard.category.index', compact('categories'));
    }

    public function seletedCategoryToDelete(Category $category)
    {
        $this->confirmingDeleteCategory = true;
        $this->categoryToDelete = $category;
    }

    public function delete()
    {
        $this->emit("deleted");
        $this->confirmingDeleteCategory = false;
        $this->categoryToDelete->delete();
    }
}
