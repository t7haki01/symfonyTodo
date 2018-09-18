<?php
/**
 * Created by PhpStorm.
 * User: kihun
 * Date: 30/08/2018
 * Time: 11:04
 */

namespace App\Controller;

use App\Entity\Todo;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends AbstractController
{
    public function list(Request $request){
        //this is example data for showing to view
/*        $listData = array(
            array(
                'description' => 'Learn Symfony',
                'dueDate' => '30-08-2018',
                'isDone' => false
            ),
            array(
                'description' => 'buy milk',
                'dueDate' => '01-09-2018',
                'isDone' => false
            ),
            array(
                'description' => 'Go to Holiday',
                'dueDate' => '24-12-2018',
                'isDone' => false
            )
        );*/
        $newTodoItem = new Todo();
        $form = $this->createFormBuilder($newTodoItem)
        ->add('description', TextType::class)
        ->add('dueDate', DateType::class)
        ->add('save', SubmitType::class, array('label'=>'Add new'))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $newTodoItem = $form->getData();
            $newTodoItem -> setIsDone(false);
            $entityManager = $this -> getDoctrine() -> getManager();
            $entityManager->persist($newTodoItem);
            $entityManager->flush();
            $this->redirectToRoute('todoList');
        }

        /*$listData = $this->getDoctrine()->getRepository(TodoItem::class)->
                        findBy(array('owner' => $this->getUser()));

        */


        $listData = $this->getDoctrine()->getRepository(Todo::class)->findAll();
        // $listData = $this->getUser()->getTodoItems();
        return $this->render('toDo/list.html.twig', array('todoData' => $listData,
                                                    'addNewItemForm' => $form->createView()));
    }

    public function viewItem(Request $request, $itemId){
        $itemData = $this->getDoctrine()->getRepository(Todo::class)->find($itemId);
        //This part is added while i was absent from school including added parameter Request
        $form = $this->createFormBuilder($itemData)
                ->add('description', TextType::class)
                ->add('dueDate', DateType::class)
                ->add('save', SubmitType::class, array('label' => 'Save item'))
                ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $itemData = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($itemData);
            $entityManager->flush();
        }        
        //Untill here
        return $this->render('toDo/viewItem.html.twig', array('itemData' => $itemData,
                                                              'editForm' => $form->createView()));
    }

    public function deleteItem($itemId){
        $itemData = $this->getDoctrine()->getRepository(Todo::class)->find($itemId);
        $entityManager = $this -> getDoctrine() -> getManager();
        $entityManager->remove($itemData);
        $entityManager->flush();

        return new Response();
    }

    public function completeItem($itemId){
        $itemData = $this->getDoctrine()->getRepository(Todo::class)->find($itemId);
        $entityManager = $this -> getDoctrine() -> getManager();

        if (!$itemData) {
            throw $this->createNotFoundException(
                'No Todo list found for id '.$itemId
            );
        }

        $description = $itemData->getDescription();

        $itemData->setDescription('<strike>'.$description.'</strike>');
        $itemData->setIsDone(true);

        $entityManager->flush();

//        return $this->redirectToRoute('/todolist');
        return new Response();
    }
//This part is added as teacher's solution
    public function toggleItemIsDone($itemId){
        $itemData = $this->getDoctrine()->getRepository(Todo::class)->find($itemId);
        $itemData->setIsDone(!$itemData->getIsDone());
        $entityManager = $this-> getDoctrine() -> getManager();
        $entityManager->persist($itemData);
        $entityManager->flush();
        
        return new Responese();
    }

}