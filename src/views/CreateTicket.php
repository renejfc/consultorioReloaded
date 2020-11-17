<?php require_once("Modules/Layout.php"); ?>
<body>
  <header class="u-flex u-center u-flex-row header header-fixed u-unselectable p-1">
    <h1 class="header-brand">New Ticket</h1>
    <a class="btn btn-info mx-2" href="index.php">
      <i class="fas fa-arrow-circle-left"></i>
    </a>
  </header>
  <main class="u-flex u-flex-column u-center mt-12">
    <form action='?action=store' method="post" class="u-flex u-flex-column">
      <div class="u-flex">
        <label><i class="fas fa-question"></i> Name of the coder and/or the team <input type="text" name="coderTeam" placeholder="El Pepe... PepeTeam..." required></label>
        <label><i class="fas fa-question"></i> What's the topic of the ticket? <input type="text" name="topic" placeholder="PHP Vendor Bug" required></label>
      </div>
      <label class="mt-2"><i class="fas fa-question"></i> What's the description of the problem? <textarea name="description" placeholder="Description" required></textarea></label>
      <div class="btn-group">
        <input type="reset" value="Reset" class="btn outline btn-warning u-center">
        <input type="submit" value="Create" class="btn btn-success u-center">
      </div>
    </form>
  </main>
</body>