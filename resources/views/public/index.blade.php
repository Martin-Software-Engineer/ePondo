<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style3.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../../js/homepage.js"></script>

</head>

<body>
@extends('layouts.app')
    <nav>
        <div class="wrapper">
            <div class="logo"><a href="#">ePondo</a></div>
            <input type="radio" name="slide" id="menu-btn">
            <input type="radio" name="slide" id="cancel-btn">
            <ul class="nav-links">
                <label for="cancel-btn" class="btn cancel-btn"><i class="fas fa-times"></i></label>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li>
                    <a href="#" class="desktop-item">Campaign Categories</a>
                    <input type="checkbox" id="showDrop">
                    <label for="showDrop" class="mobile-item">Campaign Categories</label>
                    <ul class="drop-menu">
                    <li><a href="#">Education</a></li>
                    <li><a href="#">Medical and Health</a></li>
                    <li><a href="#">Animals</a></li>
                    <li><a href="#">Non-profit and Charity</a></li>
                    <li><a href="#">Memorial and Funeral</a></li>
                    <li><a href="#">Emergencies</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="desktop-item">Job Categories</a>
                    <input type="checkbox" id="showJob">
                    <label for="showJob" class="mobile-item">Job Categories</label>
                    <div class="job-box">
                        <div class="content">
                            <div class="row">
                                <img src="css/bg.jpg" alt="">
                            </div>
                            <div class="row">
                                <header>Education Services</header>
                                <ul class="job-links">
                                <li><a href="#">Math Tutor</a></li>
                                <li><a href="#">Science Tutor</a></li>
                                <li><a href="#">Physics Tutor</a></li>
                                <li><a href="#">Humanities Tutor</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header>Home Care Services</header>
                                <ul class="job-links">
                                <li><a href="#">Babysitter</a></li>
                                <li><a href="#">Driver</a></li>
                                <li><a href="#">Gardener</a></li>
                                <li><a href="#">Messenger</a></li>
                                <li><a href="#">Cook</a></li>
                                <li><a href="#">Laundry</a></li>
                                <li><a href="#">Housekeeper</a></li>
                                <li><a href="#">Car Washer</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header>Food Services</header>
                                <ul class="job-links">
                                <li><a href="#">Kitchen Staff</a></li>
                                <li><a href="#">Assistant Cook</a></li>
                                <li><a href="#">Baker</a></li>
                                <li><a href="#">Waiter/Waitress</a></li>
                                <li><a href="#">Utility Staff</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header>Storekeeper Services</header>
                                <ul class="job-links">
                                <li><a href="#">Store Crew</a></li>
                                <li><a href="#">Assistant</a></li>
                                <li><a href="#">Manager</a></li>
                                </ul>
                        </div>
                    </div>
                </li>
                <li><a href="#">Community</a></li>
            </ul>
            <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
        </div>
    </nav>


<section class="slideshow-container">

        <div class="slideshow-container">
        <div class="container" style="padding: 40px 0 0 0;">
    <div style=height:200px id="carousel" class="carousel slide" data-ride="carousel" data-interval="false">
        <div class="carousel-inner">
            <div class="carousel-test"></div>

            <div class="carousel-item active">
                <img class="d-block w-100" src="https://steamuserimages-a.akamaihd.net/ugc/940586530515504757/CDDE77CB810474E1C07B945E40AE4713141AFD76/" alt="">
                <div class="carousel-overlay">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="py-2 text-left">Join Us!</h2>
                        <p class="text-left">Be a backer or jobseeker now!</p>
                        <p style="text-align: right !important;">Read More...</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="https://assets.gamepur.com/wp-content/uploads/2020/10/04152721/among-hd.jpg" alt="">
                <div class="carousel-overlay">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="py-2 text-left">Title</h2>
                        <p class="text-left">Be a Backer or Jobseeker now!</p>
                        <p style="text-align: right !important;">Read More...</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="https://wonderfulengineering.com/wp-content/uploads/2016/02/wallpaper-background-2.jpg" alt="">
                <div class="carousel-overlay">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="py-2 text-left">Title</h2>
                        <p class="text-left">Be a Backer or Jobseeker now!</p>
                        <p style="text-align: right !important;">Read More...</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="https://images4.alphacoders.com/936/936378.jpg" alt="">
                <div class="carousel-overlay">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="py-2 text-left">Title</h2>
                        <p class="text-left">Be a Backer or Jobseeker now!</p>
                        <p style="text-align: right !important;">Read More...</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-panel">
            <a class="carousel-control-prev align-items-end" href="#carousel" role="button" data-slide="prev">
                <span class="mb-4"><i class="fa fa-angle-left fa-3x"></i></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next align-items-end" href="#carousel" role="button" data-slide="next">
                <span class="mb-4"><i class="fa fa-angle-right fa-3x"></i></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
