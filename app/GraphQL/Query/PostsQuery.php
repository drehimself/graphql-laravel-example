<?php

namespace App\GraphQL\Query;

use App\Post;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class PostsQuery extends Query
{
    protected $attributes = [
        'name' => 'Posts query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('post'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Post::where('id', $args['id'])->get();
        }

        return Post::all();
    }
}
