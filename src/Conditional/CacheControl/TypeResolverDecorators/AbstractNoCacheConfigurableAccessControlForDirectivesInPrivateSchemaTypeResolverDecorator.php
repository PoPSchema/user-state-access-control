<?php

declare(strict_types=1);

namespace PoP\UserStateAccessControl\Conditional\CacheControl\TypeResolverDecorators;

use PoP\AccessControl\TypeResolverDecorators\AbstractConfigurableAccessControlForDirectivesInPrivateSchemaTypeResolverDecorator;
use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;

abstract class AbstractNoCacheConfigurableAccessControlForDirectivesInPrivateSchemaTypeResolverDecorator extends AbstractConfigurableAccessControlForDirectivesInPrivateSchemaTypeResolverDecorator
{
    use NoCacheConfigurableAccessControlTypeResolverDecoratorTrait;

    protected function getConfigurationEntries(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForDirectives(AccessControlGroups::STATE);
    }
}
