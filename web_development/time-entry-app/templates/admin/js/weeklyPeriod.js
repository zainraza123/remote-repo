$(document).ready(function () {
    role = $('#employeeType').val();
    updateTotalHours();

    $('.addNewTime').click(function () {
        dayPanel = $(this).closest('div');
        table = dayPanel.find('table');
        day = $(table).attr('data-day');

        $.get("views/student/snippets/newTimeDropDown.php", { day: day }, function (data) {
            $(table).append(data);
        });

        updateTotalHours();
    });

    $('a.addProject').click(function () {
        $.get("views/student/snippets/newProjectDropDown.php", function (data) {
            $(".project").append(data);
        });

        updateTotalHours();
    });
});

function getWorkedHoursTotal() {
    week_total = 0;

    // For each day
    $('#workedSchedulePanel table').each(function () {
        day = $(this).attr('data-day');
        day_total = 0;

        // For each entry for a day
        $('tr', this).not("thead tr", this).each(function () {
            startTime = $('.startTime', this).val();
            endTime = $('.endTime', this).val();

            entryAmount = endTime - startTime;
            day_total += entryAmount;
        });
        week_total = week_total + day_total;
    });

    return week_total;
}

function getProjectHoursTotal() {
    projectHours = 0;

    $("table.project tr").each(function () {
        projectHoursRow = $(this).find('.projectHoursEntry').val();
        projectHours += parseFloat(projectHoursRow);
    });

    return projectHours;
}

function updateTotalHours() {
    week_total = getWorkedHoursTotal();

    $("#totalHours").html(week_total);
    updateTotalHoursRemaining();
}

function toggleWeekend() {
    $('#SaturdaySection').toggle("slow");
    $('#SundaySection').toggle("slow");
}

function updateTotalHoursRemaining() {
    projectHours = getProjectHoursTotal();

    totalHours = $("#totalHours").html();
    $("#remainingHours").html(totalHours - projectHours);
}

$(document).on('click', '.deleteTimeEntry', function () {
    $(this).closest('tr').remove();
    updateTotalHours();
    return false;
});

$(document).on('click', 'a.deleteProject', function () {
    $(this).closest('tr').remove();
    updateTotalHours();
    return false;
});

function setMessage(messageType, message) {
    $('#message').removeClass('alert-danger');
    $('#message').removeClass('alert-success');

    $('#message').html('<strong>Warning!</strong> ' + message);
    $('#message').css('display', 'block');
    $('#message').addClass('alert-' + messageType);
}

function validateShift(endSelect) {
    highest = 0;

    dayPanel = $(endSelect).closest('div');
    table = dayPanel.find('table');

    isValidShift = true;
    $('tr', dayPanel).not("thead tr", this).each(function () {
        startTime = $('.startTime', this).val();
        endTime = $('.endTime', this).val();

        if (endTime <= startTime) {
            setMessage('danger', 'You entered at least one shift incorrectly.');
            isValidShift = false;
        }

        if (startTime < highest || endTime < highest) {
            setMessage('danger', 'You entered your shift really wrong... :(');
            isValidShift = false;
        }

        highest = endTime;
    });

    return isValidShift;
}

function validateTimeEntry() {
    $('#message').css('display', 'none');
    var totalHours = parseFloat(document.getElementById("totalHours").innerHTML);
    var totalHoursRemaining = parseFloat(document.getElementById("remainingHours").innerHTML);
    var isValid = true;

    if (!validateShifts()) {
        isValid = false;
    }

    if (role == "Manager") {
        return true;
    }

    if (totalHours < 0) {
        isValid = false;
        setMessage('danger', 'You have less than 0 worked hours.');
    }

    // You have not allocated all worked hours
    if (totalHoursRemaining > 0) {
        isValid = false;
        setMessage('danger', 'You have hours still remaining.');
    }

    // You have not allocated all worked hours
    if (totalHoursRemaining < 0) {
        isValid = false;
        setMessage('danger', 'You have allocated too many project hours.');
    }

    if (!isValid) {
        $('#message').css('display', 'block');
    }

    return isValid;
}

function isNumber(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (
        charCode != 46
        && charCode > 31
        && (charCode < 48 || charCode > 57)
    ) {
        return false;
    }
    else {
        return true;
    }
}

function validateShifts() {
    isValid = true;
    $('#workedSchedulePanel table').each(function () {
        day = $(this).attr('data-day');

        // For each entry for a day
        $('tr', this).not("thead tr", this).each(function () {
            endTimeSelect = $('.endTime', this);
            endTimeSelect = endTimeSelect[0];

            validShift = validateShift(endTimeSelect);

            if (!validShift) {
                isValid = false;
            }
        });
    });

    return isValid;
}

function validateSchedule() {
    isValid = true;
    $('#message').css('display', 'none');

    if (!validateShifts()) {
        isValid = false;
    }

    if (!isValid) {
        $('#message').css('display', 'block');
    }

    return isValid;
}

function validateManagerOverride() {
    $('#message').css('display', 'none');
    totalRequiredHours = parseFloat($("#totalRequiredHours").html());
    projectHours = getProjectHoursTotal();
    isValid = true;

    if (totalRequiredHours != projectHours) {
        isValid = false;
        setMessage('danger', 'Project hours must match required hours.');
    }

    if (!isValid) {
        $('#message').css('display', 'block');
    }

    return isValid;
}