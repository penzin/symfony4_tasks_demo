<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Tasks;
use Symfony\Component\HttpFoundation\Request;
use App\Form\TaskForm;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\TasksRepository;
use App\Repository\AnotherTasksRepository;


/**
 * Работа с задачами
 */
class TaskController extends AbstractController
{
    /**
     * Страница списка задач
     */
    public function index(TasksRepository $repository)
    {
        $tasks = $repository->getOrderedTasks();
                
        return $this->render("index/index.html.twig", [
            'tasks' => $tasks
        ]);
    }
    
    
    /**
     * Страница создания новой задачи
     */
    public function add(Request $request)
    {
        $task = new Tasks();        
        
        $taskForm = $this->createForm(TaskForm::class, $task);                           
        $taskForm->handleRequest($request);
        
        if ($taskForm->isSubmitted() && $taskForm->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }        
                
        return $this->render("index/add.html.twig", [
            'form' => $taskForm->createView(),
        ]);
    }
    
    
    /**
     * Страница редактирования задачи
     * 
     * @param string $id
     */
    public function edit(Request $request, AnotherTasksRepository $repository, $id)
    {
        $task = $repository->findOneById($id);
        
        $taskForm = $this->createForm(TaskForm::class, $task, ['isEdit' => true]);
        $taskForm->handleRequest($request);
        
        //обработка AJAX-сабмита
        if ($taskForm->isSubmitted() && $taskForm->isValid()) {
            return $this->updateTask($task);
        }        
        
        return $this->render("index/edit.html.twig", [
            'form'      => $taskForm->createView(),
            'task'      => $task,
        ]);
    }
    
    
    /**
     * Фактическое обновление задачи
     * 
     * @param Tasks $task
     */
    private function updateTask($task)
    {
        $status = 'ok';
        $message = 'Изменения сохранены!';
        
        try {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
        } catch (\Exception $e) {
            $status = 'fail';
            $message = $e->getMessage();
        }
        
        return new JsonResponse([
            'status'    => $status,
            'message'   => $message,
        ]);
    }
}
