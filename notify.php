<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTIFY</title>
</head>
<body>
<h1>NOTIFY</h1>

<h2>GET:</h2>

<pre>
<?php echo json_encode($_GET, JSON_PRETTY_PRINT);?>
</pre>

<h2>POST:</h2>

<pre>
<?php echo json_encode($_POST, JSON_PRETTY_PRINT);?>
</pre>

<h2>Server:</h2>

<pre>
<?php echo json_encode($_SERVER, JSON_PRETTY_PRINT);?>
</pre>
</body>
</html>