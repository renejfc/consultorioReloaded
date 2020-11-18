<?php

namespace Test\Integration;

use PHPUnit\Framework\TestCase;
use App\DbSession;
use App\Model\Ticket;

class TicketTest extends TestCase
{
    private $database;

    public function initDb(): void
    {
        $database = new DbSession();
        $database->mysql->query("DELETE FROM `agenda`");
        $database->mysql->query("ALTER TABLE `agenda` AUTO_INCREMENT = 1");
        $this->database = $database;

    }

    public function setUp(): void
    {
        $this->initDb();
    }

    public function test_ticket_is_saved() 
    {
        // given
        $this->setUp();
        $ticket = new Ticket("pepe", "duda php", "17.11.2020", 1, "mi duda php");

        // when
        $ticket->save("pepe", "duda php", "mi duda php");
        $result = Ticket::all();

        // then
        $this->assertEquals(1, count($result));
    }


    public function test_get_all_tickets()
    {
        $this->setUp();
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pepe', 'duda' , 'no me sale');");
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pepa', 'duda' , 'no me sale');");
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pipe', 'duda' , 'no me sale');");
  

        $result = Ticket::all();

        $this->assertEquals(3, count($result));
    }

    
    public function test_ticket_is_updated() 
    {
        $this->setUp();
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pepe', 'duda' , 'no me sale');");
        
        $ticketToUpdate = Ticket::findById(1);
        $ticketToUpdate->changeTopic('muchas dudas');
        $ticketToUpdate->Update();
        $result = $ticketToUpdate->getTopic();

        
        $this->assertEquals('muchas dudas', $result);
    }

    public function test_ticket_is_deleted() 
    {
        $this->setUp();
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pepe', 'duda' , 'no me sale');");
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pepa', 'duda' , 'no me sale');");
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pipe', 'duda' , 'no me sale');");
  
        $ticketToDelete = Ticket::findById(1);
        $ticketToDelete->delete();

        $result = count(Ticket::all());

        $this->assertEquals(2,$result);
    }
        
    public function test_ticket_find_by_id() 
    {
        $this->setUp();
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pepe', 'duda' , 'no me sale');");
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pepa', 'duda' , 'no me sale');");
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pipe', 'duda' , 'no me sale');");
  
        $ticketTofind = Ticket::findById(2);

        $result = $ticketTofind->getCoderTeam();

        $this->assertEquals("pepa",$result);
    }


     public function test_ticket_archived() 
    {
        $this->setUp();
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pepe', 'duda' , 'no me sale');");
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pepa', 'duda' , 'no me sale');");
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pipe', 'duda' , 'no me sale');");
  
        $ticketToArchive = Ticket::findById(2);
        $ticketToArchive->archiveDb();

        $ticketArchived = Ticket::allDone();
        $result =  count($ticketArchived);


        $this->assertEquals( 1 ,$result);
    }
   
        
 
}
