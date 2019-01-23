<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use App\Entity\Tasks\TaskPriority;
use App\Entity\Tasks\TaskState;
use App\Entity\Tasks\TaskName;
use Doctrine\Common\Collections\Collection as C;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tasks
 *
 * @ORM\Table(name="tasks")
 * @ORM\Entity()
 */
class Tasks
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
     * @ORM\Embedded(class="App\Entity\Tasks\TaskName", columnPrefix=false)
     */
    private $name;

    /**
     * @var TaskPriority
     *
     * @ORM\Embedded(class="App\Entity\Tasks\TaskPriority", columnPrefix=false)
     */
    private $priority;

    /**
     * @var TaskState
     *
     * @ORM\Embedded(class="App\Entity\Tasks\TaskState", columnPrefix=false)
     */
    private $state;

    /**
     * @var C
     *
     * @ORM\ManyToMany(targetEntity="Tags", inversedBy="idTask")
     * @ORM\JoinTable(name="tasks_tags",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_task", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_tag", referencedColumnName="id")
     *   }
     * )
     */
    private $idTag;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->idTag = new ArrayCollection();
        $this->priority = new TaskPriority(1);
        $this->state = new TaskState(0);
        $this->name = new TaskName('');
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
     * Получение имени объекта
     * 
     * @return string
     */
    public function getName() : string
    {
        return $this->name->getName();
    }
    
    
    /**
     * Получение приоритета
     * 
     * @return int
     */
    public function getPriority() : int
    {
        return $this->priority->getPriority();
    }
    
    
    /**
     * Получение наименования приоритета
     * 
     * @return string
     */
    public function getPriorityLabel() : string
    {
        return $this->priority->getPriorityLabel();
    }    
    
    
    /**
     * Возвращает список тегов
     * 
     * @return C
     */
    public function getIdTag() : C 
    {
        return $this->idTag;
    }
    
    
    /**
     * Получение Статуса
     * 
     * @return int
     */
    public function getState() : int
    {
        return $this->state->getState();
    }  
    
    
    /**
     * Получение наименования статуса
     * 
     * @return string
     */
    public function getStateLabel() : string
    {
        return $this->state->getStateLabel();
    }  
    
    
    /**
     * Получение списка тегов сущности (Наподобие GROUP_CONCAT)
     * 
     * @return string
     */
    public function getTagsString() : string
    {
        $tagNames = [];
        
        foreach ($this->idTag->getValues() as $value)
        {
            $tagNames[] = $value->getName();
        }

        return implode(", ", $tagNames);
    }
    
    
    /**
     * Задание имени для задачи
     * 
     * @param string $name
     */
    public function setName(string $name) : void 
    {
        $this->name = new TaskName($name);
    }
    
    
    /**
     * Задание приоритета
     * 
     * @param int $priority
     */
    public function setPriority(int $priority) : void 
    {
        $this->priority = new TaskPriority($priority);
    }


    /**
     * Задание статуса
     * 
     * @param int $state
     */
    public function setState(int $state) : void 
    {
        $this->state = new TaskState($state);
    }    

}
