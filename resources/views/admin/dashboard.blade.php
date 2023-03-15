<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/styleLogos.css" rel="stylesheet">
    <link href="/css/styleNavBar.css" rel="stylesheet">
    <link href="/css/slideShow.css" rel="stylesheet">
    <link href="/css/RWD.css" rel="stylesheet">
    <link href="/css/messages.css" rel="stylesheet">

    <style>
        /* Fixed sidenav, full height */
        .sidenav {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 0px 10px;

            color: white;
            text-align: right;
            direction: rtl;
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            right: 0;
            top:0;
            background-color: #ffffff;
            overflow-x: hidden;
        }

        /* Style the sidenav links and the dropdown button */
        .sidenav a, .dropdown-btn {

            text-decoration: none;
            font-size: 20px;
            color: #000000;
            display: block;
            border: none;
            background: none;
            width: 100%;
            text-align: right;
            cursor: pointer;
        }

        /* On mouse-over */
        .sidenav a:hover {
            color: #8f8f8f;
        }
        .dropdown-btn:hover{
            color: #8f8f8f;
        }

        /* Main content */
        .main {
            font-size: 20px; /* Increased text to enable scrolling */
            padding: 0px 10px;
        }

        /* Add an active class to the active dropdown button */
        .active {
            background-color: #444444;
            color: white;
        }

        /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
        .dropdown-container {
            display: none;
            background-color: #cccccc;
            padding-right: 15px;
            font-size: 10px;
        }
        .dropdown-container a{
            font-size: 15px;
        }

        /* Optional: Style the caret down icon */
        .fa-caret-down {
            float: right;
        }

    </style>
</head>
<body style="background-color: #eeeeee">

<div class="sidenav">
    <div style="background-color: #363636;padding: 0px;margin:auto;height: 50px">
        <p style="font-size: larger;margin: auto;padding-top: 10px;padding-right: 10px">منو</p>
    </div>

    <div class="col-12" style="background-color: #fed000;padding: 0px;margin:auto;height: 50px;width: 100%">
        <div class="col-9" >
            <p style="font-size: larger;margin: auto;padding-top: 10px;padding-right: 10px">مدیریت سایت</p>
        </div>
        <div class="col-3" style="padding-top: 15px">
            <img src="/logo/adminPanel.png" width="30" height="20">
        </div>
    </div>

    <button class="dropdown-btn">مدیریت محصولات
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="#">افزودن محصول جدید</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>
    <button class="dropdown-btn">مدیریت فروش
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="#">افزودن محصول جدید</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>
</div>

<div class="main">
    <h2>Sidebar Dropdown</h2>
    <p>Click on the dropdown button to open the dropdown menu inside the side navigationpen the dropdown pen the dropdown pen the dropdown asdasd.</p>
    <p>This sidebar is of full height (100%) and always shown.</p>
    <p>Some random text..</p>
</div>

<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>

</body>
</html>
