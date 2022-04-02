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

    public $step = 1;

    protected $listeners=['stepEvent'];

    protected $rules = [
        'subject' => 'required|min:2|max:255',
        'type' => 'required',
        'message' => 'required|min:2'
    ];

    public function render()
    {
        return view('livewire.contact.general');
    }

    public function submit()
    {
        if ($this->type == "company")
            $this->step = 2;
        elseif ($this->type == "person")
            $this->step = 2.5;
        return;
        $this->validate();

        ContactGeneral::create([
            'subject' => $this->subject,
            'type' => $this->type,
            'message' => $this->message
        ]);
    }

    //************EVENTOS */
    public function stepEvent($step)
    {
        $this->step = $step;
    }
}
