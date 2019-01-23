<?php

namespace App\Repository;

interface TasksRepositoryInterface 
{
    /**
     * Получаем упорядоченные особым образом задачи
     * 
     * @return type
     */
    public function getOrderedTasks();
}
