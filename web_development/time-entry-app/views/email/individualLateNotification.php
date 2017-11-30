<?php //include('../../config.php');?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo TEMPLATE_BASE ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo TEMPLATE_BASE ?>dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo TEMPLATE_BASE ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default" style="margin-top: 20px">
                    <div class="panel-heading">
                        <h3 class="panel-title">Missing Time</h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            It appears you have not submitted your time into time entry for the pay period of <strong><?php echo $startDate->format('m/d/Y') ?>  - <?php echo $endDate->format('m/d/Y') ?></strong>. Failure to enter your time by the perscribed deadline may result in delayed paycheck processing until a future payment cycle.
                        </p>
                        <br />
                        <a href="<?php echo BASE ?>" class="btn btn-lg btn-success btn-block">View Time Entry</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>