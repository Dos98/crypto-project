<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<h1>COMMAND EXECUTION ON SERVER</h1>
<h2>Search bot</h2>
<form method="GET" action="search_bot.php">
    ENTER URL <input type="text" name="domain">
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>
<main>
    <h1>Note:</h1>
    <p>Many websites make use of command line calls to read files,
        send emails, and perform other native operations.
        <br>
        <br>
        If your site transforms untrusted input into shell commands, you need to take care to <strong>sanitize</strong> the input.
        <br>
        If you don't, an attacker will be able to craft HTTP requests that
        execute whatever command they want.
        <br>
        <br>
        Imagine you run a simple site that performs DNS lookups.
        Your site shells out to the <strong>nslookup</strong>  command, then prints the result.
        <br>
        Since the domain
        parameter is not sanitized, you are vulnerable to command injection.
        <br>
        <br>
        <strong>Mal</strong> is a no-good basement-dweller who wants to hack your
        website.
        <br>
        He has already noticed you are running PHP, and
        wonders how he can take advantage of that.
        <br>
        He guesses that the IP lookup is performed via an operating system
        function, and attempts to tag on an extra command on the end.
        <br>
        <br>
        Mal can see the output of his
        command on the web page. This demonstrates that your site is vulnerable to
        command execution.
        <br>
        He adds a  <strong>| cat /etc/passwd</strong> command  on the end of the search
        term to read a sensitive file on the server.
        <br>
        <br>
        <br>
    </p>
</main>
<?php
    if(isset($_GET["submit"])) {
        if (isset($_GET['domain'])) {
            echo '<pre>';
            $domain = $_GET['domain'];
            $domain=filter_var($domain,FILTER_SANITIZE_URL);
            $lookup = system("nslookup {$domain}");
            echo($lookup);
            echo '</pre>';
        }
    }

?>
</body>
</html>
