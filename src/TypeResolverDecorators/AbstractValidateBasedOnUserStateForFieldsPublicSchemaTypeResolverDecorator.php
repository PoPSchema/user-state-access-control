<?php
namespace PoP\UserStateAccessControl\TypeResolverDecorators;

use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\AccessControl\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;
use PoP\AccessControl\TypeResolverDecorators\ValidateConditionForFieldsTypeResolverDecoratorTrait;
use PoP\UserStateAccessControl\TypeResolverDecorators\ValidateBasedOnUserStateForFieldsTypeResolverDecoratorTrait;

abstract class AbstractValidateBasedOnUserStateForFieldsPublicSchemaTypeResolverDecorator extends AbstractPublicSchemaTypeResolverDecorator
{
    use ValidateConditionForFieldsTypeResolverDecoratorTrait;
    use ValidateBasedOnUserStateForFieldsTypeResolverDecoratorTrait;

    protected function getMandatoryDirectives($entryValue = null): array
    {
        $fieldQueryInterpreter = FieldQueryInterpreterFacade::getInstance();
        $validateUserStateDirectiveClass = $this->getValidateUserStateDirectiveResolverClass();
        $validateUserStateDirectiveName = $validateUserStateDirectiveClass::getDirectiveName();
        $validateUserStateDirective = $fieldQueryInterpreter->getDirective(
            $validateUserStateDirectiveName
        );
        return [
            $validateUserStateDirective,
        ];
    }
}
