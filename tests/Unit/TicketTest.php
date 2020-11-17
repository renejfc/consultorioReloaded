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
}
