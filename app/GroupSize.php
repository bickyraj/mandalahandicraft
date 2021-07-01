<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupSize extends Model
{
    protected $fillable = ['id', 'group_id', 'size', 'created_at', 'updated_at'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
