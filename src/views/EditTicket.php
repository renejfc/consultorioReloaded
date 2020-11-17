<?php require_once("Modules/Layout.php"); ?>

<body>
  <header class="u-flex u-center u-flex-row header header-fixed u-unselectable p-1">
    <h1 class="header-brand">Edit Ticket</h1>
    <a class="btn btn-info mx-2" href="index.php">
      <i class="fas fa-arrow-circle-left"></i>
    </a>
  </header>
  <main class="u-flex u-flex-column u-center mt-12">
    <form action='?action=update&id=<?php echo $data["ticket"]->getId() ?>' method="post" class="u-flex u-flex-column"; style="width: 100%;">
      <div class="u-flex u-center">
        <label ; style="width: 30rem;">
          <i class="fas fa-question"></i> Name of the coder and/or the team
          <input type="text" name="coderTeam" value='<?php echo $data["ticket"]->getCoderTeam() ?>' required></label>
        <label ; style="width: 30rem;">
          <i class="fas fa-question"></i> What's the topic of the ticket?
          <input type="text" name="topic" value='<?php echo $data["ticket"]->getTopic() ?>' required>
      </label>
      </div>
      <div class="u-flex u-center">
        <label class="mt-2 u-center" ; style="width: 61rem;">
          <i class="fas fa-question"></i> What's the description of the problem?
          <textarea name="description" value='<?php echo $data["ticket"]->getDescription() ?>' required></textarea>
      </label>
      </div>
      <div class="btn-group u-flex-row u-center"; style="width: 61rem;">
        <input type="reset" value="Reset" class="btn outline btn-warning u-center">
        <input type="submit" value="Update" class="btn btn-success u-center">
      </div>
    </form>
  </main>

</body>