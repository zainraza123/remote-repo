<h1>Reports</h1>
<hr />
<form id="reportParameters">
    <select class="form-control" id="reportSelection" name="report" onchange="showReportParameters()" required>
        <option selected disabled>Select a report</option>
        <optgroup label="Projects">
            <option value="projectStatus">Project Status</option>
            <option value="projectHoursByPeriod">Project Hours By Period</option>
            <option value="projectHoursByPersonByPeriod">Project Hours By Person By Period</option>
            <option value="projectHoursByPersonByPeriodByManager">Project Hours By Person By Period By Manager</option>
        </optgroup>
        <optgroup label="Employees">
            <option value="workedHoursByPeriod">Worked Hours By Period</option>
            <option value="missingTime">Missing Time</option>
        </optgroup>
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

    <div class="form-group">
        <input class="btn btn-success" type="submit" value="Generate Report">
    </div>
</form>

<script>
    function showReportParameters() {
        reportType = $('#reportSelection').val();
        $('.report-parameter').css('display', 'none');

        switch (reportType) {
            case "projectHoursByPersonByPeriod":
                $('#parameterPayPeriod').css('display', 'block');
                $('#parameterStartDate').css('display', 'block');
                $('#parameterEndDate').css('display', 'block');
                break;
            case "projectHoursByPersonByPeriodByManager":
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
