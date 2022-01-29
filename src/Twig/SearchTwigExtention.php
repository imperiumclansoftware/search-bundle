<?php

namespace ICS\SearchBundle\Twig;

use Twig\TwigFunction;
use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class SearchTwigExtention extends AbstractExtension
{

    public function getFilters()
    {
        return [
            new TwigFilter('SearchEntityClearName',[$this,'clearName'])
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('hightlight', [$this, 'hightlight'], [
                'is_safe' => ['html'],
                'needs_environment' => false,
            ]),
        ];
    }

    public function clearName($class)
    {
        if(method_exists($class,'getEntityClearName'))
        {
            return $class::getEntityClearName();
        }

        return "Unknow";
    }

    public function hightlight($result,$search,$class="bg-info text-light"): string
    {
        $regexp = "/($search)(?![^<]+>)/i";

        $replacement = '<span class="'.$class.'">\\1</span>';

        $text = preg_replace ($regexp,$replacement ,$result);

        return $text;
    }

}