jQuery(document).ready(function () {
    jQuery('.bean-coming-soon').each(function(){
        var currCountDown=jQuery(this);
        var $years   = parseInt(currCountDown.data('years'));
        var $months  = parseInt(currCountDown.data('months'));
        var $days    = parseInt(currCountDown.data('days'));
        var $hours   = parseInt(currCountDown.data('hours'));
        var $minutes = parseInt(currCountDown.data('minutes'));
        var $seconds = parseInt(currCountDown.data('seconds'));
        var BeanCountInt=setInterval(function(){
            var $endDate = new Date($years, $months, $days, $hours, $minutes, $seconds, 00);
            var $thisDate  = new Date();
            $thisDate  = new Date($thisDate.getFullYear(), $thisDate.getMonth() + 1, $thisDate.getDate(), $thisDate.getHours(), $thisDate.getMinutes(), $thisDate.getSeconds(), 00, 00);

            var $daysLeft    = parseInt(($endDate-$thisDate)/86400000);
            var $hoursLeft   = parseInt(($endDate-$thisDate)/3600000); 
            var $minutsLeft  = parseInt(($endDate-$thisDate)/60000);
            var $secondsLeft = parseInt(($endDate-$thisDate)/1000);

            var $prSeconds = $minutsLeft*60;
            $prSeconds = $secondsLeft-$prSeconds;

            var $prMinutes = $hoursLeft*60;
            var $prMinutes = $minutsLeft-$prMinutes;

            var $prHours = $daysLeft*24;
            $prHours = ($hoursLeft-$prHours) < 0 ? 0 : $hoursLeft-$prHours;

            var $prDays = $daysLeft;

            jQuery('>.days>.count-inner .count'   ,currCountDown).text($prDays);
            jQuery('>.hours>.count-inner .count'  ,currCountDown).text($prHours);
            jQuery('>.minutes>.count-inner .count',currCountDown).text($prMinutes);
            jQuery('>.seconds>.count-inner .count',currCountDown).text($prSeconds);
            if($thisDate>=$endDate){clearInterval(BeanCountInt);}
        },1000);
    });
});