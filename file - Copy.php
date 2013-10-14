<?php
require_once("header.php");
?>

<div id="port">
                    <div class="container">
                        <nav>
                            <ul>
                                <li id="all">All</li>
                                <li id="web">Web</li>
                                <li id="print">Print</li>
                                <li id="illustration">Illustration</li>
                                <li id="logo">Logo</li>
                            </ul>
                        </nav>
                        <section class="work">
                            <figure class="illustration">
                                <a href="#">
                                    <img src="images/1.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Illustration</dd>   
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="print">
                                <a href="#">
                                    <img src="images/2.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Print</dd>  
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="logo">
                                <a href="#">
                                    <img src="images/3.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Logo</dd>   
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="web">
                                <a href="#">
                                    <img src="images/4.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Web</dd>    
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="print">
                                <a href="#">
                                    <img src="images/5.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Print</dd>  
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="web">
                                <a href="#">
                                    <img src="images/6.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Web</dd>    
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="print">
                                <a href="#">
                                    <img src="images/7.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Print</dd>  
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="web">
                                <a href="#">
                                    <img src="images/8.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Web</dd>    
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="illustration">
                                <a href="#">
                                    <img src="images/9.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Illustration</dd>   
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="print">
                                <a href="#">
                                    <img src="images/10.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Print</dd>  
                                    </dl>
                                </a>    
                            </figure>       
                            <figure class="web">
                                <a href="#">
                                    <img src="images/11.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Web</dd>    
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="logo">
                                <a href="#">
                                    <img src="images/12.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Logo</dd>   
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="illustration">
                                <a href="#">
                                    <img src="images/13.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Illustration</dd>   
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="web">
                                <a href="#">
                                    <img src="images/14.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Web</dd>    
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="logo">
                                <a href="#">
                                    <img src="images/15.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Logo</dd>   
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="print">
                                <a href="#">
                                    <img src="images/16.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Print</dd>  
                                    </dl>
                                </a>    
                            </figure>   
                            <figure class="print">
                                <a href="#">
                                    <img src="images/16.png" alt="" />
                                    <dl>
                                        <dt>Client</dt>
                                            <dd>Envato</dd>
                                        <dt>Role</dt>
                                            <dd>Print</dd>  
                                    </dl>
                                </a>    
                            </figure>  
                        </section>
                    </div>
                </div>
                <script>
                    $(document).ready(function(){
                        $("h1").click(function(){
                            if ($('#wrapper').hasClass("PortfolioMode")){
                                $("h1").toggleClass("portText");
                                $('#wrapper').animate({height: "100%"}, 700);
                                $('#wrapper').css({"margin-top":"0"})
                                $("#port").slideUp();
                                $("#playing").css({"opacity":1});
                                $("#playing").slideDown();
                                $('#wrapper').removeClass("PortfolioMode")
                            } else {
                                $("h1").toggleClass("portText");
                                $('#wrapper').animate({height: "0%"}, 700);
                                $('#wrapper').css({"margin-top":"10px"});
                                $("#port").slideDown();
                                $('#playing').animate({opacity: 0}, 100);
                                $("#playing").slideUp();
                                $('#wrapper').addClass("PortfolioMode")
                            }
                        });
                    });
                </script>

<?php
require_once("footer.php");
?>