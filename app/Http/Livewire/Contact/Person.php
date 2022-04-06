<?php

namespace App\Http\Livewire\Contact;

use App\Models\ContactPerson;
use Livewire\Component;

class Person extends Component
{

    protected $listeners = ['parentId'];

    protected $rules = [
        'name' => 'required|min:2|max:255',
        'surname' => 'required|min:2|max:255',
        'choices' => 'required',
        'other' => 'nullable'
    ];

    public $name;
    public $surname;
    public $choices;
    public $other;

    public $parentId;

    public function render()
    {
        return view('livewire.contact.person');
    }

    public function submit()
    {
        $this->validate();
        
        ContactPerson::updateOrCreate(
            ['contact_general_id' => $this->parentId],
            [
            'name' => $this->name,
            'surname' => $this->surname,
            'choices' => $this->choices,
            'contact_general_id' => $this->parentId,
            'other' => $this->other
        ]);

        $this->emit("stepEvent",3);
    }

    public function parentId($parentId)
    {
        $this->parentId=$parentId;
        $c = ContactPerson::where('contact_general_id', $this->parentId)->first();
        if ($c != null) {
            $this->name = $c->name;
            $this->surname = $c->surname;
            $this->choices = $c->choices;
            $this->other = $c->other;
        }
    }
}
