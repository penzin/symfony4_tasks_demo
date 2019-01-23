<?php

namespace App\Entity\Tasks;

use Doctrine\DBAL\Exception\InvalidArgumentException as E;
use Doctrine\ORM\Mapping as ORM;

/**
 * Value Object: Статус задачи
 * 
 * @ORM\Embeddable()
 */
class TaskState
{
    /**
     * @var int Текущий статус
     * @ORM\Column(name="state", type="boolean", nullable=false) 
     */
    private $state;
    
    
    /**
     * @var array Возможные приоритеты 
     */
    private static $states = [
        'В работе'    => 0,
        'Завершена'   => 1,
    ];
    
    
    /**
     * Конструктор класса
     * 
     * @var int Статус
     */
    public function __construct(int $state) 
    {
        if (!in_array($state, array_values(self::$states))) {
            throw new E('Неверное значение статуса!');
        }
        
        $this->state = $state;         
    }
    
    
    /**
     * Распечатка статуса
     * 
     * @return string 
     */
    public function __toString() : string
    {
        return $this->getStateLabel();
    }
    
    
    /**
     * Получение перечня возможных статусов
     * 
     * @return array
     */
    public static function getList() : array
    {
        return self::$states;
    }
    
        
    /**
     * Возвращение значения текущего статуса
     * 
     * @return int
     */
    public function getState() : int
    {
        return $this->state;
    }
    
    
    /**
     * Возвращение наименования текущего статуса
     */
    public function getStateLabel() : string
    {
        return array_search($this->state, self::$states);
    }
}

