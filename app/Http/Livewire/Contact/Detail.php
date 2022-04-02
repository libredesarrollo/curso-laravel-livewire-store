<?php

namespace App\Http\Livewire\Contact;

use App\Models\ContactDetail;
use Livewire\Component;

class Detail extends Component
{
    public $extra;

    protected $rules = [
        'extra' => 'required|min:2|max:500',
    ];

    public function render()
    {
        return view('livewire.contact.detail');
    }

    public function submit()
    {
        $this->emit("stepEvent",4);
        return;
        $this->validate();

        ContactDetail::create([
            'extra' => $this->extra,
            'contact_general_id' => 1,
        ]);
    }
}
