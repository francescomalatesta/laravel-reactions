<?php

namespace LaravelReactions\Tests\Integration\Support;


use Illuminate\Database\Eloquent\Model;
use LaravelReactions\Contracts\ReactableInterface;
use LaravelReactions\Traits\Reactable;

class PostTestModel extends Model implements ReactableInterface
{
    use Reactable;

    protected $table = 'posts';
}
