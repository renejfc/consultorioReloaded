<?php

namespace Test\Unit;

use PhpUnit\Framework\TestCase;

use App\model\Ticket;

class TicketTest extends TestCase
{
    public function test_create_ticket_construct()
    {   
        // given
        $ticket = new Ticket("pepe", "duda php", "17.11.2020", 1, "quiero pedir una cita para resolver una duda de php");

        // when
        $coder = $ticket->getCoderTeam();

        // then
        $this->assertEquals("pepe", $coder);
        

    }
}
