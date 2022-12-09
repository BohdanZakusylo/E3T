<?php

// require('../src/phpCalendar/Calendar.php');
require('calendar/src/phpCalendar/Calendar.php');

use benhall14\phpCalendar\Calendar;

$calendar = new Calendar();

$calendar

#   or
/*
$events = array(
    array(
        'start' => date('Y-01-14'),
        'end' => date('Y-01-14'),
        'summary' => 'My Birthday',
        'mask' => true
    ), 
    array(
        'start' => date('Y-12-25'),
        'end' => date('Y-12-25'),
        'summary' => 'Christmas',
        'mask' => true
    )
);
$calendar->addEvents($events);
*/
?>
<!doctype html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="x-ua-compatible" content="ie=edge">


        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <link href="https://fonts.googleapis.com/css?family=Oxygen:400,700" rel="stylesheet"> 

        <link rel="stylesheet" type="text/css" href="calendar/html/css/stylesheet.css">

        <link rel="stylesheet" type="text/css" href="calendar/html/css/calendar.css">

    </head>

    <body>

        
        <div class="container">
    
            <div class="row fix">

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-1-1'), ''); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-2-1'), '#2E307A'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-3-1'), '#2E307A'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-4-1'), '#2E307A'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-5-1'), '#2E307A'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-6-1'), '#2E307A'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-7-1'), '#2E307A'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-8-1'), '#2E307A'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-9-1'), '#2E307A'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-10-1'), '#2E307A'); ?>
                
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-4">
                
                    <?php echo $calendar->draw(date('Y-11-1'), '#2E307A'); ?>
                
                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-12-1'), '#2E307A'); ?>

                </div>

            </div>

<!--            <div class="copyright">-->
<!--                -->
<!--                <p>&copy; Copyright Benjamin Hall :: <a href="https://github.com/benhall14/php-calendar">https://github.com/benhall14/php-calendar</a></p>-->
<!--            -->
<!--            </div>-->

        </div>

    </body>

</html>
