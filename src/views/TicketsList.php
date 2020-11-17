<?php require_once("Modules/Layout.php"); ?>
<body>
  <?php require_once("Modules/Header.php") ?>
  <main class="u-flex u-flex-column mt-10">
    <table class="table striped mx-2">
      <thead class="bg-purple-200">
        <tr>
          <th><abbr title="Name of the coder or the team">Coder/Team</abbr></th>
          <th><abbr title="Kind of topic">Topic</abbr></th>
          <th><abbr title="When the ticket was created">Date/Time</abbr></th>
          <th><abbr title="Things you can do with this ticket">Options</abbr></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($data["tickets"] as $ticket) {
          echo "<tr>
                    <td>{$ticket->getCoderTeam()}</td>
                    <td>{$ticket->getTopic()}</td>
                    <td class='u-flex-row'>{$ticket->getDateTime()}</td>
                    <td class='btn-group u-flex-row'>               
                    <a class='btn btn-warning' href='?action=edit&id={$ticket->getId()}'><i class='lnr lnr-pencil'></i></a>
                    <a class='btn btn-danger' href='?action=delete&id={$ticket->getId()}'><i class='lnr lnr-trash'></i></a>
                    <a class='btn btn-success' href='?action=check&id={$ticket->getId()}'><i class='lnr lnr-paperclip'></i></a>
                    </td>
                </tr>";
        } ?>
      </tbody>
    </table>
  </main>
</body>

</html>