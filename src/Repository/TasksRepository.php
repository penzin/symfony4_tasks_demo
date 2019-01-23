<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Repository\TasksRepositoryInterface;
use App\Entity\Tasks;

/**
 * Класс репозитория сущности Tasks
 */
class TasksRepository extends ServiceEntityRepository implements TasksRepositoryInterface
{
    /**
     * Конструктор класса репозитория
     * 
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tasks::class);
    }
    
    
    /**
     * Получаем упорядоченные особым образом задачи
     * 
     * @return type
     */
    public function getOrderedTasks()
    {
        return $this->getEntityManager()
            ->createQuery("
                SELECT 
                    t
                FROM 
                    App\Entity\Tasks t
                ORDER BY 
                    t.state.state ASC, t.priority.priority DESC
            ")->getResult();
    }
}