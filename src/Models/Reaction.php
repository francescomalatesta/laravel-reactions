<?php

namespace LaravelReactions\Models;


use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    public static function createFromName($name)
    {
        $reaction = new static;
        $reaction->name = $name;

        return $reaction;
    }

    public function getReagent()
    {
        if($this->getOriginal('pivot_reagent_type', null)) {
            return forward_static_call(array($this->getOriginal('pivot_reagent_type'), 'find'), $this->getOriginal('pivot_reagent_id'));
        }

        return null;
    }
}
