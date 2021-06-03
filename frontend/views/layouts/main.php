<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

use yii\helpers\Url;

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

use yii\bootstrap4\Breadcrumbs;
// use yii\bootstrap4\Alert;
use frontend\assets\AppAsset;
use common\widgets\Alert;

use common\models\Category;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>        
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Prata' rel='stylesheet' type='text/css'>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>
<body>
<?php $this->beginBody() ?>

<style>
  /*
    Template Name: SpicyX
    Author : MarkUps
    Author URI: http://www.markups.io/
    Version: 1.0
    Tags: light, white, restaurant, multi page, landing page, custom-colors, Bootstrap, responsive, html5, css3, Sass, template, web template

  */

  /* Table of Content
  ==================================================
  #BASIC TYPOGRAPHY
  #HEADER SECTION
  #NAVBAR SECTION
  #SLIDER SECTION
  #ABOUT US SECTION
  #COUNTER SECTION
  #MENU ITEM SECTION
  #RESERVATION SECTION
  #GALLERY SECTION
  #TESTIMONIAL SECTION
  #SUBSCRIPTION SECTION
  #CHEF SECTION
  #LATEST NEWS SECTION
  #CONTACT SECTION
  #MAP SECTION
  #BLOG PAGE
  #ERROR  PAGE
  #FOOTER SECTION
  #RESPONSIVE DESIGN
  */
  /* BASE - Base tyles, Variables, Mixins, etc. */
    .bg-nav
    {
        background-color: #222;
    }
    .main-color {
        color: #c1a35f;
    }

  body {
    /* background-color: #ffffff; */
    /* font-family: "Prata", serif; */
    color: #333333;
    font-size: 15px;
    overflow-x: hidden;
  }

  .no-padding {
    padding: 0;
  }

  /* MODULES - Individual site components */
  ul {
    padding: 0;
    margin: 0;
    list-style: none;
  }

  a {
    text-decoration: none;
    color: #333333;
  }

  a:hover,
  a:focus {
    outline: none;
    text-decoration: none;
  }

  h1, h2, h3, h4, h5, h6 {
    font-family: "Open Sans", sans-serif;
  }

  h2 {
    font-size: 30px;
    font-weight: 700;
    line-height: 40px;
    margin: 0;
  }

  img {
    border: none;
  }
  .mu-readmore-btn {
    background-color: #fff;
    font-family: "Open Sans", sans-serif;
    display: inline-block;
    font-size: 16px;
    padding: 15px 35px;
    position: relative;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -ms-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
  }
  .mu-readmore-btn::after {
    bottom: 5px;
    content: "";
    left: 5px;
    position: absolute;
    right: 5px;
    top: 5px;
    -webkit-transition: all 0.2s;
    -moz-transition: all 0.2s;
    -ms-transition: all 0.2s;
    -o-transition: all 0.2s;
    transition: all 0.2s;
  }
  .mu-readmore-btn:hover, .mu-readmore-btn:focus {
    color: #fff;
  }
  .mu-readmore-btn:hover::after, .mu-readmore-btn:focus::after {
    bottom: 0px;
    content: "";
    left: 0px;
    right: 0px;
    top: 0px;
  }

  .mu-browsmore-btn {
    background-color: #fff;
    border: 1px solid #ccc;
    display: inline-block;
    font-size: 16px;
    line-height: 18px;
    letter-spacing: 0.5px;
    padding: 12px 25px;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -ms-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
  }
  .mu-browsmore-btn:hover, .mu-browsmore-btn:focus {
    color: #fff;
  }

  .mu-send-btn {
    background-color: transparent;
    border: 1px solid #ccc;
    display: inline-block;
    font-size: 16px;
    padding: 10px 18px;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -ms-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
  }
  .mu-send-btn:hover, .mu-send-btn:focus {
    color: #fff;
  }
  /* ALL SECTION */

  /*scrol to top*/
  .scrollToTop {
    bottom: 60px;
    color: #fff;
    display: none;
    font-size: 17px;
    line-height: 22px;
    font-family: "Open Sans", sans-serif;
    padding: 5px 0;
    position: fixed;
    right: 20px;
    text-align: center;
    text-decoration: none;
    width: 55px;
    z-index: 999;
    -webkit-transition: all 0.5s ease 0s;
    -moz-transition: all 0.5s ease 0s;
    -ms-transition: all 0.5s ease 0s;
    -o-transition: all 0.5s ease 0s;
    transition: all 0.5s ease 0s;
  }
  .scrollToTop i {
    display: block;
  }
  .scrollToTop span {
    display: block;
    text-transform: uppercase;
    font-size: 14px;
    font-weight: bold;
  }

  .scrollToTop:hover,
  .scrollToTop:focus {
    color: #fff;
  }

  /*Preloader*/
  #aa-preloader-area {
    background-color: #fff;
    position: fixed;
    text-align: center;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
  }

  .mu-preloader {
    position: relative;
    top: 45%;
  }

  /*==================
    ABOUT US SECTION
  ====================*/
  #mu-about-us {
    display: inline;
    float: left;
    width: 100%;
    padding: 100px 0;
  }
  #mu-about-us .mu-about-us-area {
    display: inline;
    float: left;
    width: 100%;
  }
  #mu-about-us .mu-about-us-area .mu-about-us-left {
    display: inline;
    float: left;
    margin-top: 20px;
    padding-top: 30px;
    width: 100%;
  }
  #mu-about-us .mu-about-us-area .mu-about-us-left p {
    line-height: 24px;
  }
  #mu-about-us .mu-about-us-area .mu-about-us-left ul {
    margin-bottom: 20px;
    padding-left: 20px;
  }
  #mu-about-us .mu-about-us-area .mu-about-us-left ul li {
    line-height: 24px;
    margin-bottom: 10px;
  }
  #mu-about-us .mu-about-us-area .mu-about-us-left ul li:before {
    content: "\f24d";
    font-family: fontAwesome;
    margin-right: 10px;
  }
  #mu-about-us .mu-about-us-area .mu-about-us-right {
    display: inline;
    float: left;
    margin-top: 20px;
    padding-top: 30px;
    width: 100%;
  }
  .mu-title {
    display: inline;
    float: left;
    width: 100%;
    margin-bottom: 20px;
    text-align: center;
  }
  .mu-title .mu-subtitle {
    font-size: 50px;
    font-family: "Tangerine", cursive;
    line-height: 30px;
  }
  .mu-title h2 {
    color: #000;
    font-size: 35px;
    margin-bottom: 5px;
  }
  .mu-title i {
    font-size: 18px;
  }
  .mu-title .mu-title-bar {
    position: relative;
  }
  .mu-title .mu-title-bar::before {
    content: "";
    height: 2px;
    left: 8px;
    position: absolute;
    top: 10px;
    width: 100px;
  }
  .mu-title .mu-title-bar::after {
    content: "";
    height: 2px;
    right: 15px;
    position: absolute;
    top: 10px;
    width: 100px;
  }

 
  /*==================
  MENU ITEM SECTION
  ====================*/
  #mu-restaurant-menu {
    display: inline;
    float: left;
    width: 100%;
    padding: 100px 0;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area {
    display: inline;
    float: left;
    width: 100%;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content {
    display: inline;
    float: left;
    margin-top: 30px;
    width: 100%;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-restaurant-menu {
    display: inline-block;
    width: 100%;
    text-align: center;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-restaurant-menu li {
    display: inline-block;
    float: none;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-restaurant-menu li a {
    font-family: "Open Sans", sans-serif;
    font-size: 18px;
    border-radius: 0;
    color: #fff;
    font-size: 18px;
    margin: 0 15px;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -ms-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-restaurant-menu .active a,
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-restaurant-menu .active a:hover,
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-restaurant-menu .active a:focus {
    background-color: #FFF;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area {
    display: inline;
    float: left;
    width: 100%;
    padding: 50px 0;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-tab-content-left {
    display: inline;
    float: left;
    padding-right: 15px;
    width: 100%;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-tab-content-right {
    display: inline;
    float: left;
    padding-left: 15px;
    width: 100%;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-menu-item-nav li {
    border-bottom: 1px dashed #ccc;
    display: inline;
    float: left;
    margin-bottom: 20px;
    padding-bottom: 15px;
    width: 100%;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-menu-item-nav li:last-child {
    border-bottom: none;
    margin-bottom: 0;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-menu-item-nav li .media .media-left {
    width: 110px;
    height: 110px;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-menu-item-nav li .media .media-left a img {
    width: 110px;
    height: 110px;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-menu-item-nav li .media .media-body .media-heading {
    font-size: 20px;
    margin-bottom: 10px;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-menu-item-nav li .media .media-body .media-heading a {
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -ms-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
  }

  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-menu-item-nav li .media .media-body .mu-menu-price {
    font-size: 20px;
    font-weight: bold;
    letter-spacing: 1.5px;
    line-height: 20px;
  }
  #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-menu-item-nav li .media .media-body p {
    margin-top: 10px;
    font-size: 14px;
  }

  /*==================
  RESERVATION SECTION
  ====================*/
  #mu-reservation {
    background-color: #222;
    display: inline;
    float: left;
    padding: 100px 0;
    width: 100%;
  }
  #mu-reservation .mu-reservation-area {
    display: inline;
    float: left;
    width: 100%;
  }
  #mu-reservation .mu-reservation-area .mu-title h2 {
    color: #fff;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content {
    display: inline;
    float: left;
    margin-top: 20px;
    padding: 0 100px;
    width: 100%;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content h3 {
    color: #fff;
    display: inline-block;
    padding-bottom: 10px;
    font-weight: bold;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content p {
    color: #fff;
    letter-spacing: 0.5px;
    padding: 0 50px;
    text-align: center;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form {
    margin-top: 30px;
    text-align: center;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form .form-control {
    margin-bottom: 20px;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="text"],
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="email"] {
    border-radius: 0;
    color: #000;
    height: 40px;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="text"]:focus,
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="email"]:focus {
    box-shadow: none;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="text"]::-webkit-input-placeholder,
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="email"]::-webkit-input-placeholder {
    color: #555;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="text"]:-moz-placeholder,
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="email"]:-moz-placeholder {
    color: #555;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="text"]::-moz-placeholder,
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="email"]::-moz-placeholder {
    color: #555;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="text"]:-ms-input-placeholder,
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form input[type="email"]:-ms-input-placeholder {
    color: #555;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form select {
    border-radius: 0;
    height: 40px;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form select:focus {
    box-shadow: none;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form select option {
    margin-bottom: 10px;
    color: #000;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form textarea {
    border-radius: 0;
    color: #000;
    padding: 10px;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form textarea:focus {
    box-shadow: none;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form textarea::-webkit-input-placeholder {
    color: #555;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form textarea:-moz-placeholder {
    color: #555;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form textarea::-moz-placeholder {
    color: #555;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form textarea:-ms-input-placeholder {
    color: #555;
  }
  #mu-reservation .mu-reservation-area .mu-reservation-content .mu-reservation-form button[type="submit"] {
    border: none;
    margin-top: 20px;
    margin-left: 15px;
  }

  .datepicker {
    border-radius: 0;
    padding: 6px 10px;
  }

  .datepicker .datepicker-switch, .datepicker .prev, .datepicker .next, .datepicker tfoot tr th {
    font-size: 20px;
  }

  .table-condensed > thead > tr > th, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > tbody > tr > td, .table-condensed > tfoot > tr > td {
    padding: 6px;
  }

  .datepicker table tr td.day:hover {
    color: #fff;
  }
  
  /*==================
  CONTACT SECTION
  ====================*/
  #mu-contact {
    display: inline;
    float: left;
    padding: 100px 0;
    width: 100%;
  }
  #mu-contact .mu-contact-area {
    display: inline;
    float: left;
    width: 100%;
  }
  #mu-contact .mu-contact-area .mu-contact-content {
    display: inline;
    float: left;
    margin-top: 30px;
    width: 100%;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-left {
    display: inline;
    float: left;
    font-family: "Open Sans", sans-serif;
    width: 100%;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-left .form-group {
    margin-bottom: 25px;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-left .form-group label {
    font-size: 16px;
    margin-bottom: 8px;
    letter-spacing: 0.5px;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-left .mu-contact-form input[type="text"],
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-left .mu-contact-form input[type="email"] {
    color: #000;
    border-radius: 0;
    height: 40px;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-left .mu-contact-form input[type="text"]:focus,
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-left .mu-contact-form input[type="email"]:focus {
    box-shadow: none;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-left .mu-contact-form textarea {
    color: #000;
    border-radius: 0;
    padding: 10px;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-left .mu-contact-form textarea:focus {
    box-shadow: none;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-right {
    display: inline;
    float: left;
    padding: 0 30px;
    width: 100%;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-right .mu-contact-widget {
    display: inline;
    float: left;
    margin-bottom: 25px;
    width: 100%;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-right .mu-contact-widget h3 {
    margin-top: 0px;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-right .mu-contact-widget > p {
    letter-spacing: 0.5px;
    line-height: 26px;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-right .mu-contact-widget address {
    margin-top: 20px;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-right .mu-contact-widget address p {
    letter-spacing: 0.5px;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-right .mu-contact-widget address p i {
    margin-right: 10px;
    width: 20px;
    text-align: center;
  }
  #mu-contact .mu-contact-area .mu-contact-content .mu-contact-right .mu-contact-widget address p span {
    display: inline-block;
    margin-right: 20px;
    min-width: 130px;
  }

  /*==================
  MAP SECTION
  ====================*/
  #mu-map {
    display: inline;
    float: left;
    height: 450px;
    width: 100%;
  }
  #mu-map iframe {
    width: 100%;
    height: 100%;
  }

  
  /*==================
  RESPONSIVE DESIGN
  ====================*/
  @media (max-width: 1199px) {
    .mu-main-navbar .mu-main-nav li a {
      padding-left: 10px;
      padding-right: 10px;
    }

    #mu-slider .mu-slider-area .mu-top-slider .mu-top-slider-single img {
      width: auto;
    }

    #mu-subscription .mu-subscription-area {
      padding: 0 50px;
    }

    #mu-chef .mu-chef-area .mu-chef-content .mu-chef-nav .slick-list li .mu-single-chef .mu-single-chef-social {
      padding: 23px 10px;
    }

    #mu-blog-banner .mu-blog-banner-area {
      min-height: 300px;
    }
  }
  @media (max-width: 991px) {
    .mu-main-navbar .mu-main-nav li a {
      padding-left: 5px;
      padding-right: 5px;
      font-size: 14px;
    }

    .mu-main-navbar .navbar-header .navbar-brand {
      height: 30px;
      width: 115px;
    }

    .mu-main-navbar .navbar-header .navbar-brand-small {
      height: 25px;
      margin-top: 13px;
      width: 110px;
    }

    .mu-abtus-slider .slick-slide img {
      display: block;
      width: 100%;
    }

    #mu-subscription .mu-subscription-area {
      padding: 0 5%;
    }

    #mu-subscription .mu-subscription-area .mu-subscription-form input[type="text"] {
      width: 70%;
    }

    #mu-contact .mu-contact-area .mu-contact-content .mu-contact-right {
      margin-top: 50px;
      padding: 0;
    }

    #mu-gallery .mu-gallery-area .mu-gallery-content .mu-gallery-body .mu-single-gallery .mu-single-gallery-item .mu-single-gallery-img {
      height: 200px;
    }

    #mu-gallery .mu-gallery-area .mu-gallery-content .mu-gallery-body .mu-single-gallery .mu-single-gallery-item .mu-single-gallery-info {
      padding-top: 32.3%;
    }

    #mu-client-testimonial .mu-client-testimonial-area .mu-testimonial-content .mu-testimonial-slider li .mu-testimonial-single {
      padding: 0 60px;
    }

    #mu-client-testimonial .mu-client-testimonial-area .mu-testimonial-content .mu-testimonial-slider li .mu-testimonial-single .mu-testimonial-info p::before {
      top: 40%;
    }

    #mu-latest-news .mu-latest-news-area .mu-latest-news-content .mu-news-single {
      margin-top: 25px;
    }

    #mu-counter .mu-counter-overlay .mu-counter-area .mu-counter-nav li .mu-single-counter p {
      font-size: 15px;
    }

    #mu-blog-banner .mu-blog-banner-area {
      min-height: 250px;
    }

    #mu-error .mu-error-area p {
      padding: 0 30px;
    }

    #mu-error .mu-error-area {
      margin-top: 0;
      padding: 50px 100px 80px;
    }
  }
  @media (max-width: 767px) {
    .navbar-default .navbar-toggle {
      border-color: #fff;
      border-radius: 0px;
    }

    .navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
      background-color: #fff;
    }

    .mu-main-navbar .mu-main-nav {
      background-color: rgba(0, 0, 0, 0.8);
      text-align: center;
    }

    .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
      background-color: #fff;
    }

    #mu-counter .mu-counter-overlay .mu-counter-area .mu-counter-nav li {
      margin-top: 10px;
      margin-bottom: 10px;
      border-right: none;
    }

    #mu-blog-banner .mu-blog-banner-area {
      min-height: 275px;
    }

    #mu-blog .mu-blog-area .mu-blog-sidebar {
      margin-top: 50px;
    }

    #mu-blog .mu-blog-area .mu-blog-sidebar .mu-blog-sidebar-single .mu-sidebar-add img {
      width: 100%;
    }
  }
  @media (max-width: 640px) {
    .navbar-default .navbar-toggle {
      border-color: #fff;
      border-radius: 0px;
    }

    .navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
      background-color: #fff;
    }

    #mu-slider .mu-slider-area .mu-top-slider .mu-top-slider-single .mu-top-slider-content .mu-slider-title {
      font-size: 50px;
      line-height: 75px;
    }

    .mu-main-navbar .mu-main-nav {
      background-color: rgba(0, 0, 0, 0.8);
      text-align: center;
    }

    .mu-main-navbar .mu-main-nav li a {
      font-size: 18px;
    }

    #mu-reservation .mu-reservation-area .mu-reservation-content {
      padding: 0 50px;
    }

    #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-restaurant-menu li a {
      font-size: 16px;
      margin: 0 5px;
    }

    #mu-reservation .mu-reservation-area .mu-reservation-content p {
      padding: 0;
    }

    #mu-gallery .mu-gallery-area .mu-gallery-content .mu-gallery-top ul li {
      margin: 0 5px;
    }

    #mu-subscription .mu-subscription-area .mu-subscription-form input[type="text"] {
      width: 65%;
    }

    #mu-subscription .mu-subscription-area .mu-subscription-form .mu-readmore-btn {
      width: 30%;
    }

    #mu-chef .mu-chef-area .mu-chef-content .mu-chef-nav .slick-list li .mu-single-chef .mu-single-chef-social a {
      margin: 0 3px;
      padding: 3px 0;
      width: 30px;
    }

    #mu-blog-banner .mu-blog-banner-area {
      min-height: 220px;
    }
  }
  @media (max-width: 480px) {
    #mu-slider .mu-slider-area .mu-top-slider .mu-top-slider-single .mu-top-slider-content {
      left: 5%;
      right: 5%;
      top: 15%;
    }

    #mu-gallery .mu-gallery-area .mu-gallery-content .mu-gallery-body .mu-single-gallery {
      width: 50%;
    }

    #mu-gallery .mu-gallery-area .mu-gallery-content .mu-gallery-body .mu-single-gallery .mu-single-gallery-item .mu-single-gallery-info {
      padding-top: 35.5%;
    }

    #mu-gallery .mu-gallery-area .mu-gallery-content .mu-gallery-top ul li {
      margin-bottom: 10px;
    }

    #mu-slider .mu-slider-area .mu-top-slider .mu-top-slider-single img {
      width: 100%;
    }

    #mu-slider .mu-slider-area .mu-top-slider .mu-top-slider-single .mu-top-slider-content {
      display: none;
    }

    #mu-slider .mu-slider-area .mu-top-slider .slick-prev, #mu-slider .mu-slider-area .mu-top-slider .slick-next {
      opacity: 0;
    }

    #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-restaurant-menu li a {
      font-size: 14px;
      margin: 0 2px;
    }

    .mu-title {
      margin-bottom: 0;
    }

    #mu-client-testimonial .mu-client-testimonial-area .mu-testimonial-content .mu-testimonial-slider li .mu-testimonial-single {
      padding: 0;
    }

    #mu-subscription .mu-subscription-area .mu-subscription-form input[type="text"] {
      width: 100%;
      margin-bottom: 20px;
    }

    #mu-subscription .mu-subscription-area {
      padding: 0;
      text-align: center;
    }

    #mu-subscription .mu-subscription-area .mu-subscription-form .mu-readmore-btn {
      width: auto;
    }

    #mu-gallery .mu-gallery-area .mu-gallery-content .mu-gallery-body .mu-single-gallery {
      width: 100%;
    }

    #mu-gallery .mu-gallery-area .mu-gallery-content .mu-gallery-body .mu-single-gallery .mu-single-gallery-item .mu-single-gallery-info {
      padding-top: 15.5%;
    }

    #mu-blog-banner .mu-blog-banner-area {
      min-height: 150px;
    }

    .mu-news-single h3 {
      font-size: 20px;
      line-height: 25px;
      margin-bottom: 20px;
    }

    #mu-blog .mu-blog-area .mu-blog-pagination-area {
      text-align: center;
    }

    .mu-blog-details .mu-news-single > h2 {
      font-size: 20px;
      padding: 15px 15px;
      line-height: 30px;
    }

    #respond input[type="text"], #respond input[type="email"], #respond input[type="url"] {
      width: 100%;
    }

    #mu-error .mu-error-area {
      padding: 30px 20px 60px;
    }

    #mu-error .mu-error-area p {
      padding: 0;
      font-size: 16px;
    }

    #mu-error .mu-error-area h2 {
      font-size: 130px;
      line-height: 130px;
    }

    #mu-map {
      height: 350px;
    }

    #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-restaurant-menu li {
      margin-bottom: 10px;
    }
    .mu-blog-related-post .mu-blog-related-post-area {   
      margin-top: 30px;   
    }
  }
  @media (max-width: 360px) {
    #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-restaurant-menu li {
      margin-bottom: 12px;
    }

    #mu-about-us {
      padding: 100px 0 50px;
    }

    #mu-restaurant-menu {
      padding-bottom: 0px;
    }

    #mu-reservation .mu-reservation-area .mu-reservation-content {
      padding: 0;
    }

    .mu-title h2 {
      font-size: 28px;
    }

    #mu-client-testimonial .mu-client-testimonial-area .mu-testimonial-content .mu-testimonial-slider li .mu-testimonial-single .mu-testimonial-info p {
      font-size: 16px;
      line-height: 24px;
    }

    #mu-latest-news .mu-latest-news-area .mu-latest-news-content .mu-news-single h3 {
      line-height: 24px;
      margin-bottom: 20px;
      padding: 0 5px;
      font-size: 18px;
    }

    #mu-latest-news .mu-latest-news-area .mu-latest-news-content .mu-news-single .mu-news-single-content .mu-meta-nav li {
      padding: 0 5px;
    }

    #mu-contact .mu-contact-area .mu-contact-content .mu-contact-right {
      text-align: center;
    }

    #mu-contact .mu-contact-area .mu-contact-content .mu-contact-right .mu-contact-widget address {
      text-align: left;
    }

    #mu-contact {
      padding: 100px 0 50px;
    }

    #mu-gallery .mu-gallery-area .mu-gallery-content .mu-gallery-body .mu-single-gallery .mu-single-gallery-item .mu-single-gallery-info {
      padding-top: 22.5%;
    }

    #mu-footer .mu-footer-area .mu-footer-social a {
      font-size: 18px;
      margin: 5px;
      padding: 5px;
      width: 40px;
    }

    .mu-news-single h3 {
      font-size: 18px;
      line-height: 22px;
      padding: 0 10px;
    }

    .mu-comments-area .comments .commentlist li .reply-btn {
      font-size: 12px;
      line-height: 12px;
      padding: 5px 10px;
      right: 8px;
      top: 8px;
    }

    .mu-comments-area .comments .commentlist .children {
      margin-left: 0;
    }

    .media-left, .media > .pull-left {
      padding-right: 0;
    }

    .mu-comments-area .comments .commentlist li .news-img {
      margin-right: 10px;
    }

    .mu-comments-area .comments .commentlist li .media-body p {
      font-size: 14px;
    }

    #mu-blog-banner .mu-blog-banner-area {
      padding: 20% 0;
    }

    #mu-error .mu-error-area h2 {
      font-size: 80px;
      line-height: 80px;
    }

    #mu-error .mu-error-area p {
      font-size: 14px;
    }

    #mu-error .mu-error-area {
      padding: 0 15px 30px;
    }

    #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-menu-item-nav li .media .media-left {
      height: 100px;
      width: 100px;
      margin-right: 10px;
      float: left;
    }

    #mu-restaurant-menu .mu-restaurant-menu-area .mu-restaurant-menu-content .mu-tab-content-area .mu-menu-item-nav li .media .media-left a img {
      height: 100%;
      width: 100%;
    }

    #mu-map {
      height: 250px;
    }
  }
  @media (max-width: 320px) {
    #mu-gallery .mu-gallery-area .mu-gallery-content .mu-gallery-body .mu-single-gallery .mu-single-gallery-item .mu-single-gallery-info {
      padding-top: 25.5%;
    }

    #mu-blog-banner .mu-blog-banner-area {
      padding: 25% 0;
    }
    .mu-news-single .mu-news-single-content .mu-meta-nav li {   
      border-right: none;
    }
  }
