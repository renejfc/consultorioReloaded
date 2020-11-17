<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Ticket;
use App\Logger\Log;


class TicketController
{

  public function __construct()
  {
    if (isset($_GET) && !isset($_GET["action"])) {
      $this->index();
      return;
    }
    if (isset($_GET) && ($_GET["action"] == "create")) {
      $this->create();
      return;
    }

    if (isset($_GET) && ($_GET["action"] == "store")) {
      $this->store($_POST);
      return;
    }

    if (isset($_GET) && ($_GET["action"] == "edit")) {
      $this->edit($_GET["id"]);
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
    if (isset($_GET) && ($_GET["action"] == "check")) {
      $this->check($_GET["id"]);
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

    new View("ticketsList", [
      "tickets" => $ticketList,
    ]);
  }

  public function create(): void
  {
    new View("createTicket");
  }

  public function store(array $request): void
  {
    $newTicket = new Ticket();
    $newTicket->save($request["coderTeam"], $request["topic"], $request["description"]);
    $log = new Log("Create", "Created a new ticket");
    $log->LogInFile();

    $this->index();
  }

  public function delete($id)
  {
    $ticketToDelete = Ticket::findById($id);
    $ticketToDelete->delete();
    $log = new Log("Delete", "Delete a ticket", $id);
    $log->LogInFile();

    $this->index();
  }

  public function edit($id)
  {
    $ticketToedit = Ticket::findById($id);
    new View("EditTicket", ["ticket" => $ticketToedit]);
  }

  public function check($id)
  {
    $ticketDone = Ticket::findById($id);
    new View("DoneTicket", ["ticket" => $ticketDone]);
  }

  public function archive($id)
  {
    $ticketDone = Ticket::findById($id);
    $ticketDone -> archiveDb();
    $log = new Log("Archive", "Ticket archived", $id);
    $log->LogInFile();

    $ticketDoneList = Ticket::allDone();
    new View("doneTicketList", ["ticket" => $ticketDoneList]);
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

    $this->index();
  }
}
