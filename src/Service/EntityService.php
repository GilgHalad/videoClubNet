<?php 
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class EntityService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getItems($entityName, $keyValue = [])
    {
        $items = [];
        $class = "App\\Entity\\".ucfirst($entityName);
        if(class_exists($class)){
            $items = $this->entityManager->getRepository($class)->findAll();
        }

        return $items;
    }
}
?>