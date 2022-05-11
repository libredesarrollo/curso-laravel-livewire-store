<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function reOrden()
    {
       
        foreach (request("ids") as $count => $id) {
            Todo::where("id", $id)->where('user_id', auth()->id())->where("count", "!=", $count)->update(['count' => $count]);
        }
    }
}
