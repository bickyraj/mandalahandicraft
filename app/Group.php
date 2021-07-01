<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'status'];

    public function addGroupSize($data = []) {
        $status = 0;
        $group = Group::create(['name'=>$data['name']]);

        $size = $data['sizes'];
        if ($group) {
            $group->group_sizes()->createMany($size);
            $status = 1;
        }

        return $status;
    }

    public function group_sizes()
    {
        return $this->hasMany(GroupSize::class);
    }
}
