<?php

namespace App\Http\Livewire\Contact;

use App\Models\ContactGeneral;
use App\Models\ContactPerson;
use Livewire\Component;

class General extends Component
{

    public $subject;
    public $type;
    public $message;

    protected $rules = [
        'subject' => 'required|min:2|max:255',
        'type' => 'required',
        'message' => 'required|min:2'
    ];

    public function render()
    {
       // dd(ContactGeneral::find(1)->person);
        dd(ContactPerson::find(1)->general);
        return view('livewire.contact.general');
    }

    public function submit()
    {
        $this->validate();

        ContactGeneral::create([
            'subject' => $this->subject,
            'type' => $this->type,
            'message' => $this->message
        ]);
    }
}
