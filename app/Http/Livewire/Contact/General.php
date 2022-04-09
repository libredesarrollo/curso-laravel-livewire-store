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

    public $step = 2;

    public $pk;

    protected $listeners = ['stepEvent'];

    protected $rules = [
        'subject' => 'required|min:2|max:255',
        'type' => 'required',
        'message' => 'required|min:2'
    ];

    public function render()
    {
        return view('livewire.contact.general')->layout('layouts.contact');
    }

    public function submit()
    {
        $this->validate();

        if ($this->pk) {
            ContactGeneral::where('id', $this->pk)->update([
                'subject' => $this->subject,
                'type' => $this->type,
                'message' => $this->message
            ]);
        } else
            $this->pk = ContactGeneral::create([
                'subject' => $this->subject,
                'type' => $this->type,
                'message' => $this->message
            ])->id;

        $this->stepEvent(2);
    }

    //************EVENTOS */
    public function stepEvent($step)
    {

        if ($step == 2) {
            if ($this->type == "company")
                $this->step = 2;
            elseif ($this->type == "person")
                $this->step = 2.5;
        } else
            $this->step = $step;

        $this->emit("parentId", $this->pk);
    }
}
