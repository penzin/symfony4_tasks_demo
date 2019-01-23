<?php

namespace App\Entity\Tasks;

use Doctrine\DBAL\Exception\InvalidArgumentException as E;
use Doctrine\ORM\Mapping as ORM;

/**
 * Value Object: Наименование задачи
 * 
 * @ORM\Embeddable()
 */
class TaskName
{
    /**
     * @var int Текущее наименование
     * 
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;
    
    
    /**
     * Конструктор класса
     * 
     * @var string Наименование
     */
    public function __construct(string $name) 
    {
//        if (mb_strlen($name) > 100) {
//            throw new E('Неверное значение наименования задачи!');
//        }
        
        $this->name = $name;         
    }
    
    
    /**
     * Распечатка наименования
     * 
     * @return string 
     */
    public function __toString() : string
    {
        return $this->getName();
    }
    
        
    /**
     * Возвращение значения текущего наименования
     * 
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }        
}

