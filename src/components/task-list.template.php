<ul>
  <?php
  foreach ($this->tasks as $task) {
    require __DIR__ . '/task-list-item.template.php';
  }
  ?>
  <?php if ($this->overdueTasks) : ?>
    <div class="separator">
      <div></div>
      <p>Overdue</p>
      <div></div>
    </div>

  <?php
    foreach ($this->overdueTasks as $task) {
      require __DIR__ . '/task-list-item.template.php';
    }

  endif;
  ?>
</ul>