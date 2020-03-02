<?php
namespace PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators;

use PoP\UserStateAccessControl\TypeResolverDecorators\ValidateUserNotLoggedInForFieldsTypeResolverDecoratorTrait;

class ValidateUserNotLoggedInForFieldsPrivateSchemaTypeResolverDecorator extends AbstractNoCacheConfigurableAccessControlForFieldsInPrivateSchemaTypeResolverDecorator
{
    use ValidateUserNotLoggedInForFieldsTypeResolverDecoratorTrait;
}
