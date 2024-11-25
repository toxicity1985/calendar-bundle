<?php

namespace ADesigns\CalendarBundle\Controller;

use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use ADesigns\CalendarBundle\Event\CalendarEvent;

class CalendarController extends AbstractController
{
    /**
     * Dispatch a CalendarEvent and return a JSON Response of any events returned.
     *
     * @param Request $request
     * @return Response
     */
    public function loadCalendarAction(Request $request, EventDispatcherInterface $eventDispatcher): Response
    {
        $startDatetime = new \DateTimeImmutable();
        $startDatetime->setTimestamp($request->get('start'));

        $endDatetime = new \DateTimeImmutable();
        $endDatetime->setTimestamp($request->get('end'));

        $events = $eventDispatcher->dispatch(new CalendarEvent($startDatetime, $endDatetime, $request))->getEvents();

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $return_events = [];

        foreach ($events as $event) {
            $return_events[] = $event->toArray();
        }

        $response->setContent(json_encode($return_events));

        return $response;
    }
}
