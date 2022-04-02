<?php

namespace App\Http\Livewire\Contact;

use App\Models\ContactCompany;
use Livewire\Component;

class Company extends Component
{
    public $name;
    public $identification;
    public $email;
    public $extra;
    public $choices;

    protected $rules = [
        'name' => 'required|min:2|max:255',
        'identification' => 'required|min:2|max:50',
        'email' => 'required|min:2|max:80',
        'extra' => 'required|min:2|max:255',
        'choices' => 'required'
    ];

    public function render()
    {

        //dd(ContactGeneral::find(1)->person);
        return view('livewire.contact.company');
    }

    public function submit()
    {
        $this->emit("stepEvent",3);
        return;
        $this->validate();

        ContactCompany::create([
            'name' => $this->name,
            'identification' => $this->identification,
            'extra' => $this->extra,
            'email' => $this->email,
            'choices' => $this->choices,
            'contact_general_id' => 1,
        ]);
    }
}
