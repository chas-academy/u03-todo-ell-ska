<div id="add-list-modal" class="modal hidden">
  <form action="/actions/lists/handler.php" method="post">
    <input type="hidden" name="action" value="create">
    <div>
      <label for="list">New list</label>
      <input type="text" name="name" id="name" placeholder="Name" required>
    </div>
    <button type="submit">Add list</button>
  </form>
</div>