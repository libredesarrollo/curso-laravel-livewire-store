<?php

namespace App\Http\Livewire\Todos;

use App\Models\Todo as ModelsTodo;
use Livewire\Component;

class Todo extends Component
{

    protected $listeners = ['setOrden'];

    public $task;
    public $todos;


    public function render()
    {
        $this->todos = ModelsTodo::where('user_id', auth()->id())->orderBy('count')->get()->toArray();
        return view('livewire.todos.todo');
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
        foreach($this->todos as $count => $t){
            ModelsTodo::where("id", $t['id'])->update(['count' => $count]);
        }
    }
}
