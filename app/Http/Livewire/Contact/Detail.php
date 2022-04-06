<?php

namespace App\Http\Livewire\Contact;

use App\Models\ContactDetail;
use Livewire\Component;

class Detail extends Component
{

    protected $listeners = ['parentId'];

    protected $rules = [
        'extra' => 'required|min:2|max:500',
    ];

    public $extra;
    public $parentId;

    public function render()
    {
        return view('livewire.contact.detail');
    }

    public function submit()
    {

        $this->validate();

        ContactDetail::updateOrCreate(
            ['contact_general_id' => $this->parentId],
            [
                'extra' => $this->extra,
                'contact_general_id' => $this->parentId,
            ]
        );

        $this->emit("stepEvent", 4);
    }

    public function parentId($parentId)
    {
        $this->parentId = $parentId;

        $c = ContactDetail::where('contact_general_id', $this->parentId)->first();
        if ($c != null) {
            $this->extra = $c->extra;
        }
    }
}
