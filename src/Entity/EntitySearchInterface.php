<?php

namespace ICS\SearchBundle\Entity;

use Doctrine\Common\Collections\Collection;

interface EntitySearchInterface
{

    public static function getEntityClearName(): string;

    public static function getSearchTwigTemplate(): string;

    // public function search(string $search) : ?Collection;

    public static function getRolesSearchEnabled(): array;
}