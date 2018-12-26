<?php
/**
 * Created by PhpStorm.
 * User: dljy-technology
 * Date: 2018/12/18
 * Time: 下午5:15
 */

namespace Liz\ElfinderExtensionBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('liz_elfinder_extension');
        $rootNode
            ->children()
                ->arrayNode('flysystem_adapter_aliyun')
                    ->children()
                        ->scalarNode('access_key')->end()
                        ->scalarNode('secret_key')->end()
                        ->scalarNode('bucket')->end()
                        ->scalarNode('end_point')->end()
                    ->end()
                ->end()
                ->arrayNode('flysystem_adapter_qiniu')
                    ->children()
                        ->scalarNode('access_key')->end()
                        ->scalarNode('secret_key')->end()
                        ->scalarNode('bucket')->end()
                        ->scalarNode('cdn_host')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;

    }


}