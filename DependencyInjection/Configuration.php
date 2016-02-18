<?php

namespace Arii\JoeXmlConnectorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('arii_joe_xml_connector');
        $rootNode
            ->children()
              ->scalarNode('live_folder_path')
                ->info('Path of your live folder.')
                ->isRequired()
              ->end()
            ->end();

        return $treeBuilder;
    }
}
