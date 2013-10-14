<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Jazcash" />
        <meta name="keywords" content="jazcash, jasper, cashmore" />
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <link rel="stylesheet/less" href="css/style.less" type="text/css" />
        <link rel="stylesheet/less" href="css/style.css" media="screen">
        <link rel="stylesheet/less" href="css/media-queries.css" media="screen">
        <link rel="icon" type="image/png" href="images/favicon.png" />
        <title>Jazcash.com | Home</title>
        <script src="less-1.3.3.min.js" type="text/javascript"></script>
        <script src="analytics.js" type="text/javascript"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
        <script src="js/js.js" type="text/javascript"></script>
	</head>
	<body>
        <div id="wrapper">
            <div id="content">
                <div class="portText">Jasper Cashmore</div>
                <ul id="navlist">
                    <li id="steam" title="Steam"><a href="links/steam.php" target="_blank"></a></li>
                    <li id="facebook" title="Facebook"><a href="links/facebook.php" target="_blank"></a></li>
                    <li id="twitter" title="Twitter"><a href="links/twitter.php" target="_blank"></a></li>
                    <li id="skype" title="Skype"><a href="links/skype.php" target="_blank"></a></li>
                    <li id="gmail" title="Gmail"><a href="links/gmail.php" target="_blank"></a></li>
                    <li id="lastfm" title="Last.fm"><a href="links/lastfm.php" target="_blank"></a></li>
                </ul>
                <div id="post">

                        <div id='figure'>
                            <img src="images/thing.png"/>
                            <span class='caption infoBox'>
                                <div id="brief">
                                    <p class="title">This is a title</p>
                                    <p class="date">12/12/2012</p>
                                    <p class="tools">Adobe Fireworks, Sublime Text 2</p>
                                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                </div>
                            </span>
                        </div>

                        <div id='figure'>
                            <img src="images/111.png"/>
                            <span class='caption normal'>
                                Image description goes here.
                            </span>
                        </div>

                        <iframe src="http://www.youtube-nocookie.com/embed/blvThQHCOxM?rel=0" frameborder="0" allowfullscreen></iframe>

                        <iframe src="http://www.youtube-nocookie.com/embed/dVOibSJV4Ms?rel=0" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
	</body>
</html>
<script>
    $(document).ready(function(){
        $("#wrapper").css({
            "height": "0%",
            "margin-top": "10px"
        });

        //Prevents scrolling of parent element when child element is hovered over
        function preventDefault(e){
            e = e || window.event;
            if( e.preventDefault )
                e.preventDefault();
            e.returnValue = false;  
        }
        document.getElementById('brief').onmousewheel = function(e){
            console.log(this);
            document.getElementById('brief').scrollTop -= e. wheelDeltaY;
            preventDefault(e);
        }
    });
</script>