<?php

namespace App\GraphQL\Mutations;

use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Auth
{
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        /** @var User $user */
        $user = User::query()->where('email', $args['email'])->first();
        if (app('hash')->check($args['password'], $user->password)) {
            $token = $user->createToken('GraphQL Auth Mutation')->accessToken;
            return compact('token', 'user');
        }
    }
}
