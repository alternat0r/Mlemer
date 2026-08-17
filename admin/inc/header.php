<?php
	// Session is started centrally by inc/config.php (already required by this
	// point in every admin page).
?>

<style>
body {
  padding-top: 20px;
  padding-bottom: 20px;
}

.navbar {
  margin-bottom: 20px;
}

/* Custom page footer */
.footer {
  padding-top: 19px;
  color: #777;
  border-top: 1px solid #e5e5e5;
}

.divider-vertical {
	height: 50px;
	margin: 0 9px;
	border-left: 1px solid #F2F2F2;
	border-right: 1px solid #FFF;
}
.navbar-inverse .divider-vertical {
    border-right-color: #222222;
    border-left-color: #111111;
}

@media (max-width: 767px) {
    .navbar-collapse .nav > .divider-vertical {
        display: none;
     }
}

.navbar-custom {
    background-color:#9b59b6;
    color:#8e44ad;
    border-radius:0;
}
.navbar-custom .navbar-nav > li > a {
    color:#ffffff;
}

.navbar-custom .navbar-nav > li > a:hover {
    color:#8e44ad;
}

.navbar-custom .navbar-nav > li:hover {
    color:#8e44ad;
}

.navbar-custom .navbar-nav > .active > a,
.navbar-nav > .active > a:hover,
.navbar-nav > .active > a:focus {
    color: #8e44ad;
    background-color:transparent;
}
.navbar-custom .navbar-brand {
    color:#eeeeee;
}
</style>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Include Bootstrap-select CSS, JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css" integrity="sha384-qFWfegk7iqHYj1Wp/FECIiNvs8CBdkDakBofVs/ujLjXzB0MjdWRcFoA5HdB5TqG" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js" integrity="sha384-gYEWPc4PqVsUcmUA/F1H9PPNjnNvS8CHniaAOtoRluGxpLVqO2dwtGnA/gK3NVAg" crossorigin="anonymous"></script>

<style type="text/css">
#bootstrapSelectForm .selectContainer .form-control-feedback {
    /* Adjust feedback icon position */
    right: -1px;
}
</style>