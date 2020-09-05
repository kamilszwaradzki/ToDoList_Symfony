<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;

/**
* @Route("/task", name="task")
*/

class TaskController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */    
    public function index()
    {
        return $this->render('task/index.html.twig');
    }

    /**
     * @Route("/show", name="show")
     */
    public function show()
    {
        $tasks = array();
        foreach($this->getDoctrine()->getRepository(Task::class)->findAll() as $task)
        {
            array_push($tasks,['id'=>$task->getId(),'content'=>$task->getContent(),'status'=>$task->getStatus()]);
        }
        return $this->json([
            'data' => $tasks,
        ]);
    }
}
