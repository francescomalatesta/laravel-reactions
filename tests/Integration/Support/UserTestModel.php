<?php

namespace FrancescoMalatesta\LaravelReactions\Tests\Integration\Support;

use Illuminate\Database\Eloquent\Model;
use FrancescoMalatesta\LaravelReactions\Traits\Reacts;

class UserTestModel extends Model
{
    use Reacts;

    protected $table = 'users';
}
