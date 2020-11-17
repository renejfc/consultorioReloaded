<?php

namespace App\Model;

use App\DbSession;

class Ticket
{
  private ?int $id;
  private ?string $coderTeam;
  private ?string $topic;
  private ?string $dateTime;
  private ?string $description;
  private $database;
  private $table = "agenda";

  public function __construct(string $coderTeam = null, string $topic = null, string $dateTime = null, int $id = null, string $description = null)
  {
    $this->id = $id;
    $this->coderTeam = $coderTeam;
    $this->topic = $topic;
    $this->dateTime = $dateTime;
    $this->description = $description;

    if (!$this->database) {
      $this->database = new DbSession();
    }
  }

  public function getCoderTeam()
  {
    return $this->coderTeam;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getTopic()
  {
    return $this->topic;
  }

  public function getDateTime()
  {
    return $this->dateTime;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function renameCoderTeam($coderTeam)
  {
    $this->coderTeam = $coderTeam;
  }

  public function changeTopic($topic)
  {
    $this->topic = $topic;
  }

  public function changeDescription($description)
  {
    $this->description = $description;
  }

  public function save($coderTeam, $topic, $description): void
  {
    $this->database->mysql->query("INSERT INTO `{$this->table}` (`Coder/Team`, `Topic`, `Description`) VALUES ('{$coderTeam}', '{$topic}' , '{$description}');");
  }

  public static function all()
  {
    $database = new DbSession();
    $query = $database->mysql->query("SELECT * FROM `agenda` WHERE `pendiente` = FALSE");
    $ticketsArray = $query->fetchAll();
    $ticketsList = [];
    foreach ($ticketsArray as $ticket) {
      $ticketItem = new self($ticket["Coder/Team"], $ticket["Topic"], $ticket["Date/Time"], $ticket["ID"]);
      array_push($ticketsList, $ticketItem);
    }

    return $ticketsList;
  }

  // public function deleteById($id)
  // {
  //     $query = $this->database->mysql->query("DELETE FROM `agenda` WHERE `agenda`.`id` = {$id}");
  // }

  public function delete()
  {
    $query = $this->database->mysql->query("DELETE FROM `agenda` WHERE `agenda`.`ID` = {$this->id}");
  }

  public static function findById($id): Ticket
  {
    $database = new DbSession();
    $query = $database->mysql->query("SELECT * FROM `agenda` WHERE `ID` = {$id}");
    $result = $query->fetchAll();


    return new self($result[0]["Coder/Team"], $result[0]["Topic"], $result[0]["Date/Time"], $result[0]["ID"], $result[0]["Description"]);
  }

  public function UpdateById($coderTeam, $topic, $description, $id)
  {
    $this->database->mysql->query("UPDATE `agenda` SET `Coder/Team` = '{$coderTeam}', `Topic` = '{$topic}', `Description` = '{$description}' WHERE `ID` = {$id}");
  }

  public function Update()
  {
    $this->database->mysql->query("UPDATE `agenda` SET `Coder/Team` =  '{$this->coderTeam}', `Topic` = '{$this->topic}', `Description` = '{$this->description}' WHERE `ID` = {$this->id}");
  }

  public function archiveDb()
  {
    $this->database->mysql->query("UPDATE `agenda` SET `pendiente` = true WHERE `agenda`.`ID` = {$this->id}");
  }

  public static function allDone()
  {
    $database = new DbSession();
    $query = $database->mysql->query("SELECT * FROM `agenda` WHERE `pendiente` = TRUE");
    $ticketsArray = $query->fetchAll();
    $ticketsList = [];
    foreach ($ticketsArray as $ticket) {
      $ticketItem = new self($ticket["Coder/Team"], $ticket["Topic"], $ticket["Date/Time"], $ticket["ID"]);
      array_push($ticketsList, $ticketItem);
    }

    return $ticketsList;
  }
}
