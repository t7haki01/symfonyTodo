<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Todo;
use App\Entity\User;


class TodoappCheckDueItemsCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'todoapp:check-due-items';

    protected function configure()
    {
        $this
            ->setDescription('Check due items and sends email notification')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }
        $em = $this->getContainer()->get('doctrine')->getManager();
        $hs = $this->getContainer()->get('doctrine')->getManager();

        $todoItems = $em->getRepository(Todo::class)->findAll();
        $users = $hs->getRepository(User::class)->findAll();
        
        // foreach($todoItems as $t){
        //     $output->writeln("Description: " . $t->getDescription());
        // }


        //from here test

        $today = new \DateTime();
        foreach($todoItems as $t){
            if( $t->getDueDate() < $today){
                //From here teacher's solution
                $email = new \SendGrid\Mail\Mail();
                $email->setFrom("test@example.com", "Example User");
                $email->setSubject("Sending with SendGrid is Fun");
                /*this part at this moment i did not have so i modify little*/
//                $email->addTo($t->getOwner()->getEmail(),"");
                $email->addTo("t7haki01@students.oamk.fi","");
                $email->addContent("text/plain", "Your todo item is due, description: " . $t->getDescription());

                $htmlContent = $this->getContainer()->get('twig')->render('email/dueItem.html.twig', array('description' => $t->getDescription(),
                                                                                                                'dueDate' => $t->getDuedate()));

//                $email->addContent(
//                    "text/html", "Your todo item is due, description: ". $t->getDescrioption()
//                );

                $email->addContent("text/html", $htmlContent);
                $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
                try {
                    $response = $sendgrid->send($email);
                    $output->writeln($response->statusCode());
//                    print_r($response->headers());
//                    print $response->body() . "\n";

                } catch (Exception $e) {
                    $output->writeln('Caught exception: '. $e->getMessage());
                }

                //until here teacher's

//                $output->writeln("Description: " . $t->getDescription());
//                $output->writeln("Due date: " . $t->getDueDate()->format('d.m.Y'));
                //from here when due date is expired then it would send mail
//                $isLate = true ;
//                $userEmail = $t->getEmail();
//                $username = $t->getUsername();
//                $description = $t->getDescription();
//                if($isLate === true){
//                    $email = new \SendGrid\Mail\Mail();
//                    $email->setFrom("test@example.com", "Example User");
//                    $email->setSubject("Sending with SendGrid is Fun");
//                    $email->addTo($userEmail, $username);
//                    $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
//                    $email->addContent(
//                        "text/html", "Following ToDo<br><strong>$description</strong><br>has expired."
//                    );
//                    $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
//                    try {
//                        $response = $sendgrid->send($email);
//                        print $response->statusCode() . "\n";
//                        print_r($response->headers());
//                        print $response->body() . "\n";
//                        //for teseting we change print then output write
////            $output->writeln($response->statusCode());
////            $output->writeln($response->headers());
////            $output->writeln($response->body());
//
//                    } catch (Exception $e) {
//                        echo 'Caught exception: '. $e->getMessage() ."\n";
//                    }
//                }
            }
        }
        // $io->writeln('test');
//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        //from here sending email
    }

//    function emailTo($userEmail, $username, $description){
//        $email = new \SendGrid\Mail\Mail();
//        $email->setFrom("test@example.com", "Example User");
//        $email->setSubject("Sending with SendGrid is Fun");
//        $email->addTo($userEmail, $username);
//        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
//        $email->addContent(
//            "text/html", "Following ToDo<br><strong>$description</strong><br>has expired."
//        );
//        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
//        try {
//            $response = $sendgrid->send($email);
//            print $response->statusCode() . "\n";
//            print_r($response->headers());
//            print $response->body() . "\n";
//            //for teseting we change print then output write
////            $output->writeln($response->statusCode());
////            $output->writeln($response->headers());
////            $output->writeln($response->body());
//
//        } catch (Exception $e) {
//            echo 'Caught exception: '. $e->getMessage() ."\n";
//        }
//    }
}
