<?php
namespace LaravelReactions\Tests\Unit;


use LaravelReactions\Models\Reaction;

class ReactionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromNameShouldCreateReaction()
    {
        $reaction = Reaction::createFromName('like');

        $this->assertInstanceOf(Reaction::class, $reaction);
        $this->assertEquals('like', $reaction->name);
    }
}
