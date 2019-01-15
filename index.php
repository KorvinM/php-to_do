<?php
  // index.php

include ('includes/header.php');

//add php code here
require_once 'app/init.php';

$itemsQuery = $db->prepare("
  SELECT id, name, done
  FROM items
  WHERE user = :user
");

$itemsQuery->execute(['user'=>$_SESSION['user_id']]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];


?>
<!--add html here -->
<div class="list">
  <header><h1>To Do</h1></header>

  <?php
    if(!empty($items)) : ?>
    <ul class="items">
      <?php foreach ($items as $item): ?>
    <li><span class="item<?php echo $item['done'] ? ' done' : '' ?>">
      <?php echo $item['name']; ?>
        </span>
    <?php
      if(!$item['done']): ?>
        <a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-btn">Mark as done</a>
      <?php endif; ?>
</li>
<?php endforeach; ?>
  </ul>
<?php else : ?>
  <p>You've not added any items.</p>
<?php endif; ?>
  <form class="item-add" action="add.php" method="post">
    <input type="text" name="name" placeholder="Type an item" class="input" autocomplete="off" required >
    <input type="submit" value="add" class="submit">
  </form>

</div>

<?php
// add more php here

include ('includes/footer.php');
