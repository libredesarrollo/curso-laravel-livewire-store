<?php

namespace App\Http\Livewire\Todos;

use App\Models\Todo as ModelsTodo;
use Livewire\Component;

class Todo extends Component
{

    protected $listeners = ['setOrden', 'setOrdenById', 'delete', 'update', 'status'];

    public $task;
    public $todos; // ordenacion 1 y 2


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
    public function delete($id = null)
    {
        if ($id != null)
            return ModelsTodo::where("id", $id)->where('user_id', auth()->id())->delete();
        ModelsTodo::where('user_id', auth()->id())->delete();
    }
    public function update($todo)
    {
        ModelsTodo::where("id", $todo['id'])->where('user_id', auth()->id())->update(['name' => $todo['name']]);
    }
    public function status($id, $status)
    {
        ModelsTodo::where("id", $id)->where('user_id', auth()->id())->update(['status' => $status]);
    }
}
