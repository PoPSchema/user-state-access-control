<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\AccessControl\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;
use PoP\UserStateAccessControl\TypeResolverDecorators\ValidateBasedOnUserStateForDirectivesTypeResolverDecoratorTrait;

abstract class AbstractValidateBasedOnUserStateForDirectivesPublicSchemaTypeResolverDecorator extends AbstractPublicSchemaTypeResolverDecorator
{
    use ValidateConditionForDirectivesTypeResolverDecoratorTrait;
    use ValidateBasedOnUserStateForDirectivesTypeResolverDecoratorTrait;

    protected function getMandatoryDirectives(): array
    {
        $fieldQueryInterpreter = FieldQueryInterpreterFacade::getInstance();
        $validateUserStateDirective = $this->getValidateUserStateDirectiveResolverClass();
        $validateUserStateDirectiveName = $validateUserStateDirective::getDirectiveName();
        $validateUserStateDirective = $fieldQueryInterpreter->getDirective(
            $validateUserStateDirectiveName
        );
        return [
            $validateUserStateDirective,
        ];
    }
}
