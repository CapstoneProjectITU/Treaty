<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include 'header.php';            
        ?>
        <link rel="icon" href="images/favicon.ico" type="icon">
    </head>    
    <body>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a href="#" class="brand">
                        <img src="images/logoIcon.png" width="240" height="80" alt="Logo" />
                        <!-- This is website logo -->
                    </a>
                    <!-- Navigation button, visible on small resolution -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                    </button>
                    <!-- Main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav" id="top-navigation">
                            <li class="active"><a href="#home">Home</a></li>
                            <li><a href="#service">Customer</a></li>
                            <li><a href="#portfolio">Businesses</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#clients">Clients</a></li>
                            <li><a href="#price">Price</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <?php if(isset($_SESSION['userid'])): ?>
                              <li><a href='logout.php'>Logout</a></li>
                            <?php else: ?>
                               <li><a href='login.php'>Login</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>

        <!-- Start home section -->
        <div id="home">
            <!-- Start cSlider -->
            <div id="da-slider" class="da-slider">
                <!-- mask elemet use for masking background image -->
                <div class="mask"></div>
                <!-- All slides centred in container element -->
                <div class="container">
                    <!-- Start first slide -->
                    <div class="da-slide">
                        <h2 class="fittext2">Retain Your Customers With Treaty</h2>
                        <!-- <h4></h4> -->
                        <p>
                        In today's competitive world where the customer is spoiled for choice, its difficult for a business to retain customers. With Treaty you can stay at the top of your game.
                        Attract customers with loyalty rewards and make them keep coming back. </p>
                        <!-- <a href="#" class="da-link button">Read more</a> -->
                        <div class="da-img">
                            <img src="images/Slider01.png" alt="image01" width="320">
                        </div>
                    </div>
                    <!-- End first slide -->
                    <!-- Start second slide -->
                    <div class="da-slide">
                        <h2>Create Custom Rewards</h2>
                        <!-- <h4></h4> -->
                        <p>Promote customer loyalty with unique and exciting rewards that suits your business. Send them tailer made offers to increase foot traffic at your store.</p>
                        <!-- <a href="#" class="da-link button">Read more</a> -->
                        <div class="da-img">
                            <img src="images/Slider02.png" width="320" alt="image02">
                        </div>
                    </div>
                    <!-- End second slide -->
                    <!-- Start third slide -->
                    <div class="da-slide">
                        <h2>Track Customer Activity</h2>
