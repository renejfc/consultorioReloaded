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


    public function test_get_all_method()
    {
        $this->setUp();
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pepe', 'duda' , 'no me sale');");
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pepa', 'duda' , 'no me sale');");
        $this->database->mysql->query("INSERT INTO `agenda` (`Coder/Team`, `Topic`, `Description`) VALUES ('pipe', 'duda' , 'no me sale');");
  

        $result = Ticket::all();

        $this->assertEquals(3, count($result));
    }

    
    // public function test_ticket_is_updated() 
    // {
    //     $ticket = new Ticket("pepe", "duda php", "17.11.2020", 1, "mi duda php");


    //     $result = $ticket->Update("josé", "duda php", "mi duda php jose", 1);
        
    //     $getName = $ticket->getCoderTeam();
    //     $getTopic = $ticket->getTopic();
    //     $getDescription = $ticket->getDescription();

    //     $this->assertEquals($getName, $getTopic, $getDescription, $result);
    // }

    // public function test_ticket_is_deleted() 
    // {
    //     $ticket = new Ticket("pepe", "duda php", "17.11.2020", 1, "mi duda php");

    //     $ticket->save("pepe", "duda php", "mi duda php");

    //     $result = $ticket->delete();

    //     $this->assertEquals(null, $result);
    // }
 
}
