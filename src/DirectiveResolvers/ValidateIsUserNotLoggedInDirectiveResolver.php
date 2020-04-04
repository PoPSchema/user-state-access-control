<?php
namespace PoP\UserStateAccessControl\DirectiveResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\UserState\CheckpointSets\UserStateCheckpointSets;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\DirectiveResolvers\AbstractValidateCheckpointDirectiveResolver;

class ValidateIsUserNotLoggedInDirectiveResolver extends AbstractValidateCheckpointDirectiveResolver
{
    const DIRECTIVE_NAME = 'validateIsUserNotLoggedIn';
    public static function getDirectiveName(): string
    {
        return self::DIRECTIVE_NAME;
    }

    protected function getValidationCheckpointSet(TypeResolverInterface $typeResolver): array
    {
        return UserStateCheckpointSets::NOTLOGGEDIN;
    }

    protected function getValidationFailedMessage(TypeResolverInterface $typeResolver, array $failedDataFields): string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $errorMessage = $this->isValidatingDirective() ?
            $translationAPI->__('You must not be logged in to access directives in field(s) \'%s\'', 'user-state') :
            $translationAPI->__('You must not be logged in to access field(s) \'%s\'', 'user-state');
        return sprintf(
            $errorMessage,
            implode(
                $translationAPI->__('\', \''),
                $failedDataFields
            )
        );
    }

    public function getSchemaDirectiveDescription(TypeResolverInterface $typeResolver): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        return $translationAPI->__('It validates if the user is not logged-in', 'component-model');
    }
}
