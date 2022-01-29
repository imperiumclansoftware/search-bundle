<?php
namespace ICS\SearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {

        $treeBuilder = new TreeBuilder('search');
        //$treeBuilder->getRootNode()->children()
        //    ->scalarNode('path')->defaultValue('medias')->end()
        //;

        return $treeBuilder;
    }

}
