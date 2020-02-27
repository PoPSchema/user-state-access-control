<?php
namespace PoP\UserStateAccessControl\ConfigurationEntries;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;

trait MaybeDisableFieldsIfConditionTrait
{
    /**
     * Configuration entries
     *
     * @return array
     */
    abstract protected static function getEntryList(): array;

    /**
     * Field names to remove
     *
     * @return array
     */
    protected function getFieldNames(): array
    {
        return array_map(
            function($entry) {
                // The tuple has format [typeResolverClass, fieldName] or [typeResolverClass, fieldName, $role] or [typeResolverClass, fieldName, $capability]
                // So, in position [1], will always be the $fieldName
                return $entry[1];
            },
           static::getEntryList()
        );
    }

    /**
     * Filter all the entries from the list which apply to the passed typeResolver and fieldName
     *
     * @param boolean $include
     * @param array $entryList
     * @param TypeResolverInterface $typeResolver
     * @param string $fieldName
     * @return boolean
     */
    protected function getMatchingEntriesFromConfiguration(array $entryList, TypeResolverInterface $typeResolver, string $fieldName): array
    {
        $typeResolverClass = get_class($typeResolver);
        return array_filter(
            $entryList,
            function($entry) use($typeResolverClass, $fieldName) {
                return $entry[0] == $typeResolverClass && $entry[1] == $fieldName;
            }
        );
    }
}
