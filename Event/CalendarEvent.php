<?php

namespace ADesigns\CalendarBundle\Event;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

use ADesigns\CalendarBundle\Entity\EventEntity;

/**
 * Event used to store EventEntitys
 * 
 * @author Mike Yudin <mikeyudin@gmail.com>
 */
class CalendarEvent extends Event
{
    const CONFIGURE = 'calendar.load_events';

    private $startDatetime;
    
    private $endDatetime;
    
    private $request;

    private $events;
    
    /**
     * Constructor method requires a start and end time for event listeners to use.
     * 
     * @param DateTimeImmutable $start Begin datetime to use
     * @param DateTimeImmutable $end End datetime to use
     */
    public function __construct(DateTimeImmutable $start, DateTimeImmutable $end, Request $request = null)
    {
        $this->startDatetime = $start;
        $this->endDatetime = $end;
        $this->request = $request;
        $this->events = new ArrayCollection();
    }

    public function getEvents()
    {
        return $this->events;
    }
    
    /**
     * If the event isn't already in the list, add it
     * 
     * @param EventEntity $event
     * @return CalendarEvent $this
     */
    public function addEvent(EventEntity $event): CalendarEvent
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
        }
        
        return $this;
    }
    
    /**
     * Get start datetime 
     * 
     * @return DateTimeImmutable
     */
    public function getStartDatetime(): DateTimeImmutable
    {
        return $this->startDatetime;
    }

    /**
     * Get end datetime 
     * 
     * @return DateTimeImmutable
     */
    public function getEndDatetime(): DateTimeImmutable
    {
        return $this->endDatetime;
    }

    /**
     * Get request
     * 
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }
}
