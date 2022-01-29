<?php

namespace ICS\SearchBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use ICS\SearchBundle\Entity\SearchResult;
use ICS\SearchBundle\Entity\EntitySearchInterface;
use Doctrine\ORM\EntityManagerInterface;

class SearchController extends AbstractController
{

    /**
     * @Route("/",name="ics-search-homepage")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $search = $request->get('search');
        $selectedClass = $request->get('selectedClass', 0);
        $results = [];
        if ($search) {
            $classes = [];

            $entities = $em->getMetadataFactory()->getAllMetadata();

            foreach ($entities as $className) {
                if (in_array(EntitySearchInterface::class, class_implements($className->getName()))) {
                    $classes[] = $className->getName();
                }
            }

            foreach ($classes as $class) {
                if ($selectedClass == $class || $selectedClass == 0) {
                    $rep = $em->getRepository($class);

                    if (method_exists($rep, 'search')) {
                        $result = new SearchResult($class::getEntityClearName(), $class::getSearchTwigTemplate());
                        $result->setResults($rep->search($search));
                        $results[] = $result;
                    }
                }
            }
        }

        return $this->render('@Search\index.html.twig', [
            'search' => $search,
            'results' => $results,
            'classes' => $classes,
            'selectClass' => $selectedClass,
        ]);
    }
}
