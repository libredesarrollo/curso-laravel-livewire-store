<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCompany extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'identification','email','extra', 'contact_general_id','choices'];

    public function general(){
        return $this->belongsTo(ContactGeneral::class);
    }
}
