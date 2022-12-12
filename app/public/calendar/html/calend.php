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
 <body>

        
        <div class="container" style="margin-bottom: 2em;">
    
            <div class="row fix">

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-1-1'), '#2A2B68'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-2-1'), '#2A2B68'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-3-1'), '#2A2B68'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-4-1'), '#2A2B68'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-5-1'), '#2A2B68'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-6-1'), '#2A2B68'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-7-1'), '#2A2B68'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-8-1'), '#2A2B68'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-9-1'), '#2A2B68'); ?>

                    <hr />    

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-10-1'), '#2A2B68'); ?>
                
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-4">
                
                    <?php echo $calendar->draw(date('Y-11-1'), '#2A2B68'); ?>
                
                </div>

                <div class="col-xs-12 col-sm-6 col-md-4">
                    
                    <?php echo $calendar->draw(date('Y-12-1'), '#2A2B68'); ?>

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
