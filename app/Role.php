<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function name()
  {
    return ucfirst($this->name);
  }

  public function name_lowercase()
  {
    return strtolower($this->name);
  }

  public function name_camel_case()
  {
    return camel_case($this->name_lowercase());
  }

  public function users()
  {
    return $this->belongsToMany(User::class)->withTimestamps();
  }
}
