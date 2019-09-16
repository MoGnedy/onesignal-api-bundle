<?php

namespace App\Bundle\OneSignalNotificationsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('one_signal_notifications');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('app_id')->end()
                ->scalarNode('api_key')->end()
            ->end();
        return $treeBuilder;
    }
}
