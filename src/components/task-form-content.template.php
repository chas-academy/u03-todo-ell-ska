<div class="content">
    <label for="name">Task name</label>
    <input type="text" name="name" id="name" value="<?= isset($this->task['name']) ? $this->task['name'] : '' ?>" placeholder="New task" required>
    <label for="note">Task notes</label>
    <textarea name="note" id="note" placeholder="Notes"><?= isset($this->task['note']) ? $this->task['note'] : '' ?></textarea>
</div>