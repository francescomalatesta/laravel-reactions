<?php

namespace LaravelReactions\Traits;


use LaravelReactions\Contracts\ReactableInterface;
use LaravelReactions\Models\Reaction;

trait Reacts
{
    public function reactTo(ReactableInterface $reactable, Reaction $reaction)
    {
        $reactable->reactions()->attach(
            $reaction->id, [
                'reagent_id' => $this->id,
                'reagent_type' => get_class($this)
            ]
        );
    }
}
