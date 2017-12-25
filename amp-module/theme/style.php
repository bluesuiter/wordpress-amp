	<?php
		if (class_exists('MultiPostThumbnails')) : 
			$masthead = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'masthead-image',get_the_ID(),'full');
			$mastheadMobile = MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'masthead-mobile-image',get_the_ID(),'full');
		endif; 
	?>

	<style amp-custom>
        *{margin:0px;padding:0px;}
        body{padding:0px;font-family: georgia, times new roman;}
        a {text-decoration: none;color: #222222;}

        /*new menu css here*/

        amp-sidebar {background: #0085ba;width:230px;}
        amp-sidebar .submenu {background: #0085ba;bottom: 0;box-shadow: 0 3px 20px 0 rgba(0, 0, 0, 0.075);left: 0;position: fixed;right: 0;top: 0;-webkit-transform: translateX(-100%);transform: translateX(-100%);-webkit-transition: -webkit-transform 233ms cubic-bezier(0, 0, 0.21, 1);transition: -webkit-transform 233ms cubic-bezier(0, 0, 0.21, 1);transition: transform 233ms cubic-bezier(0, 0, 0.21, 1); transition: transform 233ms cubic-bezier(0, 0, 0.21, 1), -webkit-transform 233ms cubic-bezier(0, 0, 0.21, 1);}
        amp-sidebar input:checked+.submenu {-webkit-transform: translateX(0);transform: translateX(0)}
        amp-sidebar .submenu .return-button + #menu-button{display:none;}
        amp-sidebar input[type="checkbox"] {position: absolute;visibility: hidden}
        amp-sidebar .menu-item {border-bottom: solid 1px #333333;color: #fff;display: block;position: relative;text-transform: none;font-family:lato;}
        amp-sidebar .menu-item:focus, amp-sidebar .menu-item:hover{color: #cfcfcf;}
        amp-sidebar .menu-layer .items {left: 0; position: absolute;right: 0;}/**/
        amp-sidebar .menu-layer .items .items{overflow-x: hidden;overflow-y: scroll;}
        amp-sidebar .menu-layer.primary {height:100%;position: relative;}
        amp-sidebar .menu-layer.secondary { z-index: 2}
        amp-sidebar .menu-layer.tertiary { z-index: 3}
        amp-sidebar .menu-layer.primary .items { bottom:0px;top:40px;padding:0 10px;}
        amp-sidebar .menu-layer.secondary .items, amp-sidebar .menu-layer.tertiary .items {bottom:0;top:65px}
        amp-sidebar .menu-layer.secondary .items .menu-item, amp-sidebar .menu-layer.secondary .items .level1 li{border-bottom: none;padding: 8px 5px;}
        amp-sidebar .menu-layer.secondary .items .menu-item:first-child, amp-sidebar .menu-layer.secondary .items .level1{border-top: solid 1px #333333;padding-top:15px;}
        amp-sidebar .menu-layer.secondary .items .menu-item.has-sub-level{border-bottom: solid 1px #333333;padding: 12px 5px;}
        amp-sidebar .has-sub-level::after {width: 15.53px;height: 8.3px;background-position: -84px -15.71px;content: '';height: 12px;position: absolute; right: 0px; top: calc(50% - 6px); width: 16px;background:url(<?= get_template_directory_uri(); ?>/images/arrow.png) no-repeat;}
        amp-sidebar .close-button {border:0;height:40px;position:absolute;right:0px;top:5px;width:50px;background-color:transparent; background-position:center center; background-repeat:no-repeat; background-image:url(<?= get_template_directory_uri(); ?>/images/menu-close.png); font-size:0px;outline:0px;}
        amp-sidebar .return-button {color:#b3b3b3;left:8px;position:absolute;top:12px;font-size:0px;padding:12px 5px;}
        amp-sidebar .return-button::before {border: 0; content: '';display: inline-block;height: 13px;margin-right: 5px; position: relative;top: 1px; width: 22px;background:url(<?= get_template_directory_uri(); ?>/images/go-back.png) no-repeat;margin-top:-5px;}
        .hamburger{-webkit-appearance:none;background:url(<?= get_template_directory_uri(); ?>/images/open-menu.png) no-repeat; border:0px;font-size:0px;width:40px;height:28px;outline:none; position:fixed; top:15px;left:8px;background-position:center;}
        .sideNavi > a, .sideNavi > label, .items > a, .items > label {font-size:14px;padding:11px 5px;font-weight:bold; letter-spacing: 1px;text-transform: uppercase;color:#fefefe;outline:0px;}
        .items li, .level1 li{list-style:none;padding:11px 5px;}
        .items > li{padding:0px;}
        .level1 a{color:#cfcfcf;text-decoration:none;}
        .sideNavi > label:last-child .items label{font-size:12px;letter-spacing: 0px;}

        /*new menu css end here*/

        main{max-width:700px;margin:0 auto;}
        pre{max-width: 100;overflow:auto;padding:16px;background:#fefefe;border:1px solid #ddd;}
        .full-width{float:left;width:99.9999%;}
        .col-2{float:left;width:49.9999%;}
        .position-relative{position:relative;}
        nav{height:60px;position:fixed;top:0;left:0;right:0;background:#0085ba;z-index:990;}
        nav a, .show-more, .show-less{color: #0085ba; text-decoration:none;font-weight:bold;font-size:15px;display:block;}
        span[class*="show"] > i {float: right;font-style:normal;}
        nav ul{list-style-type: none;margin:0;padding:0;transition: transform .3s ease-in-out; -webkit-transition: transform .3s ease-in-out; font-size: 14px;background:#333;}
        nav > ul > li{list-style:none;position: fixed;left:0px;top:0px;z-index:991;line-height:40px;color: #fff;padding:5px;}
        nav > ul > li span.openMenu{font-size:0px;display:none;width:40px;height:40px;background:url(<?= get_template_directory_uri(); ?>/images/open-menu.png) no-repeat;color:#000;background-position:center;}
        nav > ul > li:hover > ul{transform: translate3d( 240px, 0, 0 );-webkit-transform: translate3d( 240px, 0, 0 );background: #333;}
        nav > ul > li > ul{position:fixed;top:0;left:-240px;width:240px;bottom:0;z-index:990;box-shadow: 0 1px 3px rgba(0,0,0,0.12),0 1px 2px rgba(0,0,0,0.24);height:100vh;
        height:calc(100vh - 70px);overflow-y:scroll;padding-bottom:70px; }
        nav > ul > li > ul > li{padding:8px 0 8px 8px;border-bottom:1px solid #ddd;width: 96%;}
        nav > ul > li > ul > li#header{background:#4A8DDD;color:#fff;}
        nav > ul > li > a{display:block;line-height: 2; color: #fff;}
        nav > ul > li > ul > li > ul > li a{display:block; padding:4px 0 4px 8px;font-size:14px;}
        #closemenu{color:#fff;position:fixed;top:-40px;left:0;right:0;height:40px; z-index:999; line-height:40px; margin-left:200px;font-size:36px;
        transition: transform .3s ease-in-out;-webkit-transition: transform .3s ease-in-out;padding-left:10px;}
        nav ul:hover  ~ #closemenu{transform: translate3d( 0, 40px, 0 );-webkit-transform: translate3d( 0, 40px, 0 )}
        .right{width:100%;float:right;}
        .halfwidth{width:50%}
        nav h4.-amp-accordion-header{background: none;font-weight: normal;border: 0px;line-height: 2;}
        nav .accordion-header-toggle{background: none;border: 0px;}
        amp-accordion section[expanded] .show-more {display: none;}
        amp-accordion section:not([expanded]) .show-less {display: none;}
        .nested-accordion h4 {font-size: 14px;background-color: #ddd;line-height: 1;background: #333;
        padding: 15px 5px;border-top: 1px solid #ccc;}
        amp-accordion#hidden-header section[expanded] h4 {border: none;}
        .menu_list a{display: inline-block; width: 100%; text-indent: 15px;font-weight:normal;float:left;line-height:normal;padding:5px 0px;}
        .brandLogo{margin: 17px auto 0; display: block; max-width: 25%;}


        span.searchbox-icon{border:2px solid #fff;width:12px;height:12px;display:inline-block;position:absolute;top:10px;right:11px;border-radius:100%;}
        span.searchbox-icon:after {content: "";position: absolute;background: #fff;bottom: -5px;height: 8px;width: 2px;transform: rotate(-45deg);right: -3px;}
        /*post css below*/ 
        .post-box.col-2 .post-content{padding:10px;}
        .position-bottom{width:100%;position:absolute;bottom:0px;background: -moz-linear-gradient(top, rgba(0,0,0,0.0) 0%, rgba(0,0,0,0.63) 35%, rgba(0,0,0,0.88) 60%, rgba(0,0,0,1) 100%); background: -webkit-linear-gradient(top, rgba(0,0,0,0.0) 0%, rgba(0,0,0,0.63) 35%, rgba(0,0,0,0.88) 60%, rgba(0,0,0,1) 100%); background: linear-gradient(to bottom, rgba(0,0,0,0.0) 0%, rgba(0,0,0,0.63) 35%, rgba(0,0,0,0.88) 60%, rgba(0,0,0,1) 100%);}
        .post-title{margin: 7px 0;font-size: 18px;font-weight: normal;line-height: 1.6;text-decoration: none;color: #000;}
        .position-bottom .post-title{padding: 0px;margin:0px;font-size: 22px;line-height: 28px;}
        .position-bottom .post-title a{color:#fff;}
        .post-title-top-box{color: #999;font-size:11px;text-transform: uppercase;letter-spacing: 0.9px;margin-top: 5px;min-height: 20px;font-family:lato;}


        /*footer css below*/		
        .footer-wrapper{float:left;width:100%;background: url(<?= get_template_directory_uri(); ?>/images/footer_bk_image.png) rgba(0,0,0,0.9) ;color:#fff;font-family:lato;background-position: center center;
        background-repeat: no-repeat;background-size: 1425px 370px}
        .blog-newsletter {margin-bottom: 30px;padding: 20px;border-bottom: 1px solid #3f3f3f;}
        .blog-newsletter .span6 > p{margin-top:0px;}
        .blog-newsletter .span6 p span {text-transform: uppercase;font-family:georgia, times new roman}
        .blog-newsletter .subsc-newsletter {border: 1px solid #3f3f3f;position:relative;margin:25px 0;}
        .blog-newsletter input[type="text"] {width:96%;width:calc(100% - 20px);background: transparent;border: transparent;height: 50px;padding-left: 20px;color:#fff;outline:none;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:14px;}
        .blog-newsletter ::-webkit-input-placeholder {color:#fff;}
        .blog-newsletter ::-moz-placeholder {color:#fff;}
        .blog-newsletter :-ms-input-placeholder {color:#fff;}
        .blog-newsletter :-moz-placeholder {color:#fff;}
        .result-wrap-bottom{margin-top:10px;}
        .result-wrap-bottom p{font-size:12px;text-align:center;}
        .icons8-message{background:url(<?= get_template_directory_uri(); ?>/images/mail.svg) no-repeat;width: 55px;height: 55px;float:left; background-size:55px;margin-top:-10px;}
        .subsc-newsletter .btn{position: absolute;top: 0px;right: 0px;background: none;border: none;color: #dc4a36;height: 52px;padding:0px 25px;text-transform:uppercase;}
        .footer-wrapper .span3 {float: left;width: 50%;min-height: 130px;}
        .footer-link {margin:0;padding:0px;}
        .footer-wrapper h4 {padding:0 0 10px 0;margin:0px;font-size:11px;}
        .footer-link li{list-style:none;}
        .footer-link li a {color: #c7c7c7;text-transform: uppercase;font-size: 11px;text-decoration:none; line-height:20px;outline:0px;}
        p.ethos-coppyright{padding-top:20px;margin-bottom:10px;}
        p.ethos-coppyright, p.coppyright-text{text-align: center;float: left;display: block;text-transform:uppercase;width: 100%;font-size: 16px;}
        p.coppyright-text{font-size: 11px;margin: 0 0 20px 0;color:#999999;}


        /*popup  css below*/
        #suscribe-popup{display:none;width:100%;text-align:center;margin:0 auto;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;padding:20px;position:fixed;height:100%;width:100%;top:0px;background:rgba(255, 255, 255, 0.89);z-index:999;}
        .subscription-form .input-style {margin-bottom: 10px;}
        .input-style input[type="text"] {border: 1px solid #3a3a3a;background-color: #fff;border-radius: 0;color: #b7b7b7;font-weight: normal;min-height: 34px;padding: 2px 4px;text-shadow: none;width:96%;}
        .input-style .btn {background-color: #3a3a3a;border: 0 none;border-radius: 0;box-shadow: none;color: #fff;padding: 10px 20px;text-shadow: none;}


        /**Single Page**/
        .uppercase {text-transform: uppercase;}
        .calendar {color: #000; float: left; font-size: 12px; margin: 0px; text-transform: uppercase;margin-bottom:10px;font-family:lato;}
        #mobile-post-title-img{background-image: url(<?php echo $mastheadMobile; ?>) ;background-repeat:no-repeat;height: 385px;background-size: cover;}
        .post-detail-title {font-size: 32px;}/*margin: 0 0 40px; remove for search page*/
        .post-detail-title h1 {font-size: 25px; font-weight: 100; line-height: 1.5em; margin: 0; padding: 45px 0;font-family: georgia, times new roman;text-transform: capitalize;}
        .post-sub-title {font-style: italic; font-weight: 300;color: #666666; font-size: 16px; line-height: 1.8em; margin: 0; padding: 0; text-align: left;text-transform: capitalize;}
        .post-detail-content > p {padding: 0px; margin: 0px; color: #666; font-size: 16px; line-height: 1.8em;margin-top:20px;font-family:georgia, times new roman;}


        /** Comments Box ***/
        .comment-author.vcard .avatar{max-width: 44px;}


        /*lightbox popup css below*/
        amp-lightbox{width: 100%; height: 100%; background: rgba(0,0,0,0.7);}
        .row-fluid.popUpFormInner{background: #fff;width: 92%;margin:20% auto 0;padding:30px 20px;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;font-family:lato;position: relative;}
        .popUpFormInner .clsemyBox, .preOrder-inner .clsemyBox{position: absolute;right:10px;top:5px;width: 25px;height: 25px;font-size:0px;background:url(<?= get_template_directory_uri(); ?>/images/closeBtn.png);background-repeat:no-repeat;background-position:center center;}
        .popUpFormInner .heading{margin:0px;font-size:17.5px;}
        .popUpFormInner .main-heading span{margin: 5px 0px 0px;  display: block;font-size: 12.2px;}
        .popUpFormInner .info{font-size:12.2px;line-height:19px; margin: 0 10px 5px;}
        .popUpFormInner .info span {display: inline-block;margin: 0px;}
        .popUpFormInner #rqst_cllction_price-13768{margin:0px;display:inline-block;font-weight:bold;}
        p.info {margin: 0 10px 5px;padding: 12px 0px 15px;border-bottom: 1px solid #cecece;}
        .popUpFormInner .extra-padding{padding:10px;}
        .popUpFormInner .form-group { margin-bottom: 10px;font-size: 12px;}
        .popUpFormInner .form-group label {width: 100%;display: block;margin-bottom: 5px;color:#333;}
        .popUpFormInner .contain_unews input{float:left;width:15px;}
        .popUpFormInner .contain_unews label{float:left;width:90%;width:calc(100% - 30px);margin-left:5px;}
        .popUpFormInner .extra-padding{text-align:left;}
        .popUpFormInner .form-group:last-of-type {margin-bottom: 0;}
        .popUpFormInner .form-group .input {width:100%;border-radius: 0px;height: 30px;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box; float: right; border: 1px solid #efefef; -moz-appearance: none;-webkit-appearance: none;appearance: none;padding:5px 10px;}
        .popUpFormInner .form-group:after {content: "";clear: both;display: block;}
        .popUpFormInner button {width: 100%;color: #fff;background: #d83a2f;padding: 6px 0;text-transform: uppercase;-webkit-appearance: none;border:0px;    line-height: 20px;}
        .popUpFormInner .mobile input:nth-of-type(1) {width: 55px;float:left;}
        .popUpFormInner .mobile input:nth-of-type(2) {width: 82%;width: calc(100% - 60px);}

        .product-widget{background: #f2f2f2;padding-bottom: 30px;margin-bottom: 0px;margin-bottom:40px;}
        .product-widget .watch-mrp{color: #666;font-size: 16px;padding:0px 0px 30px;}
        .product-widget .ampstart-btn{background-color: #dc4a36;border-radius: 40px;color: #ffffff;display: inline-block;font-size: 12px;font-weight: bold;padding: 10px 15px;text-decoration:none;   text-transform: uppercase;border:0px;font-family:lato;outline:0px;}

        .loader_lightbox div.lightbox-content{position:relative;top:50%;}
		#success-lightbox div.lightbox-content{color:#fff;width: 75%;margin: 0 auto;font-size: 19px;text-align: center;color: #fff;}

        /*preorder popup css below*/
        .preOrder-inner{background: #fff;position: absolute;width: 300px;height: 440px;margin: 0px auto;top: 50%;margin-top: -220px;left: 50%;margin-left: -150px;}
        .preOrder-inner form{width: 85%;margin: 0px auto;}
        .preOrder-inner > .text-center{padding:30px 10px 15px;}
        .preOrder-inner .pre-pop-heading {font-size: 18px;font-family: lato;font-weight: bold;margin-bottom: 10px;}
        .preOrder-inner > .text-center p, .preOrder-inner .control-label{padding: 0px 10px;font-size: 11px;font-family: lato;line-height: 18px;}
        .preOrder-inner .control-label, .preOrder-inner .input-xlarge{display:block;padding:0px;}
        .preOrder-inner .input-xlarge{width: 100%;padding: 7px;margin-bottom: 10px;webkit-appearance: none; -moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box; border: 1px solid #efefef;-moz-appearance: none;-webkit-appearance: none;appearance: none;border-radius:0px;}
        .preOrder-inner .input-xlarge + span.visible{font-size: 12px;top: -10px;position: relative;font-family: lato;}
        .preOrder-inner button.btn-success {width: 100%;color: #fff;background: #d83a2f;padding: 6px 0;text-transform: uppercase;-webkit-appearance: none;border: 0px;line-height: 20px;margin-top:10px;}


        /*thank you page css below add on 14 april*/
        .text-center {text-align: center;}
        .thankyou{margin-top:100px;font-size:12px;line-height:150%;}
        .thankyou-title{margin: 15px 0px;}
        .thankyou-title h1{font:24px/normal normal;}
        .thankyou-quote p{font:13px/150% normal;color: #333;margin-bottom: 20px; font-family:lato;}
        .spacer-small {background-color: #efefef;background-position: center center;display: block;height: 1px;margin: 2% auto;width: 50%;}
        .thankyou-quote .info-box, .thankyou-quote .btn-border{font-family:lato;}
        .link-style-new{color: #323232;}
        .thankyou-btn{margin: 30px 10px;}
        .thankyou-btn a{background-color: #dc4a36;border-radius: 40px;color: #ffffff;font-weight: bold;padding: 10px 30px;text-decoration: none;text-transform: uppercase;display: block;}
        .thankyou-btn .link-style-1 {display: block;margin-bottom: 15px;}
        .btn-border {background: none repeat scroll 0 0 rgba(255, 255, 255, 0.4);border: 1px solid #000;color: #000;font-size: 11px;padding: 6px 12px;text-align: center;}


        /*two column and three column page css below add on 12 May*/
        .row-fluid [class*="span"]:first-child {margin-left: 0;}
        .post-detail-content > .two-wrapper, .post-detail-content > .threecol-wrapper, .post-detail-content > .fourcol-wrapper {margin-top: 40px; text-align: center;}
        .fourcol-wrapper .span6 {float: left; margin: 0% .87%; width: 48%;}
        .threecol-wrapper .span4 {float: left; margin: .87%; width: 31%;}
        .col-prod-img {border: 1px solid #f2f2f2;}
        .col-prod-img > a > .product-layout-size-defined {margin: 15px 0px;}
        .col-prod-img > a > .product-layout-size-defined > img {width: auto;max-width: 100%;height: auto;}
        .col-prod-img > div > div.watch-mrp {padding-top: 25px;}
        .col-prod-img.span3 > div > div.watch-mrp {font-size: 14px;}
        .col-prod-img > .product-widget.align-center.clearfix {margin-top: 0px; margin-bottom: 0px;}
        .col-prod-img > div > div.watch-mrp {padding: 25px 10px;}
        .product-widget {background-color: #eeeeee; text-align: center; padding-bottom: 15px; padding-top: 10px;}
        .fourcol-wrapper .product-widget {padding: 20px 5px;}
        .post-detail-content > p > iframe[allowfullscreen^="allowfullscreen"] {width: 100%;}
        .post-detail-content a {color: #000000; text-decoration: -moz-anchor-decoration;}
        .post-detail-content > p > a {color: #2baadf;}
        .post-detail-content .col-prod-img a > img {border: none;}


        /*last-30-days css below*/
        .post-content{padding:15px;}
        .read-more{width: 100%;font-size: 12px;padding-top: 10px;font-family:lato;text-transform:uppercase;letter-spacing: 1px;}
        .detail-post .read-more{padding-top:0px;} 
        .read-more a i{position:relative;}
        .read-more a i:after{content:"";position:absolute;border-top:4px solid transparent;border-bottom:4px solid transparent;border-left:6px solid #000;top:4px;left:8px;font-style:normal;}
        .post-content > a{font-weight: bold;line-height: 26px;display:inline-block;width:100%;}
        p.post-exceprt{display:none;}
        .detail-post p.post-exceprt{display:inline-block;color: #333;font-size: 14px;font-weight: 200;height: auto;line-height: 22px;margin: 15px 0;}
        .hidden-header h4{text-align: center;margin: 30px 0;padding: 15px 0;background-color: transparent;}
        .hidden-header h4 span.show-more{border: 2px solid #000;border-radius: 40px;color: #000;display: inline-block;font-size: 1.2em;   font-weight: bold;padding: 12px 45px;}


        /*search popup*/
        .search-popup-main{width:100%;margin:60px auto 0px;background: #fff;padding:0px;position:relative;}
        .search-popup .search-popup-main span{width: 24px;height: 24px;position: absolute;top: -55px;right: 1%;margin-left: -22px;background: #050505;padding: 10px;border-radius: 50%;}
        .lightbox .p2.search-form{position: relative;}
        .search-popup .ampstart-input input{background: #ffffff;border:1px solid #efefef;color: #999999;font-size: 14px;padding:15px 10px;text-transform: capitalize;width: 100%; -webkit-appearance: none;-moz-appearance: none;}
        .search-popup input[type="submit"] {color: #fff;background: #333;padding: 10px 25px;-webkit-appearance: none;border: 0px;position: absolute;top: 7px;right: 7px;border-radius: 25px;outline:0px;}


        /*css for for strip*/
        .header-transparent-strip{font-family:arial;background:#c4c4c4;font-size: 14px;letter-spacing: 1px;padding: 4px 0;position:fixed;text-align: center;margin: 0;z-index:989;top:60px;width:100%;}


        /*watch glossary page design*/
        .watch-glossary{padding: 30px 25px 20px;text-align: center;margin-bottom: 30px;background: url(<?= get_template_directory_uri(); ?>/images/watch_glossary_bg.jpg) #000;color:#fff;}
        .watch-glossary h1{font-size:25px;margin-bottom:10px;font-weight:400;padding:15px 0;letter-spacing: 3px;}
        .watch-glossary p{font-size:12px;margin-bottom:20px;line-height: 20px;color: #ececec;font-style: italic;}
        .watch-glossary + .search-character-wrapper{width:100%;overflow-X: scroll;-webkit-overflow-scrolling: touch;margin-bottom: 40px;padding: 0px;}
        .character-list{text-align:center;width: 1415px;}	
        .gallery-cell{background:#EEEEEE;width:10%;margin-left: 10px;text-align:center;display:inline-block;margin-bottom:10px;max-width:40px;}
        .gallery-cell a{padding:10px 0;display:inline-block;width:100%;}
        .gallery-cell a.incative{color: #ccc;}
        .search-character-wrapper{padding: 0 10px;}
        .row-fluid {width: 100%;}
        .row-fluid:after {clear: both;}
        .row-fluid:before, .row-fluid:after {display: table;line-height: 0;content: "";}
        .step-common-wrap .span1 {float: left; width: 23%;}
        .step-common-wrap .span11 {float: right;width: 73%;}
        .circle-text {color: #666;font-size: 17px;position: relative;width: 100%;z-index: 2;}
        .circle-text div {color: #000;font-size: 30px;float: left;line-height: 1.1em; margin-top: -0.5em;padding-top: 50%;position: relative;text-align: center;text-transform: uppercase;width: 100%;z-index: 2;}
        .circle-text.active:after{background: none repeat scroll 0 0 #ececec; border: 1px solid #ececec;border-radius: 0%;content: "";display: block;height: 0;padding-bottom: 100%;position: relative;width: 100%;}
        .step-link-style li{list-style:none;}	
        .step-link-style li a {margin-right: 12px;display: list-item;font-size: 18px;font-weight: 400;padding-bottom: 10px;}
        .step-common-content-wrapper {border-bottom: 1px solid #dedede;padding: 0 0 22px;margin-bottom: 22px;}
        .step-right-content-wrapper .short-cont {color: #666666;font-size: 14px;line-height: 26px;}
        .step-link-style .readmore > a {font-size: 12px;padding-top: 10px;font-family:lato;margin-bottom: 5px;text-transform:uppercase;letter-spacing: 1px;}
        .step-link-style .readmore > a .icons8-right:after {content: "";position: relative;border-top: 4px solid transparent;border-bottom: 4px solid transparent;border-left: 6px solid #000;top: -4px;left: 8px;
        font-style: normal;font-size: 0px;}


        /*paginator*/
        .paginationOuter{width:100%;margin-bottom:20px;text-align:center;}
        .paginationOuter div{display:inline-block;}
        .paginationOuter div a{border: 1px solid #000;padding: 8px 20% 8px 10%;border-radius: 50px;display: inline-block;margin: 5px 8px;min-width: 95px;position: relative;outline: 0;font-family: lato;font-size: 12px;text-transform: uppercase;font-weight:bold;}
        .paginationOuter div a:after{content:"";border-top: 4px solid transparent;border-bottom: 4px solid transparent;border-left: 6px solid #000;top: 12px;right: 25px;position: absolute;}
        .paginationOuter div.previousPage a{padding: 8px 10% 8px 20%;}
        .paginationOuter div.previousPage a:before{content:"";border-top: 4px solid transparent;border-bottom: 4px solid transparent;border-right: 6px solid #000;top: 12px;left: 18px;position: absolute;}
        .paginationOuter div.previousPage a:after{display:none;}


        /*post container page*/
        .post-content-wrapper{padding: 0px 16px;}
        .icons8-calendar-2{background:url(<?php echo get_template_directory_uri(); ?>/images/calendar.png) no-repeat;width: 16px;height: 15px;display: inline-block;vertical-align: top;}
        .post-detail-content{margin: 40px 0 20px;}
        .post-detail-content > a{width:100%;display:inline-block;}/*margin-top:40px; comment on 20 may*/
        .post-detail-content h3, .post-detail-content h3 + p, .post-detail-content h2, .post-detail-content p + a+p, .post-detail-content>p+h5, .post-detail-content>h5+ul, .post-detail-content>h3+h5, .post-detail-content>ul+h5{margin-top:20px;}/*margin spacing top 20px*/
        .post-detail-content p + a+p a{width:auto;display:inline;}
        .related_container{padding: 5%;}
        .small-border {border-top: 1px solid #000;margin: 0;padding: 0;width: 50px;}
        .related_container .continue_reading {padding: 25px 0px;text-transform: uppercase;font-size: 16px;font-weight:normal;font-family:lato;}
        .related_container .post-content{padding:0px;}
        .related_container .post-content {padding: 12px 0 15px;}
        .continue_read_block .stories-read-more {font-size: 11px;padding-top: 10px;text-transform: uppercase;display:none;}
        .post-detail-content > p > a {color: #2baadf;}
        .post-detail-content a.link-style-1, .link-style-1 {background-color: #dc4a36;border-radius: 40px;color: #ffffff; display: inline-block;font-size: 12px;font-weight: bold;padding: 10px 15px;line-height:normal;margin-top:20px;font-family: lato;text-transform: uppercase; border:none;}


        /*advertisement block*/
        .mobilepstBotmBanr, .banner-mobile, .desktoppstBotmBanr, .banner-desktop, .advertisement-banner-desktop{padding:25px;background:#eeeeee;}
        .mobilepstBotmBanr .small-border, .banner-mobile .small-border, .desktoppstBotmBanr .small-border, .banner-desktop .small-border {margin: 0 auto;}
        .mobilepstBotmBanr .title, .banner-mobile .title, .desktoppstBotmBanr .title, .banner-desktop .title{color: #ccc;font-size: 11px;padding-top: 15px;text-transform: uppercase;margin-bottom:20px;}
        .spacer-block{position:relative;top:-90px;}


        /*-------gallery section-------*/
        .post-detail-content div.gallery_section{float: left;margin: 20px 0px 0px 0px;width: 100%;}
        .gallery_section .span4.gallery_itm {overflow: hidden;margin: 0px 0px 0px 0px;text-align: center;border: 1px solid #ccc;width: 31.3%;float:left;}
        .gallery_section .span4.gallery_itm:nth-of-type(2n) {margin: 0 5px;}
        .gallery_section .span4.gallery_itm span.gallery_titl{display:none;}
        .gallery_section .span4.gallery_itm img{max-width: 100%; border: 0px; position: absolute; left: 50%; top: 50%; width: auto; -webkit-transform: translate(-50%,-50%); -ms-transform: translate(-50%,-50%); transform: translate(-50%,-50%);}
        .gallery_section .span4.gallery_itm {text-align: center;}
        .gallery_img {position: relative; width: 150%; height: 100px; overflow: hidden;}


        /* twg/oris-big-crown-propilot-calibre-111/ below css */
        .special-author{position:relative;}
        .author-avatar{border-radius: 100px;border: 1px solid #ccc;height: 70px;width: 70px;overflow:hidden;}
        .author-description{margin:20px 0px;}
        .author-description h2 {font-weight:normal;font-size:16px;position: absolute;top: 30px;left: 90px;font-family:lato;font-weight:bold;}
        .author-description p.designation {font-size: 12px;font-weight:normal;position: absolute;top: 55px;left: 90px;font-family: lato;color: #666;}
        .author-description p.bio {font-size: 14px;line-height: 22px;color:#666;}
        .post-detail-content > p + p, .post-detail-content > p + p > iframe {padding: 0px;margin: 20px 0px 0px 0px;}
        .special-author-top{position:relative;}
        .special-author-top .fn a{position: absolute;top:8px;left: 50px;font-size: 12px;width: 171px;}
        .special-author-top .right.calendar {display: none;}
        .special-author-top .post-by.vcard.author .fn {border: 1px solid #ccc;border-radius: 50%;padding: 2px;max-width:30px;width:30px;display:inline-block;overflow:hidden;}
        .form-wrap-bottom .subsc-newsletter{margin-bottom:10px;}
        .validation-errors, .success-msg p, .error-msg div p, .error-msg p{font-size:13px;text-align:left;}
        .success-msg p{color:#519a0f;}
        .alignleft{float: left;}
        .container > #comments.comments-area{width: 90%;margin:0 auto;}
        .comments-area .comments-title {font-size: 24px;padding:0px 0 10px;font-weight: normal;font-family: georgia, times new roman;line-height: 30px;margin-bottom:20px;}
        .comments-area .commentlist .depth-1 {border-top: 1px solid #ddd;float: left;margin: 0;padding: 25px 0 0;width: 100%;list-style:none;}
        .comments-area ol.commentlist ol{list-style:none;}
        .comments-area .commentlist .commentAvatar {width: 100%;max-width: 44px;margin-right: 1%;overflow:hidden;border-radius:50%;}
        .comments-area .commentlist .commentContent {width: 78%;margin: 0px;}
        .comments-area .commentlist cite{width:100%;display:inline-block;font-style:normal;}
        .comments-area .fn {color: rgb(51, 51, 51);font-size: 13px;font-weight: 400;letter-spacing: 1px;padding-left: 18px;}
        .comments-area .commentlist a time {padding-left: 18px;color: rgb(153, 153, 153);font-size: 12px;}
        .comments-area .commentlist .comment-content.comment>p {font-size: 14px;line-height: 24px;margin: 10px 0;padding-left: 18px;color: rgb(116, 116, 121);}
        .comments-area .commentlist .reply .comment-reply-link {color: rgb(153, 153, 153);font-size: 12px;letter-spacing: 2px;  text-transform: uppercase;padding-left:18px;}
        p.comment-notes{color: #747479;font-size: 11px;margin:0px 0px 10px;float:left;width:100%;}
        .comment-form p[class^="comment-form"]{margin-bottom:5px;}
        .comment-form p[class^="comment-form"] label{width: 100%;display: inline-block;margin-bottom: 5px;color: #747479;font-size:14px;}
        .comment-form p[class^="comment-form"] textarea, .comment-form p[class^="comment-form"] input{width:100%;padding:5px;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;border: 1px solid rgb(227, 227, 221);-webkit-appearance:none;margin-bottom:10px;font-family:georgia, times new roman;}
        p.form-submit{font-size: 14px;margin-bottom: 20px;}
        p.form-submit > input {background:#000;border: 0 none;color:#fff;font-size: 13px;padding: 10px 20px;border-radius: 40px;font-weight: bold;line-height:20px;}
        h3.comment-reply-title{margin:15px 0;font-size: 15px;font-weight: bold;display:inline-block;width:100%;font-family:georgia, times new roman;}

        /*for search page*/

        .search-page + .post-box{margin-bottom:20px;text-align:center;}

        .e404 {text-align: center;}
        .e404 .post-detail-content{margin-top:0px;}

        .pagewrpNum{padding: 20px 10px;margin: 45px 0px;background: #f4f4f4;font-size: 20px;text-align: center;color: #939393;}
        .cus-paginate a:first-child {margin-right: 15px;display:none;}
        .cus-paginate > a{margin:0 6px;}
        .cus-paginate > span {font-size:20px;color:#dc4a36;margin:0 5px;}
        .cus-paginate > a span{color: #939393;}
        .post-content-block{margin-bottom:40px;}
        .post-detail-content > p + ol{margin-top:20px;font-family: georgia, times new roman;margin-left: 20px;}
        .post-detail-content > p + ol li{margin-bottom:10px;color: #666;}

        /* Bottom Page Banners */
        .mobilepstBotmBanr{display:block;}
        .desktoppstBotmBanr, .advertisement-banner-mobile{display:none;}
        .align-center {text-align: center;}
        p.search-holder{position: absolute;top: 10px;right: 10px;height: 40px;width: 40px;}

        /*.post-sub-title{margin-bottom:20px;} remove from date upper space for news detail*/ 
        .post-detail-content h5, .post-detail-content h6 {border-top: 1px solid #eeeeee;font-size:14px;color:#333;}
        .post-detail-content > h5 + ul{list-style:disc inside none;}
        .post-detail-content > h5 + ul li{font-size: 13px;margin-bottom: 10px;font-style:italic;}

        .post-content > h3.post-title{margin:0px;}

        hr {margin: 20px 0;border: 0;border-top: 1px solid #dedede;width: 100%;}
        .product-widget + p + .product-widget{padding-top:30px;}

        .caption-wrap{font-size:0px;}
        .caption-wrap > a{margin-top:30px;display:inline-block;width:100%;}
        .caption-wrap > p{background: #f2f2f2;padding: 25px;color:666;line-height:26px;font-size:15px;text-align:center;color:#666;}
        .caption-wrap p > a {width: auto;margin: 0px;color:#2baadf;}
        .author-info-wrap.special-author{border-top: 1px solid #cecece;padding: 20px 0px 0px;}

        /*?for new page*/
        .post-detail-title + .post-summary-wrapper .right.calendar{margin-bottom:30px;}
        .post-detail-content .caption-wrap p{width:100%;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;font-family: lato;}


        /*css add on 20 may 17*/
        .post-detail-content p {color: #666666;font-size: 16px;line-height: 1.8em;}
        .position-bottom{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;}
        .wp-caption-text{background: #f2f2f2;color: #666;padding: 25px;text-align: center;}
        .post-detail-content a>div + p, .post-detail-content>a>.wp-caption>[class*="wp-image"], .post-detail-content>div.wp-caption>[class*="wp-image"],.post-detail-content>div+h3,.post-detail-content>h3+p ,.post-detail-content>h3+ul,  .post-detail-content>p[style*="text-align"]+h3,.post-detail-content>p+ul{margin: 40px 0px 0px 0px;}

        .advertisement-banner.advertisement-banner-mobile {padding: 25px;text-align: center;}
        .advertisement-banner .small-border {margin: 0 auto;}
        .advertisement-title {color: #ccc;font-size: 11px;padding-top: 15px;text-transform: uppercase;margin-bottom: 20px;}
        .post-detail-content h3{font-family: georgia, times new roman;font-size:20px;line-height:25px;}

        .continue_read_block .row-fluid [class*="span"]:first-child {margin-left: 0;}
        .continue_read_block .span6{width: 48.61878453038674%;}
        .continue_read_block .span6 .post-box{width:100%;}
        .continue_read_block .row-fluid [class*="span"]{display: block;float: left;min-height: 30px;margin-left: 2.7624309392265194%;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
        .text-center{text-align:center;}

        /*add on 22 may 17*/
        .post-detail-content>p+div.product-widget>div.watch-mrp, .post-detail-content>.product-widget>.watch-mrp{padding: 30px 0px;}
		.post-detail-content>.wp-caption.aligncenter+.product-widget>.watch-mrp{padding-top:0px;}

        .post-detail-content>.technical-specification {background: #f7f7f7;padding: 40px 35px 25px 40px;margin-top: 40px;}
        .post-detail-content>.technical-specification h4 {text-align: center;font-weight: bold;font-size:17.5px;}
        .post-detail-content .technical-specification ul, .the_content .technical-specification ul li {
            font-style: normal;color: #5f5f5f;font-size: 16px;font-weight: bold;}
        .post-detail-content .technical-specification ul li {list-style: none;padding-left: 35px;font-weight: normal;margin: 10px 0px;position:relative;}
        .post-detail-content .technical-specification ul li::before {color: rgb(0, 0, 0);content: "∙";font-size: 40px;left: 50px;
            line-height: 15px;position: absolute;left:20px;}

        .post-detail-content>ul li {font-size: 16px;color: #666;}
        ul li {list-style: disc inside none; margin-bottom: 10px;}
        .margin-top-2x{margin-top:20px;}

        /*css add on 29 may*/
        .flexslider.multiwatch-slider {margin: 40px 0px 0px;}
        .flexslider.glslider{text-align:center;}
      .flexslider.multiwatch-slider .flex-caption, .flexslider.multiwatch-slider .gl-caption {
    background: none repeat scroll 0 0 rgba(255, 255, 255, 0.9) ;
    bottom: 0px;color: #333;font-size: 16px;left: 0;letter-spacing: 4px;line-height: 35px;
    padding: 6px 10px;position: absolute;text-align: center;text-transform: uppercase;width:96%;
    z-index: 999;}
    .carousel-container{max-width:420px;box-shadow: 0 1px 7px rgba(0, 0, 0, 0.12);margin:0 auto;padding:20px;}
    .clearfix.img-container {width: 55%; text-align: center; margin: 0 auto;}
        /* media start below */
		
/*add on 25 august for article by brands*/	
.post-content{padding:10px;}	
.page-title {padding: 30px 25px 20px;text-align: center;}
.page-title h1 {font-size: 25px;font-weight: normal;font-family: georgia, arial;}
.read-more{text-align: right;letter-spacing: 1px;font-size:18px;padding-bottom: 5px;display:block;text-transform:initial;}
.read-more i.icons8-play{padding-left: 5px;}
.read-more i.icons8-play:after{display:none;}
.paginationOuter{clear:both;}
.paginationOuter div a{width: 140px;box-sizing: border-box;white-space: nowrap;}

/*last 30 days most read page css below 28 august*/
.page-title h1{margin-bottom:15px;}
.subtitle {margin: 15px 0px 10px;color: #666;font-family: georgia, arial;font-size: 16px;font-style: italic;}
		
        @media screen and (min-width:768px)
        {
            .brandLogo {max-width: 300px;}
            .mobilepstBotmBanr, .banner-mobile{display:none;}
            .desktoppstBotmBanr{display:block;}
            .gallery_img {height: 200px;}
            .related_container .continue_reading {color: #000;font-family: lato;font-size: 30px;padding-bottom: 50px;padding-top: 45px;text-transform: uppercase;}
            .post-title {line-height: 26px;font-size: 18px;font-family: georgia, times new roman;font-weight: 700;text-transform: capitalize;}
            .preOrder-inner {width: 100%;margin-left: -250px;max-width: 500px;}
            
            /*continue reading block*/
            /*.related_container .row-fluid-related .span4{width:49%;margin-left:2%;float:left;}
            .row-fluid [class*="span"]:first-child {margin-left: 0;}*/
            .tag-watch-glossary-2 .post-detail-title {margin-bottom:40px;}
            .ethos-post-division {font-size: 0px;}
            .post-box {width: 50%;display: inline-block;vertical-align: top;}
            .post-box.col-2{min-height:400px;}
            .span4 .post-box{width:100%;}
            #mobile-post-title-img{height:700px;}

            .watch-glossary ~ .search-character-wrapper .row-fluid [class*="span"]:first-child {margin-left: 0;}
            .watch-glossary ~ .search-character-wrapper .row-fluid [class*="span"] {margin-left: 2.7624309392265194%;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
            .watch-glossary ~ .search-character-wrapper .row-fluid .span1 {width: 5.801104972375691%;}
            .watch-glossary ~ .search-character-wrapper .row-fluid .span11 {width: 91.43646408839778%;}
            .watch-glossary ~ .search-character-wrapper .row-fluid .span4 {width: 31.491712707182323%;}
            .watch-glossary ~ .search-character-wrapper .row-fluid .span8 {width: 65.74585635359117%;}
            .watch-glossary ~ .search-character-wrapper .row-fluid [class*="span"] {float: left;}
            .watch-glossary ~ .search-character-wrapper .step-common-content-wrapper {padding:0px;}
            .watch-glossary ~ .search-character-wrapper .step-common-content-wrapper:after {content: "";display: inline-block;width: 100%;}
            .watch-glossary ~ .search-character-wrapper .step-common-content-wrapper .step-link-style li {float: left;margin-right: 12px;margin-bottom: 8px;clear: left;}

            .row-fluid.popUpFormInner{max-width:500px;}
            .footer-wrapper{padding-top:10px;}
            .footer-wrapper .container .span6 {width: 48.61878453038674%;float:left;}
            .footer-wrapper .blog-newsletter .subsc-newsletter{margin-top:-10px;}
			
			/*add below css for article by brands page */
			a.post-box{width:100%;}
			.full-width > .post-box{width: 48.61878453038674%;margin-left: 2.7624309392265194%;}
			.full-width > .post-box:first-child {margin-left: 0;}
			
        }
		
        @media screen and (max-width:767px){
            .brandLogo{max-width:60%;}
            .desktoppstBotmBanr, .banner-desktop, .advertisement-banner-desktop{display:none;}
            .mobilepstBotmBanr, .advertisement-banner-mobile{display:block;}
            .popUpFormInner .clsemyBox{right:5px;}
        	.continue_read_block .span6, .continue_read_block .row-fluid [class*="span"]{width:100%;float:none;margin-left:0px;}
        }

        @media screen and (max-width:1024px) and (orientation:landscape)
        {
            .row-fluid.popUpFormInner{margin: 10% auto 0;}
        }
        @media screen and (max-width:767px) and (orientation:landscape)
        {
            .popUpFormInner{margin:5% auto;}
            .brandLogo{width:35%;}
        }
        @media screen and (min-width:1024px){ 
            .gallery_img {height: 285px;}
        }
        /** Load More **/
        section[expanded] > .-amp-accordion-header .show-more{display: none;}
        amp-accordion.hidden-header section[expanded] h4 {border: none; padding:10px;}
        .ampList{width:100%;}
    </style>