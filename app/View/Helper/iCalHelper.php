<?php 
App::import('Vendor','iCalcreator', array ('file' => 'iCalcreator/iCalcreator.class.php'));

class iCalHelper extends Helper 
{
    var $name = 'ICalHelper';
    var $errorCode = null;
    var $errorMessage = null;
    
    var $calendar;
            
    function create($name, $description='', $tz='US/Eastern')
    {
        $v = new vcalendar();
        $v->setConfig('unique_id', $name.'.'.'yourdomain.com');
        $v->setProperty('method', 'PUBLISH');
        $v->setProperty('x-wr-calname', $name.' Calendar');
        $v->setProperty("X-WR-CALDESC", $description);
        $v->setProperty("X-WR-TIMEZONE", $tz);
        $this->calendar = $v;
    }
    
    function addEvent($start, $end=false, $summary, $description='', $extra=false)
    {
        $start = strtotime($start);
        
        $vevent = new vevent();
        if(!$end)
        {
            $end = $start + 24*60*60;
            $vevent->setProperty('dtstart', date('Ymd', $start), array('VALUE'=>'DATE'));
            $vevent->setProperty('dtend', date('Ymd', $end), array('VALUE'=>'DATE'));
        }
        else
        {
        	if (!is_int($end)) {
        		$end = strtotime($end);
        	}
            $end = getdate($end);
            $start = getdate($start);

            $vevent->setProperty('dtstart', $start['year'], $start['mon'], $start['mday'], $start['hours'], $start['minutes'], $start['seconds']);
            $vevent->setProperty('dtend', $end['year'], $end['mon'], $end['mday'], $end['hours'], $end['minutes'], $end['seconds']);            
        }
        $vevent->setProperty('summary', $summary);
        $vevent->setProperty('description', $description);
        if(is_array($extra))
        {
            foreach($extra as $key=>$value)
            {
                $vevent->setProperty($key, $value);
            }
        }
        $this->calendar->setComponent($vevent);
    }
    
    function getCalendar()
    {
        return $this->calendar;
    }
    
    function render()
    {
        $this->calendar->returnCalendar();
    }
}
?>