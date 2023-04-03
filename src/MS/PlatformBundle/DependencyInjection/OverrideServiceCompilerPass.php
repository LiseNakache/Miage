<?php

namespace MS\PlatformBundle\DependencyInjection;

use MS\PlatformBundle\Listener\AuthenticationListener;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('fos_user.listener.authentication');
        $definition->setClass(AuthenticationListener::class);
    }

}
