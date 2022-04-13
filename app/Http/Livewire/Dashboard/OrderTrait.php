<?php

namespace App\Http\Livewire\Dashboard;

trait OrderTrait
{
    // order

    public $sortColumn = "id";
    public $sortDirection = "asc";

    // ordenacion
    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }
}