</div>
    </section>

    <section style="margin-bottom:100px" class="slideshow-container">
            <h1 style="margin-top: 80px">More to Explore</h1>
            <div class="cards-container">
            <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h3>Services</h3>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 hidden-xs">
                <div class="controls pull-right">
                    <a class="left fa fa-chevron-left btn btn-info " href="#carousel-example" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-info" href="#carousel-example" data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel" data-type="multi">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://c0.wallpaperflare.com/preview/951/764/9/community-community-service-friends-friendship.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Community Service</h5>
                                            <h5 class="detail-price">-</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://www.efinancialcareers.co.uk/binaries/content/gallery/efinancial-careers/articles/2016/03/Waitress.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Waitress</h5>
                                            <h5 class="detail-price">-</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://altlig.com/wp-content/uploads/2018/10/volunteer.png" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Volunteer</h5>
                                            <h5 class="detail-price">-</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://miro.medium.com/max/1000/1*ulIIG4tM8OtkV2ED73ExdQ.jpeg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Laundry</h5>
                                            <h5 class="detail-price">-</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://cdn.kinsights.com/cache/8c/3e/8c3ebc224ce7387340d1399b7f22fbf1.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Tutor</h5>
                                            <h5 class="detail-price">-</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://i2.wp.com/www.culinarycareer.net/wp-content/uploads/2015/10/baker.jpg?fit=1000%2C667" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Baker</h5>
                                            <h5 class="detail-price">-</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://www.homeadvisor.com/r/wp-content/uploads/2016/01/smiling-newly-hired-gardener-634x422.jpeg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Gardener</h5>
                                            <h5 class="detail-price">-</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://www.digitalcreed.in/wp-content/uploads/2016/04/driver.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Driver</h5>
                                            <h5 class="detail-price">-</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>

<h1 style="margin-top:30px" >More to Explore</h1>
            <div class="cards-container">
            <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h3>Products</h3>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 hidden-xs">
                <div class="controls pull-right">
                    <a class="left fa fa-chevron-left btn btn-info " href="#carousel-example" data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-info" href="#carousel-example" data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example" class="carousel slide hidden-xs" data-ride="carousel" data-type="multi">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://api.time.com/wp-content/uploads/2018/11/sweetfoam-sustainable-product.jpg?quality=85" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Tsinelas</h5>
                                            <h5 class="detail-price">-</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://i.ebayimg.com/images/g/lPQAAOSwBRlcmjGR/s-l300.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Product Name</h5>
                                            <h5 class="detail-price">$187.87</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://media.architecturaldigest.com/photos/55e7862d302ba71f301793f4/master/w_400%2Cc_limit/dam-images-shopping-2014-11-handmade-goods-handmade-goods-companies-02-connected-goods.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Product Name</h5>
                                            <h5 class="detail-price">$187.87</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://themakeitcollective.com.au/wp-content/uploads/2020/10/lauren-roberts-439980-unsplash-1800x1200-1.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Product Name</h5>
                                            <h5 class="detail-price">$187.87</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://isteam.wsimg.com/ip/6a21c73c-9ff6-49ee-ba5b-bdf75ee525b8/fb_2748203905204683_1080x1080/:/cr=t:0%25,l:0%25,w:100%25,h:100%25/rs=w:400,cg:true" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Product Name</h5>
                                            <h5 class="detail-price">$187.87</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://in.all.biz/img/in/catalog/464325.jpeg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Product Name</h5>
                                            <h5 class="detail-price">$187.87</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://makeyourboutique.com/wp-content/uploads/2019/11/8-Secrets-To-Selling-Your-Handmade-Goods-On-Shopify.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Product Name</h5>
                                            <h5 class="detail-price">$187.87</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="slider-item">
                                <div class="slider-image">
                                    <img src="https://www.adnc.ca/wp-content/uploads/sites/7/2013/08/IMG_1824.jpg" class="img-responsive" alt="a" />
                                </div>
                                <div class="slider-main-detail">
                                    <div class="slider-detail">
                                        <div class="product-detail">
                                            <h5>Product Name</h5>
                                            <h5 class="detail-price">$187.87</h5>
                                        </div>
                                    </div>
                                    <div class="cart-section">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-6">
                                                <a href="#" class="AddCart btn btn-info"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add To Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>





            <!-- <div class="container">
                <div class="row">


                    <div class="col-sm">
                        <div class="card">
                            <div class="card-image"></div>
                            <div class="text_container">
                                <div>
                                    <h4><b>Tutor</b></h4>
                                    <p>Tutoring Services</p>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button>Click here</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-image"></div>
                            <div class="text_container">
                                <div>
                                    <h4><b>Tutor</b></h4>
                                    <p>Tutoring Services</p>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button>Click here</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-image"></div>
                            <div class="text_container">
                                <div>
                                    <h4><b>Tutor</b></h4>
                                    <p>Tutoring Services</p>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button>Click here</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-image"></div>
                            <div class="text_container">
                                <div>
                                    <h4><b>Tutor</b></h4>
                                    <p>Tutoring Services</p>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button>Click here</button>
                            </div>
                        </div>
                    </div>

                </div> -->
            </div>

    </section>

    <footer class="footer-container">
        <p>ePONDO Capstone Project 2021</p>
    </footer>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>
</html>
