<?php

namespace App\Entity\Tasks;

use Doctrine\DBAL\Exception\InvalidArgumentException as E;
use Doctrine\ORM\Mapping as ORM;

/**
 * Value Object: Приоритет задачи
 * 
 * @ORM\Embeddable()
 */
class TaskPriority
{
    /**
     * @var int Текущий приоритет
     * @ORM\Column(name="priority", type="integer", nullable=false) 
     */
    private $priority;
    
    
    /**
     * @var array Возможные приоритеты 
     */
    private static $priorities = [
        'Низкий'    => 1,
        'Средний'   => 2,
        'Высокий'   => 3,
    ];
    
    
    /**
     * Конструктор класса
     * 
     * @var int Приоритет
     */
    public function __construct(int $priority) 
    {
        if (!in_array($priority, array_values(self::$priorities))) {
            throw new E('Неверное значение приоритета!');
        }
        
        $this->priority = $priority;         
    }
    
    
    /**
     * Распечатка приоритета
     * 
     * @return string 
     */
    public function __toString() : string
    {
        return $this->getPriorityLabel();
    }
    
    
    /**
     * Получение перечня возможных приоритетов
     * 
     * @return array
     */
    public static function getList() : array
    {
        return self::$priorities;
    }
    
        
    /**
     * Возвращение значения текущего приоритета
     * 
     * @return int
     */
    public function getPriority() : int
    {
        return $this->priority;
    }
    
    
    /**
     * Возвращение наименования текущего приоритета
     */
    public function getPriorityLabel() : string
    {
        return array_search($this->priority, self::$priorities);
    }
}

