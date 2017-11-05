<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ComboStatus extends Model
{
    protected $fillable = ['combo_id', 'status_id'];

    public function status()
    {
        return $this->belongsTo('App\Model\Status');
    }
}
