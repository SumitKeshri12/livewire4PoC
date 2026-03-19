<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactActivity extends Model
{
    protected $fillable = [
        'contact_id',
        'type',
        'description',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
