<img class="full-width-banner-top" src="https://az388273.vo.msecnd.net/campsystem/images/1/CampAccountBanner_de20baa45d3749048f131dd0c3ecd148.jpg" />

<?php 
$day = 'Tuesday';
$date = new DateTime('2017-06-04');

if ($day != 'Sunday') {
    $date->modify("next $day");
}

echo $date->format('l F j, Y');
?>