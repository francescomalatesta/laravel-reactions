<?php

namespace LaravelReactions\Tests\Integration\Support;


use Illuminate\Database\Eloquent\Model;
use LaravelReactions\Traits\Reacts;

class UserTestModel extends Model
{
    use Reacts;

    protected $table = 'users';
}
