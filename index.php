<?php
require_once('conn.php');
$stmt = $conn->prepare('SELECT * FROM tbl_posts ORDER BY post_id DESC');
$stmt->execute();
?>
<!DOCTYPE html>
<!-- 
----    EMMANUEL S. SEE TE 
--> 
<html>
    <head>
        <meta charset="utf-8" />
        <title>Text Area</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <div class="wrapper">
            <div class="">
            <div class="profilearea">
                <div class="handler">
                    <a href="#" class="icon" title="Emmanuel See Te">
                        <span class="image">
                            <img src="https://cloud.githubusercontent.com/assets/6229881/13377640/32001322-de1e-11e5-95e2-208d88a4fd77.jpg" />
                        </span>
                        <div class="text user">
                            Emmanuel See Te
                        </div>
                    </a>
                </div>
                <div class="handler">
                    <a href="#" class="icon" title="News Feed">
                        <span class="image">
                            <img src="img/news.svg" />
                        </span>
                        <div class="text">
                            News Feed
                        </div>
                    </a>
                </div>
                <div class="handler">
                    <a href="#" class="icon" title="Edit Profile">
                        <span class="image">
                            <img src="img/pencil.svg" />
                        </span>
                        <div class="text">
                            Edit Profile
                        </div>
                    </a>
                </div>
                <div class="handler">
                    <a href="#" class="icon" title="Edit Profile">
                        <span class="image">
                            <img src="img/help.svg" />
                        </span>
                        <div class="text">
                            Help
                        </div>
                    </a>
                </div>
                <div class="handler">
                    <a href="#" class="icon" title="Log out">
                        <span class="image">
                            <img src="img/logout.svg" />
                        </span>
                        <div class="text">
                            Log out
                        </div>
                    </a>
                </div>
            </div>
            <div class="contentarea">
                <div id="post" name="post" class="textarea" contenteditable="true" area-multiline="true" placeholder="What's up on your day?" role="combobox" spellcheck="true"></div>
                <div class="contentfooter">
                    <button type="submit" id="submit">Post</button>
                </div>
                <div class="clear"></div>
            </div>
            <span id="test"/>
            <?php
            if($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll();
                foreach($result as $row) {
                    echo $row['post_content'];
                }
            }
            ?>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#submit").click(function(){
                    var post = $("#post").html();
                    if(post != "") {
                        $.post("post.php", { post: post }).done(function( data ){
                            $("#test").prepend( data );
                            $("#post").html("");
                        });
                    }
                });
            });
        </script>
    </body>
</html>
