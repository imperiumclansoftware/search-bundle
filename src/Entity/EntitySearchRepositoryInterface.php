<?php

namespace ICS\SearchBundle\Entity;

use Doctrine\Common\Collections\Collection;

interface EntitySearchRepositoryInterface
{
    public function search(string $search) : ?Collection;
}