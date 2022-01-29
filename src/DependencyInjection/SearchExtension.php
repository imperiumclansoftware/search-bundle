<?php
namespace ICS\SearchBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
class SearchExtension extends Extension implements PrependExtensionInterface
{

    public function load(array $configs, ContainerBuilder $container)
    {

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config/'));
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $configs = $this->processConfiguration($configuration,$configs);

        $container->setParameter('search',$configs);
    }

    public function prepend(ContainerBuilder $container)
    {

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config/'));

        // Loading security config
        $loader->load('security.yaml');
        $loader->load('doctrine.yaml');

        // Loading specific bundle config
        //$bundles = $container->getParameter('kernel.bundles');

        // if(isset($bundles['LiipImagineBundle']))
        //{
        //    $loader->load('liip_imagine.yaml');
        //}
    }

}
