<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rationale extends Model
{
    protected $fillable = ['challenge_id', 'proposals', 'downProposals', 'rationale'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'pick_list_id'];
    public function pickList()
    {
        return $this->belongsTo('App\PickList');
    }
}
