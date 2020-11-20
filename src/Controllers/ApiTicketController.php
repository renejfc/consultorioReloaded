<?php

namespace App\Controllers;

use App\Model\Ticket;
use App\Logger\Log;


class ApiTicketController
{

  public function __construct()
  {
    if (isset($_GET) && !isset($_GET["action"])) {
      $this->index();
      return;
    }
    
    if (isset($_GET) && ($_GET["action"] == "store")) {
      $this->store($_POST);
      return;
    }

    if (isset($_GET) && ($_GET["action"] == "update")) {
      $this->update($_POST, $_GET["id"]);
      return;
    }

    if (isset($_GET) && ($_GET["action"] == "delete")) {
      $this->delete($_GET["id"]);
      return;
    }

    if (isset($_GET) && ($_GET["action"] == "archive")) {
      $this->archive($_GET["id"]);
      return;
    }
  }

  public function index(): void
  {
    $ticketList = Ticket::all();
    $ticketApi = [];

    foreach ($ticketList as $ticket) {
      $ticketArray =
      [
        "coderName" => $ticket -> getCoderTeam(),
        "topic"  => $ticket -> getTopic(),
        "dataTime"  => $ticket -> getDateTime(),
        "id" => $ticket -> getId()
      ];
      array_push($ticketApi, $ticketArray);
    }

    echo json_encode($ticketApi);

  }

 

  public function store(array $request): void
  {
    $newTicket = new Ticket();
    $newTicket->save($request["coderTeam"], $request["topic"], $request["description"]);
    $lastTicket = Ticket::lastTicket();
    $log = new Log("Create", "Created a new ticket", $lastTicket->getId());
    $log->LogInFile();

    $ticketArray = 
    [
      "coderName" => $newTicket -> getCoderTeam(),
      "topic"  => $newTicket -> getTopic(),
      "dataTime"  => $newTicket -> getDateTime(),
      "id" => $newTicket -> getId()
    ];
    echo json_encode($ticketArray);


    
  }

  public function delete($id)
  {
    $ticketToDelete = Ticket::findById($id);
    $ticketToDelete->delete();
    $log = new Log("Delete", "Delete a ticket", $id);
    $log->LogInFile();

   
  }

  public function archive($id)
  {
    $ticketDone = Ticket::findById($id);
    $ticketDone -> archiveDb();
    $log = new Log("Archive", "Ticket archived", $id);
    $log->LogInFile();

    $ticketDoneList = Ticket::allDone();
    $ticketApi = [];
    foreach ($ticketDoneList as $ticket) {
      $ticketArray =
      [
        "coderName" => $ticket -> getCoderTeam(),
        "topic"  => $ticket -> getTopic(),
        "dataTime"  => $ticket -> getDateTime(),
        "id" => $ticket -> getId()
      ];
      array_push($ticketApi, $ticketArray);
    }

    echo json_encode($ticketApi);
    
  }

  public function update(array $request, $id)
  {
    $ticketToUpdate = Ticket::findById($id);
    $ticketToUpdate->renameCoderTeam($request["coderTeam"]);
    $ticketToUpdate->changeTopic($request["topic"]);
    $ticketToUpdate->changeDescription($request["description"]);
    $ticketToUpdate->Update();

    $log = new Log("Update", "Ticket updated", $id);
    $log->LogInFile();
    $ticketArray = 
    [
      "coderName" => $ticketToUpdate -> getCoderTeam(),
      "topic"  => $ticketToUpdate -> getTopic(),
      "dataTime"  => $ticketToUpdate -> getDateTime(),
      "id" => $ticketToUpdate -> getId()
    ];
    echo json_encode($ticketArray);
  }
}
