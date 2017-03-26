<?php

namespace FrancescoMalatesta\LaravelReactions\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Reactable
{
    /**
     * @return MorphToMany
     */
    public function reactions()
    {
        /** @var $this Model */
        return $this->morphToMany('FrancescoMalatesta\\LaravelReactions\\Models\\Reaction', 'reactable')
            ->withPivot(['responder_id', 'responder_type']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getReactionsSummary()
    {
        return $this->reactions()
            ->getQuery()
            ->select('name', \DB::raw('count(*) as count'))
            ->groupBy('name')
            ->get();
    }
}
