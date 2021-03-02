<?php
namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Conversations\Conversations;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use Auth;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function($botman, $message) {

            if ($message == 'hi') {
             //$this->askQ($botman);
            $this->askName($botman);
               
            }else{
                $botman->reply("Sorry I couldn't understand what you said.<br><br>Please type <strong>'hi'</strong> to receive my services.");
            }

        });

        $botman->listen();
    }




    /**
     * Place your BotMan logic here.
     */
    public function askName($botman)
    {
       $question = Question::create('How can I be of service?')
        ->callbackId('agree')
        ->addButtons([
            Button::create('Our systens')->value('0'),
            Button::create('Report a complaint')->value('1'),
            Button::create('View my systems')->value('2'),
            Button::create('View complaint status')->value('3'),
            Button::create('Contact CDRD')->value('4'),
        ]);
    

   $botman->ask($question, function(Answer $answer) {
       
        if ($answer->isInteractiveMessageReply()) {

            if($answer->getValue()=="0"){
                $this->say('<p align="left">Click on the "Complaint" button in the menu-bar to your left to go to the complaint section. Click on the "Add New Complaint" button at the top. Select the system and fill out the necessary details to report a new complaint.</p><br>
                <a href=#>View Complaints</a>');
                
            }
            if($answer->getValue()=="1"){
                $this->say('<p align="left">Click on the "Complaint" button in the menu-bar to your left to go to the complaint section. Click on the "Add New Complaint" button at the top. Select the system and fill out the necessary details to report a new complaint.</p><br>
                <a href=#>View Complaints</a>');
                
            }
            if($answer->getValue()=="2"){
                $this->say('<p align="left">Click on the "Systems" button in the menu-bar to your left to view the systems that you have obtained from CDRD. Click on the system name to view system details.</p><br>
                <a href=#>View Systems</a>');
            //  $this->askQ($botman);
            }
            if($answer->getValue()=="3"){
                $this->say('<p align="left">Click on the "Complaint" button in the menu-bar to your left to go to the complaint section. The table below shows all the complaints that you have reported to CDRD. The "Complaint Status" column shows the status of each complaint that you have reported.</p><br>
                <a href=#>View Complaint Status</a>');
            //   $this->askQ($botman);
            }
            if($answer->getValue()=="4"){
                $this->say('<p align="left">Centre for Defence Research and Development Mahenawaththa,Moragahahena Road, Pitipana, Homagama<br>
                Tel : 011-3173491 / 077-3929482<br>
                Fax : 011-2182175<br>
                Email : hq@crd.lk / hqcrdmod@gmail.com</p>
                ');
            }

            $this->say("Please type <strong>'hi'</strong> to receive my services again.");
        }

    });

    }

    public function askQ($botman)
    {
        $question = Question::create('Which language do you prefer?')
        ->callbackId('agree')
        ->addButtons([
            Button::create('English')->value('1'),
            Button::create('සිංහල')->value('2'),
            Button::create('தமிழ்')->value('3'),
        ]);
    
    
        $botman->ask($question, function(Answer $answer) {
           
             if($answer->getValue()=="1"){
    
                $this->askName($botman);
             }



        });
        

    }

}
