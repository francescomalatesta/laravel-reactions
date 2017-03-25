<?php

namespace LaravelReactions\Contracts;


interface ReactableInterface
{
    /**
     * Returns an Eloquent collection of reactions to the current item.
     */
    public function reactions();

    /**
     * Returns a collection of objects. Every object has a name and a count.
     *
     * Example:
     *
     *      $summaryItems = $post->getReactionsSummary();
     *      foreach($summaryItems as $reaction) {
     *          // gets the reaction name
     *          $reaction->name
     *
     *          // gets the given reactions count for the $post
     *          $reaction->count
     *      }
     *
     */
    public function getReactionsSummary();
}
