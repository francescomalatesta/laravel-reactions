<?php

namespace FrancescoMalatesta\LaravelReactions\Tests\Integration\Support;

use Illuminate\Database\Eloquent\Model;
use FrancescoMalatesta\LaravelReactions\Contracts\ReactableInterface;
use FrancescoMalatesta\LaravelReactions\Traits\Reactable;

class PostTestModel extends Model implements ReactableInterface
{
    use Reactable;

    protected $table = 'posts';
}
