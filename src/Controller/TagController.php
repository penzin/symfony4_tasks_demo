<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Tags;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\TagGeneratorService;

/**
 * Работа с тегами
 */
class TagController extends AbstractController
{
    /**
     * Генерация тегов
     */
    public function generate(TagGeneratorService $tagGenerator)
    {
        $existingTags = $this->getDoctrine()->getRepository(Tags::class)
                ->findAll();
        
        if (count($existingTags) > 0) {
            return new JsonResponse([
                'result'    => 'fail',
                'message'   => 'Тэги уже сгенерированы!'
            ]);
        }
        
        $tagGenerator->generate();
        
        return new JsonResponse([
            'result'    => 'ok',
            'message'   => 'Генерация тегов прошла успешно!'
        ]);        
    }
}
