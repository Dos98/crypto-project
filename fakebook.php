<?php
    /**
     * Created by PhpStorm.
     * User: HP
     * Date: 04-11-2017
     * Time: 01:08
     */
    $arr=array();
    session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<h1>Welcome to FaKeBOok</h1>
<h3>Ayush Dosaj</h3>
<h4>
    <p>
        Ayush Dosaj made a cryptography mini project!!
    </p>
    <dl>
    <?php
        if(isset($_POST["button"])){
            if(isset($_SESSION["comments"])) {
                $arr = json_decode($_SESSION["comments"]);
                foreach ($arr as $r) {
                    echo '<br><p>-->>';
                    echo $r;
                    echo '</p><br>';
                }
            }
            if (isset($_POST['comment'])) {
                echo '<br><p>-->>';
                $com = $_POST['comment'];
                //$com=strip_tags($_POST["comment"]);
                echo $com;
                echo '</p><br>';
            }
            array_push($arr,strip_tags($com));
            $_SESSION["comments"]=json_encode($arr);
        }

    ?>
    </dl>
</h4>

<form method="post" action="fakebook.php">
    <textarea name="comment"
              rows="5" cols="100" placeholder="Comment here.."></textarea>
    &nbsp;&nbsp;
    <button name="button" type="submit" value="Submit">Comment</button>
</form>
    <a href="protect.php" >Protect Me</a>

<h3>Example on Cross-Site scripting</h3>
<h3>Perform scripts</h3>
<p>script>alert('I can do anything here.....')/script></p>
<p>script>window.location = 'https://d15shllkswkct0.cloudfront.net/wp-content/blogs.dir/1/files/2014/01/googles-new-portal-provides-help-for-hacked-sites.jpg'/script></p>
</body>
</html>

