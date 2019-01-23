<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Tags
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity
 */
class Tags
{
    /**
     * @var UuidInterface
     *
     * @ORM\Column(name="id", type="uuid", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tasks", mappedBy="idTag")
     */
    private $idTask;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->idTask = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    /**
     * Получение ID объекта
     * 
     * @return UuidInterface
     */
    public function getID() : UuidInterface
    {
        return $this->id;
    }    
    
    
    /**
     * Устанавливает наименование тега
     * 
     * @param string $name
     */
    public function setName(string $name) : void 
    {
        $this->name = $name;
    }
    
    
    /**
     * Возвращает наименование тега
     * 
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    
    

}
