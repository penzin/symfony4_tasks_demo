<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tags;

/**
 * Сервис для генерации тегов
 */
class TagGeneratorService
{
    /**
     *
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;
    
    
    /**
     * Конструкто класса
     * 
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em) 
    {
        $this->em = $em;
    }    
    
    /**
     * Фактическая генерация тегов
     */
    public function generate() : void
    {
        $possibleTags = [
            'Бытовое', 
            'Профессиональное', 
            'Личное', 
            'Финансы', 
            'Здоровье',
            'Хобби',
            'Срочно',
            'Интересно'
        ];
        
        foreach ($possibleTags as $tag)
        {
            $newTag = new Tags();
            $newTag->setName($tag);
            $this->em->persist($newTag);
        }
        
        $this->em->flush();
    }
}
