<?php

namespace ICS\SearchBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class SearchResult
{
    private $entityClearName;

    private $twigTemplate;

    private $results;

    private $enabledRoles = [];

    public function __construct(string $entityClearName, string $twigTemplate)
    {
        $this->entityClearName =$entityClearName;
        $this->twigTemplate = $twigTemplate;
        $this->results = new ArrayCollection();
    }

    /**
     * Get the value of entityClearName
     */ 
    public function getEntityClearName()
    {
        return $this->entityClearName;
    }

    /**
     * Set the value of entityClearName
     *
     * @return  self
     */ 
    public function setEntityClearName($entityClearName)
    {
        $this->entityClearName = $entityClearName;

        return $this;
    }

    /**
     * Get the value of twigTemplate
     */ 
    public function getTwigTemplate()
    {
        return $this->twigTemplate;
    }

    /**
     * Set the value of twigTemplate
     *
     * @return  self
     */ 
    public function setTwigTemplate($twigTemplate)
    {
        $this->twigTemplate = $twigTemplate;

        return $this;
    }

    /**
     * Get the value of results
     */ 
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Set the value of results
     *
     * @return  self
     */ 
    public function setResults($results)
    {
        $this->results = $results;

        return $this;
    }

    /**
     * Get the value of enabledRoles
     */ 
    public function getEnabledRoles()
    {
        return $this->enabledRoles;
    }

    /**
     * Set the value of enabledRoles
     *
     * @return  self
     */ 
    public function setEnabledRoles($enabledRoles)
    {
        $this->enabledRoles = $enabledRoles;

        return $this;
    }
}