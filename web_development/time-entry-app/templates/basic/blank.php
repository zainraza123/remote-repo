<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $page_title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="templates/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="templates/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="templates/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="templates/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<main>
    <?php echo $content; ?>
</main>

</body>

<!-- jQuery -->
<script src="templates/admin/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="templates/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="templates/admin/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="templates/admin/dist/js/sb-admin-2.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
    $("#togglePassword").click(function () {

        // Check the checkbox state
        if ($(this).attr("class") == 'fa fa-eye') {
            // Changing type attribute
            $("#password").attr("type", "text");

            // Change the Text
            //$("#toggleText").text("Hide");
            $("#togglePassword").attr("class", 'fa fa-eye-slash');
        } else {
            // Changing type attribute
            $("#password").attr("type", "password");

            // Change the Text
            //$("#toggleText").text("Show");

            $("#togglePassword").attr("class", 'fa fa-eye');
        }

    });
});
</script>
</html>