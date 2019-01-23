<?php

namespace App\GraphQL\Type;

use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'User',
        'description'   => 'A user',
        'model'         => User::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
                // 'alias' => 'user_id', // Use 'alias', if the database column is different from the type name
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the user',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of user',
            ],
            // Relation
            'posts' => [
                'type'          => Type::listOf(GraphQL::type('post')),
                'description'   => 'A list of posts written by the user',
                // The first args are the parameters passed to the query
                // 'query'         => function (array $args, $query) {
                //     return $query->where('posts.created_at', '>', $args['date_from']);
                // }
            ]
            // Uses the 'getIsMeAttribute' function on our custom User model
            // 'isMe' => [
            //     'type' => Type::boolean(),
            //     'description' => 'True, if the queried user is the current user',
            //     'selectable' => false, // Does not try to query this from the database
            // ]
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }
}
