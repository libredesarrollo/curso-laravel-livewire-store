<?php

namespace App\Http\Livewire\Todos;

use App\Models\Todo as ModelsTodo;
use Livewire\Component;

class Todo extends Component
{

    protected $listeners = ['setOrden', 'setOrdenById', 'deleteById'];

    public $task;
    //public $todos; // ordenacion 1 y 2


    public function render()
    {
        $todos = ModelsTodo::where('user_id', auth()->id())->orderBy('count')->get()->toArray();
        return view('livewire.todos.todo', compact("todos"));
    }

    public function save()
    {
        ModelsTodo::create([
            'name' => $this->task,
            'user_id' => auth()->id(),
            'count' => ModelsTodo::where('user_id', auth()->id())->count()
        ]);
    }

    public function setOrden()
    {
        foreach ($this->todos as $count => $t) {
            ModelsTodo::where("id", $t['id'])->update(['count' => $count]);
        }
    }
    public function setOrdenById($ids)
    {
        foreach ($ids as $count => $id) {
            ModelsTodo::where("id", $id)->where("count", "!=", $count)->update(['count' => $count]);
        }
    }
    public function deleteById($id)
    {
       
        ModelsTodo::where("id", $id)->where('user_id', auth()->id())->delete();
    }
}
