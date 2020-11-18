<?php

namespace Test\Unit;

use PHPUnit\Framework\TestCase;
use App\model\Ticket;

class TicketTest extends TestCase
{
    public function test_create_ticket_construct()
    {
        // given
        $ticket = new Ticket("pepe", "duda php", "17.11.2020", 1, "quiero pedir una cita para resolver una duda de php");

        // when
        $coderTeam = $ticket->getCoderTeam();
        $topic = $ticket->getTopic();
        $dateTime = $ticket->getDateTime();
        $id = $ticket->getId();
        $description = $ticket->getDescription();

        // then
        $this->assertEquals("pepe", $coderTeam);
        $this->assertEquals("duda php", $topic);
        $this->assertEquals("17.11.2020", $dateTime);
        $this->assertEquals(1, $id);
        $this->assertEquals("quiero pedir una cita para resolver una duda de php", $description);
    }

    // public function test_get_all_method()
    // {
    //     $ticket1 = new Ticket();
    //     // $ticket2 = new Ticket("peper", "duda js", "17.11.2020", 2, "mi duda2");

    //     $place = $ticket1->save("pepe", "duda php", "mi duda");

    //     $result = Ticket::all();

    //     $this->assertEquals([], $place);
    // }

    // public function test_ticket_is_saved() 
    // {
    //     $ticket = new Ticket("pepe", "duda php", "17.11.2020", 1, "mi duda php");

    //     $result = $ticket->save("pepe", "duda php", "mi duda php");

    //     $this->assertEquals("pepe", "duda php", "mi duda php", $result);
    // }

    //public function test_ticket_is_updated() 
//     {
//         $ticket = new Ticket("pepe", "duda php", "17.11.2020", 1, "mi duda php");


//         $result = $ticket->Update("josé", "duda php", "mi duda php jose", 1);
        
//         $getName = $ticket->getCoderTeam();
//         $getTopic = $ticket->getTopic();
//         $getDescription = $ticket->getDescription();

//         $this->assertEquals($getName, $getTopic, $getDescription, $result);
//     }

//     public function test_ticket_is_deleted() 
//     {
//         $ticket = new Ticket("pepe", "duda php", "17.11.2020", 1, "mi duda php");

//         $ticket->save("pepe", "duda php", "mi duda php");

//         $result = $ticket->delete();

//         $this->assertEquals(null, $result);
//     }
    public function test_rename_coder_team()
    {
        $ticket = new Ticket("Olga","php", "no me funciona");
        $ticket -> renameCoderTeam("Jorge");
        $result = $ticket -> getCoderTeam();
        $this -> assertEquals("Jorge", $result);
    }
}
