<head>
    <link href="../ball/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 300px;
            padding: 19px 29px 29px;
            margin: 0 auto 20px;
            background-color: #fff;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            box-shadow: 0 1px 2px rgba(0,0,0,.05);
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
        }

    </style>
    <link href="../ball/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
</head>

<body>

<div class="container">

    <form class="form-signin" method="post" action="/User/register">
        <h2 class="form-signin-heading" align="center">Please sign up</h2> <br>
        <input type=text class="input-block-level" name="name" placeholder="Name" value=""> <br> <br>
        <input type=text class="input-block-level" name="surname" placeholder="Surname" value=""> <br> <br>
        <input type=email class="input-block-level" name="email" placeholder="* E-mail" value="" id="1"> <br> <br>
        <input type=text class="input-block-level" name="login" placeholder="* Login" value="" id="2"> <br> <br>
        <input type="password" class="input-block-level" name="pass" placeholder="* Password" value="" id="3"> <br> <br>
        <input type="password" class="input-block-level" name="repass" placeholder="* Repeat password" value="" id="4"> <br> <br>

        <p align="center"><button class="btn btn-large btn-primary" type="submit" name="register" align="right" disabled title="Fill all the fields">Sign up</button></p>
        <br>
        <p align="center"> Fields marked with * are required </p>
    </form>

</div>


</body>
<script src="../ball/js/jquery.js"></script>
<script src="../ball/js/bootstrap-transition.js"></script>
<script src="../ball/js/bootstrap-alert.js"></script>
<script src="../ball/js/bootstrap-modal.js"></script>
<script src="../ball/js/bootstrap-dropdown.js"></script>
<script src="../ball/js/bootstrap-scrollspy.js"></script>
<script src="../ball/js/bootstrap-tab.js"></script>
<script src="../ball/js/bootstrap-tooltip.js"></script>
<script src="../ball/js/bootstrap-popover.js"></script>
<script src="../ball/js/bootstrap-button.js"></script>
<script src="../ball/js/bootstrap-collapse.js"></script>
<script src="../ball/js/bootstrap-carousel.js"></script>
<script src="../ball/js/bootstrap-typeahead.js"></script>




