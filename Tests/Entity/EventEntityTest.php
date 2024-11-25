<?php

namespace ADesigns\CalendarBundle\Tests\Entity;

use ADesigns\CalendarBundle\Entity\EventEntity;
use PHPUnit\Framework\TestCase;

class EventEntityTest extends TestCase
{
    public function testConstructBasic()
    {
        $beginDatetime = new \DateTimeImmutable('2012-01-01 00:00:00');
        $endDatetime = new \DateTimeImmutable('2012-01-01 02:00:00');
        $eventTitle = "Test Title 1";

        $eventEntity = new EventEntity($eventTitle, $beginDatetime, $endDatetime);
        $entityArray = $eventEntity->toArray();
        
        $arrayCheck = [
            'start' => date("Y-m-d\TH:i:sP", strtotime('2012-01-01 00:00:00')),
            'end' => date("Y-m-d\TH:i:sP", strtotime('2012-01-01 02:00:00')),
            'title' => "Test Title 1",
            'allDay' => false
        ];
        
        $this->assertEquals($entityArray, $arrayCheck);
    }
    
    public function testConstructAllDay()
    {
        $beginDatetime = new \DateTimeImmutable('2012-01-01 00:00:00');
        $endDatetime = null;
        $eventTitle = "Test Title 1";

        $eventEntity = new EventEntity($eventTitle, $beginDatetime, $endDatetime, true);
        $entityArray = $eventEntity->toArray();
        
        $arrayCheck = [
            'start' => date("Y-m-d\TH:i:sP", strtotime('2012-01-01 00:00:00')),
            'title' => "Test Title 1",
            'allDay' => true
        ];
        
        $this->assertEquals($entityArray, $arrayCheck);
    }

    public function testNonStandardFields()
    {
        $event = new EventEntity('Test', new \DateTimeImmutable('2012-01-01 00:00:00'), new \DateTimeImmutable('2012-01-01 01:00:00'));
        $event->addField('description', 'Event descriptions');

        $expectedArray = [
            'title' => 'Test',
            'start' => date("Y-m-d\TH:i:sP", strtotime('2012-01-01 00:00:00')),
            'end' => date("Y-m-d\TH:i:sP", strtotime('2012-01-01 01:00:00')),
            'allDay' => false,
            'description' => 'Event descriptions'
        ];

        $this->assertEquals($event->toArray(), $expectedArray);
    }
}
