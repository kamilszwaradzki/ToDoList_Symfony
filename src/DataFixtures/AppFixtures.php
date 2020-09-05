<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Symfony\Component\Finder\SplFileInfo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $file = new SplFileInfo(__DIR__.'/../../var/tasks.txt', '', '');
        $content = $file->getContents();
        $arr_content = preg_split('/\n+/',$content);

        for($i = 0; $i < count($arr_content); $i++) //insert all from tasks.txt
        {
	    $task = new Task();
	    $task->setContent($arr_content[$i]);
	    $task->setStatus(random_int(0,1)); // random status <0,1>
            $manager->persist($task);
        }
        $manager->flush();
    }
}
