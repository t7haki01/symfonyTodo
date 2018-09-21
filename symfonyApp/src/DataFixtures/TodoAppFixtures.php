<?php
/**
 * Created by PhpStorm.
 * User: kihun
 * Date: 04/09/2018
 * Time: 09:25
 */

namespace App\DataFixtures;

use App\ENtity\User;
use App\Entity\Todo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TodoAppFixtures extends Fixture
{
    public function load(ObjectManager $manager){
        //This part is done while i'm absent
        // $dummyUser = new User();
        // $dummyUser->setEmail('test@test.com');
        // $dummyUser->setUsername('tester');
        // $dummyUser->setPassword(password_hash('test_password', PASSWORD_BCRYPT));
        // $manager->persist($dummyUser);

        $testUser = new User();
        $testUser->setEmail("t7haki01@students.oamk.fi");
        $testUser->setUsername("tester");
        $testUser->setPassword("testtest12");
        $manager->persist($testUser);

        $testUser2 = new User();
        $testUser2->setEmail("t7haki01@students.oamk.fi");
        $testUser2->setUsername("tester2");
        $testUser2->setPassword("testtest22");
        $manager->persist($testUser2);

        $testUser3 = new User();
        $testUser3->setEmail("t7haki01@students.oamk.fi");
        $testUser3->setUsername("tester3");
        $testUser3->setPassword("testtest33");
        $manager->persist($testUser3);

        //Declare the variable from other class file
        $todoItem = new Todo();
        $todoItem->setDescription("Buy some milk");
        $todoItem->setIsDone(false);
        $todoItem->setDueDate(new \DateTime());
        $todoItem->setOwner('tester');
        $manager->persist($todoItem);

        $todoItem2 = new Todo();
        $todoItem2->setDescription("Buy the stamp");
        $todoItem2->setIsDone(false);
        $todoItem2->setDueDate(new \DateTime());
        $todoItem2->setOwner('tester');
        $manager->persist($todoItem2);

        for($i = 1; $i<6; $i++){
            $todoItemLoop = new Todo();
            $todoItemLoop->setDescription("This is example ".$i);
            $todoItemLoop->setIsDone(false);
            $todoItemLoop->setDueDate(new \DateTime());
            $todoItemLoop->setOwner('tester');
            $manager -> persist($todoItemLoop);
        }

        //then after setting the data then it should be persist and flush
//        $manager->persist($todoItem);

        $manager->flush();
    }


}