<!--                         <h4>Customizable</h4>
 -->                        <p>Get to know who your customers are and what brings them back. Treaty provides you a window into knowing what your customers are interested in.</p>
                        <!-- <a href="#" class="da-link button">Read more</a> -->
                        <div class="da-img">
                            <img src="images/Slider03.png" width="320" alt="image03">
                        </div>
                    </div>
                    <!-- Start third slide -->
                    <!-- Start cSlide navigation arrows -->
                    <div class="da-arrows">
                        <span class="da-arrows-prev"></span>
                        <span class="da-arrows-next"></span>
                    </div>
                    <!-- End cSlide navigation arrows -->
                </div>
            </div>
        </div>
        <!-- End home section -->
        <!-- Service section start -->
        <div class="section primary-section" id="service">
            <div class="container">
                <!-- Start title section -->
                <div class="title">
                    <h1>Treaty Reward Program</h1>
                    <!-- Section's title goes here -->
                    <p>How Treaty Reward Program Works for Cutomer?</p>
                    <!--Simple description for section goes here. -->
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <div class="centered service">
                            <div class="circle-border zoom-in">
                                <img class="img-circle" src="images/Service1.png" alt="service 1">
                            </div>
                            <h3>Sign In</h3>
                            <p>Register to our Treaty Reward Program and become a membere of our Treaty Community.</p>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="centered service">
                            <div class="circle-border zoom-in">
                                <img class="img-circle" src="images/Service2.png" alt="service 2" />
                            </div>
                            <h3>Explore & Subscribe</h3>
                            <p>Explore all nearby businesses that support our Treaty Reward Program and subscribe to grab exciting offers.</p>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="centered service">
                            <div class="circle-border zoom-in">
                                <img class="img-circle" src="images/Service3.png" alt="service 3">
                            </div>
                            <h3>Earn & Redeem Rewards</h3>
                            <p>Earn 1 Treaty Reward Point for every $1 you spent. And Redeem your earned rewards using exciting offers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service section end -->
        <!-- Portfolio section start -->
        <div class="section secondary-section " id="portfolio">
            <div class="container">
                <div class=" title">
                    <h1>Businesses Like Yours Depend on Treaty</h1>
                    <p>Register your business and be a part of Treaty Community.</p>
                </div>
                <!-- Start details for portfolio project 1 -->
                <div id="single-project">
                    <div id="slidingDiv" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/c1.jpg" alt="project 1" />
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Good Food Is Good Mood!!</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div><br><br>
                                <p>“It’s wild, but people freak out when they get a reward. It’s like they won the world series they LOVE It. That excitement in my business is priceless. The value to me in Treaty is customer engagement, excitement, and driving repeat business. We’ve seen a rise in our customer base and repeat business, not to mention the A+ accessibility to merchant support that Treaty provides.”</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 1 -->
                    <!-- Start details for portfolio project 2 -->
                    <div id="slidingDiv1" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/c2.jpg" alt="project 2">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>We Bring Delight To Our Retailers!!</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div><br>
                                <p>“The reason we chose Treaty over any other customer reward system is because of the ease of signing customers up, communicating to them through Campaigns, the free app, and the excellent customer service, just to mention a few! A quick tap of the screen, entering an email and they are ready. It only takes a few seconds! The ease of acquiring customer emails and reconnecting with them through the Campaigns is the most beneficial. Our customer database has grown tremendously! People don’t hesitate to give you their email when they get points and rewards for doing so.”</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 2 -->
                    <!-- Start details for portfolio project 3 -->
                    <div id="slidingDiv2" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/c3.jpg" alt="project 3">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Keep Calm And Pamper Yourself!!</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <br><br>
                                <p>“Signing up customers with Treaty is very easy. We already used a frequent flyer system so our customers are happy to have a way to not lose their points if they lose their card. Our email list has grown because nobody ever wanted to give us their email address before Treaty and being able to send them an email to get in touch with them is great. I like seeing how often my customers are coming in. Treaty has made it easier for us to connect with our customers.”</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 3 -->
                    <!-- Start details for portfolio project 4 -->
                    <div id="slidingDiv3" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/c4.jpg" alt="project 4">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>One Stop Shop For Your Daily Needs!!</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <br><br>
                                <p>“The best rewards are experiential. It’s a fun way to interact with customers, and it helps build new clientele. We can reach out to our customers for events, sales or even just new inventory! We even upgraded our program in order to use this tool more frequently. Treaty has helped us get our customer in more frequently to shop!”</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 4 -->
                    <!-- Start details for portfolio project 5 -->
                    <div id="slidingDiv4" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/c5.jpg" alt="project 5">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>You Break It We Fix It!!</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <br><br>
                                <p>“I was one of the first stores that adopted Treaty. We used to have punch cards, and just trying to manage that was kind of a hassle. When we started doing it on a digital platform, we started to see an uptick in people just wanting to come in to check-in. If you have tried punch cards or customer loyalty programs before, this takes it to the next level. It gets your sales associates engaged in the process, and the customer, that younger customer we’re looking for, really get it from the second you put it in the store.”</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 5 -->
                    <!-- Start details for portfolio project 6 -->
                    <div id="slidingDiv5" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/c6.jpg" alt="project 6">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Love For Your Pets!!</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <br><br><br>
                                <p>Treaty has improved my business by getting more consistent repeat business and create more brand loyalty for our customers.”</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 6 -->
                    <!-- Start details for portfolio project 7 -->
                    <div id="slidingDiv6" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/c7.png" alt="project 7">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Feed The Beast!!</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <br><br>
                                <p>“I was one of the first stores that adopted Treaty. We used to have punch cards, and just trying to manage that was kind of a hassle. When we started doing it on a digital platform, we started to see an uptick in people just wanting to come in to check-in. If you have tried punch cards or customer loyalty programs before, this takes it to the next level. It gets your sales associates engaged in the process, and the customer, that younger customer we’re looking for, really get it from the second you put it in the store.”</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 7 -->
                    <!-- Start details for portfolio project 8 -->
                    <div id="slidingDiv7" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/c8.jpg" alt="project 8">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Healthy Outside Starts From Inside!!</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <br><br>
                                <p>“What I like about Treaty is that our members already knew it because they were used to using it in the neighborhood already. Members come in, check in and it’s seamless. It was challenging for us to track customer loyalty on a large scale, so Treaty has allowed us to put some larger pie in the sky prizes out there. We give a free 30 minute massage, we also give free personal training and smoothies. Having the revenue go up and seeing the company grow is a tremendous thing.”</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 8 -->
                    <!-- Start details for portfolio project 9 -->
                    <div id="slidingDiv8" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                            <img src="images/c9.jpeg" alt="project 9">
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>We Are The Best In Making The Shine!!</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <br><br><br>
                                <p>Treaty has improved my business by getting more consistent repeated business and create more brand loyalty for our customers.We provide natural cleaning services that are healthy and eco friendly.”</p>
                            </div>
                        </div>
                    </div>
                    <!-- End details for portfolio project 9 -->
                    <ul id="portfolio-grid" class="thumbnails row">
                        <li class="span4 mix web">
                            <div class="thumbnail">
                                <img src="images/c1.jpg" alt="project 1">
                                <a href="#single-project" class="more show_hide" rel="#slidingDiv">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Restaurants</h3>
                                <!-- <p>Thumbnail caption...</p> -->
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix photo">
                            <div class="thumbnail">
                                <img src="images/c2.jpg" alt="project 2">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv1">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Retailers</h3>
                                <!-- <p>Thumbnail caption...</p> -->
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix identity">
                            <div class="thumbnail">
                                <img src="images/c3.jpg" alt="project 3">
                                <a href="#single-project" class="more show_hide" rel="#slidingDiv2">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Salon & Spa</h3>
                                <!-- <p>Thumbnail caption...</p> -->
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix web">
                            <div class="thumbnail">
                                <img src="images/c4.jpg" alt="project 4">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv3">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Gorcery Stores</h3>
                                <!-- <p>Thumbnail caption...</p> -->
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix photo">
                            <div class="thumbnail">
                                <img src="images/c5.jpg" alt="project 5">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv4">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Auto Repair Shops</h3>
                                <!-- <p>Thumbnail caption...</p> -->
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix identity">
                            <div class="thumbnail">
                                <img src="images/c6.jpg" alt="project 6">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv5">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Pet Stores</h3>
                                <!-- <p>Thumbnail caption...</p> -->
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix web">
                            <div class="thumbnail">
                                <img src="images/c7.png" alt="project 7" />
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv6">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Convenience & Gas</h3>
                                <!-- <p>Thumbnail caption...</p> -->
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix photo">
                            <div class="thumbnail">
                                <img src="images/c8.jpg" alt="project 8">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv7">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Health & Fitness Centers</h3>
                                <!-- <p>Thumbnail caption...</p> -->
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix identity">
                            <div class="thumbnail">
                                <img src="images/c9.jpeg" alt="project 9">
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv8">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Cleaning Services</h3>
                                <!-- <p>Thumbnail caption...</p> -->
                                <div class="mask"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Portfolio section end -->
        <!-- About us section start -->
        <div class="section primary-section" id="about">
            <div class="container">
                <div class="title">
                    <h1>Who We Are?</h1>
                    <p>We are here to help small business communities through Treaty Program.</p>
                </div>
                <div class="row-fluid team">
                    <div class="span4" id="first-person">
                        <div class="thumbnail">
                            <img src="images/sliderup01.jpg" alt="team 1">
                            <h3>Customer Acquisition</h3>
                            <div class="mask">
                                <h2></h2>
                                <p>Attracting new customers is a vital part of your business’s growth—and it doesn’t have to be a headache. That’s why Treaty built tools—using the delight of your customers, and the power of your network—for simple, low-cost, and astonishingly effective customer acquisition.</p>
                            </div>
                        </div>
                    </div>
                    <div class="span4" id="second-person">
                        <div class="thumbnail">
                            <img src="images/sliderup02.jpg" alt="team 1">
                            <h3>Loyalty and Retention</h3>
                            <div class="mask">
                                <h2></h2>
                                <p>Imagine if every person who visited your store for the first time paid you a return visit. Getting new customers to try out your business is a good way to grow—but getting your existing customers to return is even better. With Treaty, you’ll transform casual shoppers into regulars, by sending personalized offers they can’t resist.</p>
                            </div>
                        </div>
                    </div>
                    <div class="span4" id="third-person">
                        <div class="thumbnail">
                            <img src="images/sliderup03.jpg" alt="team 1">
                            <h3>Powerful Promotions</h3>
                            <div class="mask">
                                <h2></h2>
                                <p>We’re huge believers in data—we built our entire system on it—and our reporting tool lets you see your marketing program in action. Through your dashboard, you’ll always have access to intuitively organized and easily navigable insights on how your marketing program is performing, on both a big-picture and a granular level. We think you’ll like what you see.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-text centered">
                    <h3>About Us</h3>
                    <p>Treaty is a loyalty rewards management system that will offer unique and exceptional rewards to places you love to shop or dine. It will be a platform where the business owners and the customers can collaborate and get benefit from each other. Treaty will allow the business owners to post their offers and on the other hand the customers to track the offers and their loyalty points they have earned.</p>
                </div>
                <h3>We achieved</h3>
                <div class="row-fluid">
                    <div class="span6">
                        <ul class="skills">
                            <li>
                                <span class="bar" data-width="80%"></span>
                                <h3>Businesses</h3>
                            </li>
                            <li>
                                <span class="bar" data-width="95%"></span>
                                <h3>Customers</h3>
                            </li>
                            <li>
                                <span class="bar" data-width="68%"></span>
                                <h3>Profit</h3>
                            </li>
                            <li>
                                <span class="bar" data-width="70%"></span>
                                <h3>Retaintions</h3>
                            </li>
                        </ul>
                    </div>
                    <div class="span6">
                        <div class="highlighted-box center">
                            <h1>Need Help?</h1>
                            <p>Please check our FAQ section and get answers for general questions. If you have any other concerns Please feel free to Contact Us.</p>
                            <a href="User/faq.php" class="button button-sp">FAQ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About us section end -->
        <div class="section secondary-section">
            <div class="container centered">
                <p class="large-text">Explore all business locations who supports Treaty Reward program.</p>
                <a href="User/find_location.php" class="button">Find Locations</a>
            </div>
        </div>
        <!-- Client section start -->
        <!-- Client section start -->
        <div id="clients">
            <div class="section primary-section">
                <div class="container">
                    <div class="title">
                        <h1>What Client Say?</h1>
                        <p>Still not convinced that Treaty is the right fit? This is just a small sample of what our customers are saying about thier experience working with us.</p>
                    </div>
                    <div class="row">
                        <div class="span4">
                            <div class="testimonial">
                                <p>"Before Treaty, I used a local marketing text tool, but it didn’t give me the return on investment I was looking for. Treaty does. Believe me, Treaty is a great investment for your business."</p>
                                <div class="whopic">
                                    <div class="arrow"></div>
                                    <img src="images/c1.jpg" class="centered" alt="client 1">
                                    <strong>Restaurant
                                        <small>Owner</small>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="testimonial">
                                <p>"Treaty is the best loyalty system out there. I've been with them for five years and still love it. Treaty helps to retain loyal customers. We got huge response from our custpmers on thanks giving."</p>
                                <div class="whopic">
                                    <div class="arrow"></div>
                                    <img src="images/c3.jpg" class="centered" alt="client 2">
                                    <strong>Spa
                                        <small>Owner</small>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="testimonial">
                                <p>"We brought in $7,500 last Black Friday and then brought in $13,000 this Black Friday. The ONLY thing we did differently was use Treaty Promotions. It’s phenomenal. Treaty is worth to invest."</p>
                                <div class="whopic">
                                    <div class="arrow"></div>
                                    <img src="images/c2.jpg" class="centered" alt="client 3">
                                    <strong>Retailer
                                        <small>Owner</small>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        "Perfection is Achieved Not When There Is Nothing More to Add, But When There Is Nothing Left to Take Away"
                    </p>
                </div>
            </div>
        </div>
        <div class="section third-section">
            <div class="container centered">
                <div class="sub-section">
                    <div class="title clearfix">
                        <div class="pull-left">
                            <h3 style="color: white;">Our Clients</h3>
                        </div>
                        <ul class="client-nav pull-right">
                            <li id="client-prev"></li>
                            <li id="client-next"></li>
                        </ul>
                    </div>
                    <ul class="row client-slider" id="clint-slider">
                        <li>
                            <a href="">
                                <img src="images/cl1.jpg" alt="client logo 1">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/cl2.jpg" alt="client logo 2">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/cl3.jpg" alt="client logo 3">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/cl4.jpg" alt="client logo 4">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/cl5.jpg" alt="client logo 5">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/cl6.jpg" alt="client logo 6">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="images/cl7.jpg" alt="client logo 7">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Price section start -->
        <div id="price" class="section secondary-section">
            <div class="container">
                <div class="title">
                    <h1>Coming Soon..</h1>
                    <p>Affordable Pricing For Every Business<br>Choose a plan that works best for your local store.</p>
                </div>
                <div class="price-table row-fluid">
                    <div class="span4 price-column">
                        <h3>Basic</h3>
                        <ul class="list">
                            <li class="price">$19,99</li>
                            <li><strong>6 Months</strong></li>
                            <li><strong>24/7</strong> Support</li>
                            <li><strong>Upto 500</strong> Customers</li>
                        </ul>
                        <!-- <a href="#" class="button button-ps">BUY</a> -->
                    </div>
                    <div class="span4 price-column">
                        <h3>Pro</h3>
                        <ul class="list">
                            <li class="price">$39,99</li>
                            <li><strong>12 Months</strong></li>
                            <li><strong>24/7</strong> Support</li>
                            <li><strong>Upto 2000</strong> Customers</li>
                        </ul>
                        <!-- <a href="#" class="button button-ps">BUY</a> -->
                    </div>
                    <div class="span4 price-column">
                        <h3>Premium</h3>
                        <ul class="list">
                            <li class="price">$79,99</li>
                            <li><strong>24 Months</strong></li>
                            <li><strong>24/7</strong> Support</li>
                            <li><strong>Unlimited</strong> Customers</li>
                        </ul>
                        <!-- <a href="#" class="button button-ps">BUY</a> -->
                    </div>
                </div>
                <div class="centered">
                    <p class="price-text">We Offer Custom Plans. Contact Us For More Info.</p>
                    <a href="#contact" class="button">Contact Us</a>
                </div>
            </div>
        </div>
        <!-- Price section end -->
        <!-- Newsletter section start -->
        <div class="section third-section">
            <div class="container newsletter">
                <div class="sub-section">
                    <div class="title clearfix">
                        <div class="pull-left">
                            <h3>Newsletter</h3>
                        </div>
                    </div>
                </div>
                <div id="success-subscribe" class="alert alert-success invisible">
                    <strong>Well done!</strong>You successfully subscribet to our newsletter.</div>
                <div class="row-fluid">
                    <div class="span5">
                        <p>Subscribe to our newsletter and receive updates from Treaty Community.</p>
                    </div>
                    <div class="span7">
                        <form class="inline-form">
                            <input type="email" name="email" id="nlmail" class="span8" placeholder="Enter your email" required />
                            <button id="subscribe" class="button button-sp">Subscribe</button>
                        </form>
                        <div id="err-subscribe" class="error centered">Please provide valid email address.</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter section end -->
        <!-- Contact section start -->
        <div id="contact" class="contact">
            <div class="section secondary-section">
                <div class="container">
                    <div class="title">
                        <h1>Contact Us</h1>
                        <p>Feel free to contact us. We will get back to you as soon as possible.</p>
                    </div>
                </div>
                <div class="map-wrapper">
                    <div class="map-canvas" id="map-canvas">Loading map...</div>
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span5 contact-form centered">
                                <h3>Message</h3>
                                <div id="successSend" class="alert alert-success invisible">
                                    <strong>Well done!</strong>Your message has been sent.</div>
                                <div id="errorSend" class="alert alert-error invisible">There was an error.</div>
                                <form id="contact-form" action="php/mail.php">
                                    <div class="control-group">
                                        <div class="controls">
                                            <input class="span12" type="text" id="name" name="name" placeholder="* Your name..." />
                                            <div class="error left-align" id="err-name">Please enter name.</div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input class="span12" type="email" name="email" id="email" placeholder="* Your email..." />
                                            <div class="error left-align" id="err-email">Please enter valid email adress.</div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <textarea class="span12" name="comment" id="comment" placeholder="* Comments..."></textarea>
                                            <div class="error left-align" id="err-comment">Please enter your comment.</div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button id="send-mail" class="message-btn">Send message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="span9 center contact-info">
                        <p class="black">2711 N 1st St, San Jose, CA 95134</p>
                        <p class="info-mail">treatyrewards@gmail.com</p>
                        <p class="black">+1 607 232 9825</p>
                        <div class="title">
                            <h3>We Are Social</h3>
                        </div>
                    </div>
                    <div class="row-fluid centered">
                        <ul class="social">
                            <li>
                                <a href="">
                                    <span class="icon-facebook-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-twitter-circled"></span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="">
                                    <span class="icon-linkedin-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-pinterest-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-dribbble-circled"></span>
                                </a>
                            </li> -->
                            <li>
                                <a href="">
                                    <span class="icon-gplus-circled"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact section edn -->
        <!-- Footer section start -->
        <div class="footer">
            <p style="color: white;">Treaty.com © copyright 2018</p>
        </div>
        <!-- Footer section end -->
        <!-- ScrollUp button start -->
        <div class="scrollup">
            <a href="#">
                <i class="icon-up-open"></i>
            </a>
        </div>
        <!-- ScrollUp button end -->
        <!-- Include javascript -->
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.mixitup.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        <script type="text/javascript" src="js/jquery.bxslider.js"></script>
        <script type="text/javascript" src="js/jquery.cslider.js"></script>
        <script type="text/javascript" src="js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="js/jquery.inview.js"></script>
        <!-- Load google maps api and call initializeMap function defined in app.js -->
        <script async="" defer="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKtmIHbU9xj413vxhL-oJHz8ybTyF60KQ&callback=initializeMap"></script>


        <!-- <script async="" defer="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initializeMap"></script> -->
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>