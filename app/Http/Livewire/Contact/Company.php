<?php

namespace App\Http\Livewire\Contact;

use App\Models\ContactCompany;
use Livewire\Component;

class Company extends Component
{
    protected $listeners = ['parentId'];

    protected $rules = [
        'name' => 'required|min:2|max:255',
        'identification' => 'required|min:2|max:50',
        'email' => 'required|min:2|max:80',
        'extra' => 'required|min:2|max:255',
        'choices' => 'required'
    ];

    public $name;
    public $identification;
    public $email;
    public $extra;
    public $choices;
    public $parentId;


    public function render()
    {

        //dd(ContactGeneral::find(1)->person);
        return view('livewire.contact.company');
    }

    public function mount()
    {
    }

    public function submit()
    {
        $this->validate();
        ContactCompany::updateOrCreate(
            ['contact_general_id' => $this->parentId],
            [
                'name' => $this->name,
                'identification' => $this->identification,
                'extra' => $this->extra,
                'email' => $this->email,
                'choices' => $this->choices,
                'contact_general_id' => $this->parentId,
            ]
        );
        $this->emit("stepEvent", 3);
    }

    public function parentId($parentId)
    {
        $this->parentId = $parentId;
        $c = ContactCompany::where('contact_general_id', $this->parentId)->first();
        if ($c != null) {
            $this->name = $c->name;
            $this->identification = $c->identification;
            $this->extra = $c->extra;
            $this->email = $c->email;
            $this->choices = $c->choices;
        }
    }
}
