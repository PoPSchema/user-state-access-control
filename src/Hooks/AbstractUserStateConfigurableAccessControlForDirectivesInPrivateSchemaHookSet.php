<?php
namespace PoP\UserStateAccessControl\Hooks;

use PoP\ComponentModel\Engine_Vars;
use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\UserStateAccessControl\Services\AccessControlGroups;
use PoP\AccessControl\Hooks\AbstractConfigurableAccessControlForDirectivesInPrivateSchemaHookSet;

abstract class AbstractUserStateConfigurableAccessControlForDirectivesInPrivateSchemaHookSet extends AbstractConfigurableAccessControlForDirectivesInPrivateSchemaHookSet
{
    protected function enabled(): bool
    {
        $vars = Engine_Vars::getVars();
        $isUserLoggedIn = $vars['global-userstate']['is-user-logged-in'];
        return parent::enabled() && $this->enableBasedOnUserState($isUserLoggedIn);
    }

    abstract protected function enableBasedOnUserState(bool $isUserLoggedIn): bool;

    /**
     * Configuration entries
     *
     * @return array
     */
    protected function getConfigurationEntries(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForDirectives(AccessControlGroups::STATE);
    }
}
