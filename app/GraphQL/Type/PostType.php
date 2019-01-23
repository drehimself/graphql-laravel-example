<?php

namespace App\GraphQL\Type;

use GraphQL;
use App\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Post',
        'description'   => 'A post',
        'model'         => Post::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the post',
                // 'alias' => 'user_id', // Use 'alias', if the database column is different from the type name
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of the post',
            ],
            'content' => [
                'type' => Type::string(),
                'description' => 'The content of post',
            ],
            // Relation
            'user' => [
                'type'          => GraphQL::type('user'),
                'description'   => 'The user who created this post',
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
    // protected function resolveEmailField($root, $args)
    // {
    //     return strtolower($root->email);
    // }

    // protected function resolveNameField($root, $args)
    // {
    //     return strtolower($root->name);
    // }
}
