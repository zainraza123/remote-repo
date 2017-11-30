<h1>Invoicing</h1>
<hr />
<form id="reportParameters">
    <select class="form-control" id="reportSelection" name="action" onchange="showReportParameters()" required>
        <option selected disabled>Select an action</option>
        <option value="daysPastDue">Update Days Past Due</option>
        <option value="invoicingReport">Invoicing Report</option>
    </select>

    <h2>Parameters:</h2>
    <div class="form-group report-parameter" id="parameterPayPeriod">
        <label>Pay Period: (Optional)</label>
        <select class="form-control" id="payPeriod" name="payPeriod" onchange="updateDateParameters()">
            <option selected disabled value="">Select a pay period</option>
            <?php foreach ($payPeriods as $period) : ?>
                <option value="<?php echo $period['startDate'] ?>,<?php echo $period['endDate'] ?>"><?php echo $period['startDate'] ?> to <?php echo $period['endDate'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group report-parameter" id="parameterStartDate">
        <label>Start Date:</label>
        <input name="startDate" type="date" class="form-control datepicker" id="startDate" />
    </div>

    <div class="form-group report-parameter" id="parameterEndDate">
        <label>End Date:</label>
        <input name="endDate" type="date" class="form-control datepicker" id="endDate" />
    </div>

    <div class="form-group report-parameter" id="parameterNone">
        <label>There are no parameters needed for this report</label>
    </div>

    <br />
    <div class="form-group">
        <input class="btn btn-success" type="submit" value="Generate">
    </div>
</form>

<script>
    function showReportParameters() {
        reportType = $('#reportSelection').val();
        $('.report-parameter').css('display', 'none');

        switch (reportType) {
            case "invoicingReport":
                $('#parameterPayPeriod').css('display', 'block');
                $('#parameterStartDate').css('display', 'block');
                $('#parameterEndDate').css('display', 'block');
                break;
            case "projectHoursByPeriod":
                $('#parameterPayPeriod').css('display', 'block');
                $('#parameterStartDate').css('display', 'block');
                $('#parameterEndDate').css('display', 'block');
                break;
            case "missingTime":
                $('#parameterPayPeriod').css('display', 'block');
                $('#parameterStartDate').css('display', 'block');
                $('#parameterEndDate').css('display', 'block');
                break;
            case "workedHoursByPeriod":
                $('#parameterPayPeriod').css('display', 'block');
                $('#parameterStartDate').css('display', 'block');
                $('#parameterEndDate').css('display', 'block');
                break;
            default:
                $('#parameterNone').css('display', 'block');
        }
    }
    
    function updateDateParameters() {
        payPeriodString = $('#payPeriod').val();
        payPeriodParts = payPeriodString.split(",");
        $('#startDate').val( payPeriodParts[0] );
        $('#endDate').val( payPeriodParts[1] );
    }

</script>

<style>
    .ui-datepicker {
        background-color: white;
    }
    
    .report-parameter {
        display: none;
    }

</style>
