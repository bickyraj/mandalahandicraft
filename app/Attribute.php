<?php

namespace App;

use App\Traits\CommonModel;
use Illuminate\Database\Eloquent\Model;

class Attribute extends BaseModel
{
    use CommonModel;

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function scopeParentAttributes($query)
    {
       return $query->orderBy('name')->paginate($this->default_pagination_limit);

    }

    public function getAllAttributes()
    {
        $attributeIds    = [];

        if ($this) {
            $children = $this->children;
            foreach ($children as $k => $child) {
                $attributeIds[] = $child->id;
                $allAttributes = $child->getAllAttributes();
                $attributeIds     = array_merge($attributeIds, $allAttributes);
            }
        }

        return $attributeIds;
    }
}
