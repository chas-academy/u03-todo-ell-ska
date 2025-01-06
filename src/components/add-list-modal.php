<div id="add-list-overlay" class="overlay hidden"></div>
<div id="add-list-modal" class="modal hidden">
  <form action="/actions/lists/handler.php" method="post">
    <div>
      <label for="list">New list</label>
      <input type="text" name="name" id="name" placeholder="Name" required>
    </div>
    <button type="submit" name="action" value="create">Add list</button>
  </form>
</div>