<?php
require_once('conn.php');

if(isset($_GET['truncate'])) {
    $stmt = $conn->prepare('TRUNCATE TABLE tbl_posts');
    $stmt->execute();
    header('location:index.php');
}

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
            <div class="sidebar">
                <div class="sidebar-panel">
                    <div class="handler">
                        <a href="#" class="icon" title="Emmanuel See Te">
                            <span class="image">
                                <img src="img/dp.jpg" />
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
                        <a href="?truncate" class="icon" title="Log out">
                            <span class="image">
                                <img src="img/delete.svg" />
                            </span>
                            <div class="text">
                                Delete All Posts
                            </div>
                        </a>
                    </div>
                </div>
                <div class="sidebar-panel">
                    <div class="links">
                        <a href="https://github.com/mannyseete/" target="_blank">
                            <img src="img/github.svg" />
                        </a>
                        <a href="https://www.facebook.com/insightcoders/" target="_blank">
                            <img src="img/facebook.svg" />
                        </a>
                        <a href="https://twitter.com/MannyGSH" target="_blank">
                            <img src="img/twitter.svg" />
                        </a>
                    </div>
                </div>
                <div class="sidebar-panel">
                    <div class="footer">Please Read the License File<br />&copy; 2016 - InsightCoders</div>
                </div>
            </div>
            <div class="contentarea">
                <div id="post" name="post" class="textarea" contenteditable="true" placeholder="What's up on your day?"></div>
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
            $('[contenteditable]').on('paste', function(e) {
                e.preventDefault();
                var text = '';
                if (e.clipboardData || e.originalEvent.clipboardData) {
                    text = (e.originalEvent || e).clipboardData.getData('text/plain');
                } else if (window.clipboardData) {
                    text = window.clipboardData.getData('Text');
                }
                if (document.queryCommandSupported('insertText')) {
                    document.execCommand('insertText', false, text);
                } else {
                    document.execCommand('paste', false, text);
                }
            });
        </script>
    </body>
</html>
