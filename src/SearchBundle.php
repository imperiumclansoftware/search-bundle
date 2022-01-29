<?php
namespace ICS\SearchBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SearchBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {

    }

    public function getPath(): string
    {

        return \dirname(__DIR__);
    }

}
