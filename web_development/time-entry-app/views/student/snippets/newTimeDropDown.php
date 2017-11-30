<?php 
include('../../../config.php');

//creating arrays of numbers for the time option
$hoursArray = array ('01', '02', '03', '04', '05', '06', '08', '09', '10', '11', '12');
$minutesArray = array ('0' => '00', '.25' => '15', '.5' => '30', '.75' => '45');
$daysArray = array ('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
$militaryTimeArray = array ('07'=>'07:00', '07.25'=>'07:15', '07.5'=>'07:30', '07.75'=>'07:45', '08'=>'08:00', '08.25'=>'08:15', '08.5'=>'08:30', '08.75'=>'08:45', '09'=>'09:00', '09.25'=>'09:15', '09.5'=>'09:30', '09.75'=>'09:45', '10'=>'10:00', '10.25'=>'10:15', '10.5'=>'10:30', '10.75'=>'10:45', '11'=>'11:00', '11.25'=>'11:15', '11.5'=>'11:30', '11.75'=>'11:45', '12'=>'12:00', '12.25'=>'12:15', '12.5'=>'12:30', '12.75'=>'12:45', '13'=>'13:00', '13.25'=>'13:15', '13.5'=>'13:30', '13.75'=>'13:45', '14'=>'14:00', '14.25'=>'14:15', '14.5'=>'14:30', '14.75'=>'14:45', '15'=>'15:00', '15.25'=>'15:15', '15.5'=>'15:30', '15.75'=>'15:45', '16'=>'16:00', '16.25'=>'16:15', '16.5'=>'16:30', '16.75'=>'16:45', '17'=>'17:00', '17.25'=>'17:15', '17.5'=>'17:30', '17.75'=>'17:45', '18'=>'18:00');


$day = get('day');
?>

<tr onchange="dynamicScheduleLoop()">
    <td style="width: 200px;">
        <select class="form-control startTime" name="startTime[<?php echo $day ?>][]">
            <?php foreach($militaryTimeArray as $hour => $time) : ?>
                <option value="<?php echo $hour ?>"><?php echo $time ?></option>
            <?php endforeach; ?>
        </select>
    </td>

    <td style="width: 200px;">
        <select class="form-control endTime" onchange="validateShift(this)" name="endTime[<?php echo $day ?>][]">
            <?php foreach($militaryTimeArray as $hour => $time) : ?>
                <option value="<?php echo $hour ?>"><?php echo $time ?></option>
            <?php endforeach; ?>
        </select>
    </td>
    <td class="deleteTimeEntry"><i class="fa fa-times" aria-hidden="true"></i></td>
</tr>
