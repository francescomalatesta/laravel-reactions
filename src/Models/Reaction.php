<?php

namespace FrancescoMalatesta\LaravelReactions\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    public static function createFromName($name)
    {
        $reaction = new static;
        $reaction->name = $name;

        return $reaction;
    }

    public function getResponder()
    {
        if ($this->getOriginal('pivot_responder_type', null)) {
            return forward_static_call(
                [$this->getOriginal('pivot_responder_type'), 'find'],
                $this->getOriginal('pivot_responder_id')
            );
        }

        return null;
    }
}
