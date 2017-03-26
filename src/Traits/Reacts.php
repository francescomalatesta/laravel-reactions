<?php

namespace FrancescoMalatesta\LaravelReactions\Traits;

use FrancescoMalatesta\LaravelReactions\Contracts\ReactableInterface;
use FrancescoMalatesta\LaravelReactions\Models\Reaction;

trait Reacts
{
    public function reactTo(ReactableInterface $reactable, Reaction $reaction)
    {
        $reactable->reactions()->attach(
            $reaction->id,
            [
                'responder_id' => $this->id,
                'responder_type' => get_class($this)
            ]
        );
    }
}
