<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Uuid;

class PickList extends Model
{
    protected $fillable = ['title', 'password'];
    protected $hidden = ['id', 'password', 'created_at', 'updated_at'];
    public static function boot()
    {
      parent::boot();
      self::creating(function ($model) {
        $model->uuid = (string) Uuid::generate(4);
      });
    }

    public function rationales()
    {
        return $this->hasMany('App\Models\Rationale');
    }
}
