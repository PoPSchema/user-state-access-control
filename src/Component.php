<?php
namespace PoP\UserStateAccessControl;

use PoP\AccessControl\Component as AccessControlComponent;
use PoP\Root\Component\AbstractComponent;
use PoP\Root\Component\YAMLServicesTrait;
use PoP\Root\Component\CanDisableComponentTrait;
use PoP\ComponentModel\Container\ContainerBuilderUtils;

/**
 * Initialize component
 */
class Component extends AbstractComponent
{
    public static $COMPONENT_DIR;
    use YAMLServicesTrait, CanDisableComponentTrait;
    // const VERSION = '0.1.0';

    /**
     * Initialize services
     */
    public static function init()
    {
        if (self::isEnabled()) {
            parent::init();
            self::$COMPONENT_DIR = dirname(__DIR__);
            self::initYAMLServices(self::$COMPONENT_DIR);

            // Init conditional on API package being installed
            if (class_exists('\PoP\CacheControl\Component')) {
                \PoP\UserStateAccessControl\Conditional\CacheControl\ConditionalComponent::init();
            }
        }
    }

    protected static function resolveEnabled()
    {
        return AccessControlComponent::isEnabled();
    }

    /**
     * Boot component
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // Initialize classes
        ContainerBuilderUtils::instantiateNamespaceServices(__NAMESPACE__.'\\Hooks');
        ContainerBuilderUtils::attachDirectiveResolversFromNamespace(__NAMESPACE__.'\\DirectiveResolvers');
    }

    /**
     * Boot component
     *
     * @return void
     */
    public static function reallyBoot()
    {
        parent::reallyBoot();

        // Initialize classes
        ContainerBuilderUtils::attachTypeResolverDecoratorsFromNamespace(__NAMESPACE__.'\\TypeResolverDecorators');

        // Boot conditional on API package being installed
        if (class_exists('\PoP\CacheControl\Component')) {
            \PoP\UserStateAccessControl\Conditional\CacheControl\ConditionalComponent::reallyBoot();
        }
    }
}
