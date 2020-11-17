<?php require_once("Modules/Layout.php"); ?>

<body>
  <header class="u-flex u-center u-flex-row header header-fixed u-unselectable p-1">
    <h1 class="header-brand">Archived Tickets</h1>
      <a class="btn btn-info mx-2" href="index.php">
        <i class="fas fa-arrow-circle-left"></i>
      </a>
  </header>
  <main class="u-flex u-flex-column">
    <table class="table striped mx-2 mt-10">
      <thead class="bg-purple-200">
        <tr>
        <tr>
          <th><abbr title="Name of the coder or the team">Coder/Team</abbr></th>
          <th><abbr title="Kind of topic">Topic</abbr></th>
          <th><abbr title="When the ticket was created">Date/Time</abbr></th>
        </tr>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($data["ticket"] as $ticket) {
          echo "
            <tr>
                <td>{$ticket->getCoderTeam()}</td>
                <td>{$ticket->getTopic()}</td>
                <td>{$ticket->getDateTime()}</td>
            </tr>
            ";
        } ?>
      </tbody>
    </table>
  </main>
</body>

</html>