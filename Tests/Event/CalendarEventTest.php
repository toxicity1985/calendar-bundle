<?php

namespace ADesigns\CalendarBundle\Tests\Event;

use ADesigns\CalendarBundle\Entity\EventEntity;
use ADesigns\CalendarBundle\Event\CalendarEvent;
use PHPUnit\Framework\TestCase;

class CalendarEventTest extends TestCase
{
    public function testConstruct()
    {
        $beginDatetime = new \DateTimeImmutable('2012-01-01 00:00:00');
        $endDatetime = new \DateTimeImmutable('2012-05-01 00:00:00');

        $calendarEvent = new CalendarEvent($beginDatetime, $endDatetime);

        $this->assertEquals($calendarEvent->getStartDatetime()->format('Y-m-d H:i:s'), "2012-01-01 00:00:00");
        $this->assertEquals($calendarEvent->getEndDatetime()->format('Y-m-d H:i:s'), "2012-05-01 00:00:00");

    }

    public function testAddEvent()
    {
        $beginDatetime = new \DateTimeImmutable('2012-01-01 00:00:00');
        $endDatetime = new \DateTimeImmutable('2012-05-01 00:00:00');
        $eventTitle = "Test Title 1";

        $eventEntity = new EventEntity($eventTitle, $beginDatetime, $endDatetime);
        $calendarEvent = new CalendarEvent($beginDatetime, $endDatetime);

        $calendarEvent->addEvent($eventEntity);

        $this->assertCount(1, $calendarEvent->getEvents());

        //test no duplicates
        $calendarEvent->addEvent($eventEntity);
        $this->assertCount(1, $calendarEvent->getEvents());
    }
}