</style>
  <!-- Favicon -->
  <link rel="shortcut icon" href="/asset/img/favicon.ico" type="image/x-icon">
  <!-- Font awesome -->
  <link href="/asset/css/font-awesome.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="/asset/css/bootstrap.css" rel="stylesheet">   
  <!-- Theme color -->
  <link id="switcher" href="/asset/css/theme-color/default-theme.css" rel="stylesheet">     
  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>        
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Prata' rel='stylesheet' type='text/css'>
  
<div class="wrap">
    <header class="bg-nav">
        <nav class="navbar navbar-expand-lg navbar-dark bg-nav container">
            <a class="navbar-brand" href="/" style="font-family: Tangerine, cursive; color: #c1a35f; font-size:40px">Delivery Food</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <div class="form-inline my-2 my-lg-0">
                    <?php if(Yii::$app->user->id != null) : ?>
                        <a href="<?= Url::to(['/shop/about']) ?>" class="btn btn-outline-warning main-color my-2 my-sm-0" >About us</a>
                        <a href="<?= Url::to(['/basket/index']) ?>" class="btn btn-outline-warning main-color my-2 my-sm-0" >Basket</a>
                        <a href="<?= Url::to(['/shop/profile']) ?>" class="btn btn-outline-warning main-color my-2 my-sm-0" >Profile</a>
                        <?= Html::beginForm(['site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn main-color']
                        )
                        . Html::endForm() ?>
                    <?php endif?>
                    <?php if(Yii::$app->user->id == null) : ?>
                        <a href="<?= Url::to(['/shop/about']) ?>" class="btn btn-outline-warning main-color my-2 my-sm-0" >About us</a>
                        <a href="<?= Url::to(['/basket/index']) ?>" class="btn btn-outline-warning main-color my-2 my-sm-0" >Basket</a>
                        <a href="<?= Url::to(['/site/signup']) ?>" class="btn btn-outline-warning main-color my-2 my-sm-0" >Sign up</a>
                        <a href="<?= Url::to(['/site/login']) ?>" class="btn btn-outline-warning main-color my-2 my-sm-0" >Sign in</a>
                    <?php endif?>
                    
                </div>

            </div>
        </nav>
    </header>
    <div class="bg-nav">
        <div class="container">
            <?php foreach(Category::find()->all() as $category) : ?>
                <a class="main-color" href="<?= Url::to(["shop/" . $category->id . "view"]) ?>"><?= $category->title; ?></a>
            <?php endforeach ?>
        </div>
    </div>
    <div class="container p-1">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?> 
        
        <?php if(isset($_SESSION['success'])) :?>
            <div class="alert alert-success alert-dismissible " role="alert">
            <strong><?= $_SESSION['success'] ?></strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif?>
        <?php if(isset($_SESSION['success'])) unset($_SESSION['success'])?>
        <?php if(isset($_SESSION['warning'])) :?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['warning'] ?></strong> 

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif?>
        <?php if(isset($_SESSION['warning'])) unset($_SESSION['warning'])?>
        
        <?= $content ?>
    </div>
</div>

<footer class="footer p-2 bg-nav">
    <div class="container">
        <p class="p-0 m-0 main-color" style="font-family: Tangerine, cursive; font-size:35px">Delivery Food</p>
    </div>
</footer>

<script>
    $('a.active').css('background-color', 'black');
</script>       

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
