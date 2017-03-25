# Laravel Reactions

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

LaravelReaction is the package you need if you want to implement Facebook-like reactions for your Eloquent models.

#### Features

* easy to install, nothing to configure;
* ready-to-use traits;
* you can implement reactions for multiple entities, thanks to a polymorphic many to many relationship;
* you can implement reactions from multiple entities, thanks to some extra magic under the hood;

## Install

Install the package with Composer.

``` bash
$ composer require francescomalatesta/laravel-reactions
```

Add the Service Provider to your `config/app.php` file.

```php
FrancescoMalatesta\LaravelReactions\Providers\ReactionsServiceProvider::class,
```

Run the migrations to create `reactions` and `reactables` tables.

```bash
$ php artisan migrate
```

You're good to go.

## Usage

### Add Traits to Models

To use the package you need to follow two steps:

* add the `FrancescoMalatesta\LaravelReactions\Traits\Reacts` trait to the entity that is going to react to something;
* add the `FrancescoMalatesta\LaravelReactions\Traits\Reactable` trait to the entity that is going to "receive" reactions;
* be sure that the entity that receives reactions also implements the `FrancescoMalatesta\LaravelReactions\Contracts\ReactableInterface`;

Let's make an example.

Imagine that you have some users in your application. You are building a blog, so you will have posts.

You want to let your user add reactions to your posts. Just like Facebook, you know.

Let's say we have two models: `User` and `Post`.

Following the steps, we first add the `FrancescoMalatesta\LaravelReactions\Traits\Reacts` trait to our `User` model.

```php
use FrancescoMalatesta\LaravelReactions\Traits\Reacts;

class User extends Model {
    use Reacts;
}
```

Done! Now, to the `Post` model!

```php
use FrancescoMalatesta\LaravelReactions\Traits\Reacts;
use FrancescoMalatesta\LaravelReactions\Contracts\ReactableInterface;

class Post extends Model implements ReactableInterface {
    use Reactable;
}
```

Ta-dah! You're done. 

Be default, the package ships with a `Reaction` model. This model has a single, simple property: its `name`. You can create a new one easily, with

```php
$likeReaction = Reaction::createFromName('like');
$likeReaction->save();

$loveReaction = Reaction::createFromName('love');
$loveReaction->save();
```

### React!

Our models are ready. We can use them. How?

```php
// picking the first user, for this example...
$user = User::first();

// the previously created reaction
$likeReaction = Reaction::where('name', '=', 'like')->first();

// picking up a post...
$awesomePost = Post::first();

// react to it!
$user->reactTo($awesomePost, $likeReaction);
```

Easy, isn't it? The `reactTo` method handles everything for you.

### Get Reactions for a Model

Just like you can let one of your entities react to another one, you should be able to get all the reactions for an entity.

Let's see how to do it.

```php
// picking up a post...
$awesomePost = Post::first();

// get all reactions
$reactions = $awesomePost->reactions;
```

In `$reactions` you will have a collection of `Reaction` models, ready to be used.

### Get a Reactions Summary

Probably you won't need everything about reactions to a specific entity everytime. So, I implemented a `getReactionsSummary` for you.

```php
// picking up a post...
$awesomePost = Post::first();

// get a summary of related reactions
$reactionsSummary = $awesomePost->getReactionsSummary();
```

In `$reactionsSummary` you will find a collection of items, composed by two properties: `name` and `count`. Imagine that we do something like the following code in a controller:

```php
$reactionsSummary = $awesomePost->getReactionsSummary();
return $reactionsSummary;
```

Here's what we will get:

```json
[
    {
        "name": "like",
        "count": 12
    },
    {
        "name": "love",
        "count": 7
    }
]
```

### Accessing the "Reagent"

When on Facebook, you can see "who" reacted in some way to a post. To get that `who` you can use the `getReagent` method. This works for every reaction you get using the `reactions` relationship method, of course.

Let's assume that a `User` named "Francesco" already reacted with the "love" reaction to a post.

```php
    // our awesome post.
    $awesomePost = Post::first();
    
    // every $reaction is a Reaction model
    foreach($awesomePost->reactions as $reaction) 
    {
        $user = $reaction->getReagent();
       
        // this will output "Francesco"
        echo $user->name;
    }
```

### Why "Reagent"?

I know, the name sucks. I will probably update it in the future. The idea behind it was basically "the one reacts to something".

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hellofrancesco@gmail.com instead of using the issue tracker.

## Credits

- [Francesco Malatesta][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/francescomalatesta/laravel-reactions.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/francescomalatesta/laravel-reactions/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/francescomalatesta/laravel-reactions.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/francescomalatesta/laravel-reactions.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/francescomalatesta/laravel-reactions.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/francescomalatesta/laravel-reactions
[link-travis]: https://travis-ci.org/francescomalatesta/laravel-reactions
[link-scrutinizer]: https://scrutinizer-ci.com/g/francescomalatesta/laravel-reactions/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/francescomalatesta/laravel-reactions
[link-downloads]: https://packagist.org/packages/francescomalatesta/laravel-reactions
[link-author]: https://github.com/francescomalatesta
[link-contributors]: ../../contributors
