<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Repository\TasksRepositoryInterface;
use App\Entity\Tasks;

/**
 * Класс репозитория сущности Tasks
 */
class AnotherTasksRepository extends ServiceEntityRepository implements TasksRepositoryInterface
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
        $qb = $this->createQueryBuilder('t')
            ->addOrderBy('t.state.state', 'ASC')
            ->addOrderBy('t.priority.priority', 'DESC')
            ->getQuery();

        return $qb->execute();            
    }
}