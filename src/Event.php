<?php

namespace EventListener;

class Event implements EventInterface
{
    /**
     * @var array
     */
    private static array $events;

    private function __construct(){}

    /**
     * Save event and listener
     * @param $event
     * @param $listener
     * @return Event
     * @throws \Exception
     */
    public static function listen($event, $listener): Event{
        if(!is_callable($listener)){
            $listener = new $listener;
            if(!$listener instanceof ListenerInterface){
                $listener = get_class($listener);
                throw new \Exception("class `$listener` must be implemented from the `\EventListener\ListenerInterface` interface");
            }
        }
        self::$events[self::getEventName($event)] = $listener;
        return new self();
    }

    /**
     * Call listener
     * @param $event
     * @return Event
     */
    public static function fire($event): Event{
        $listener = self::$events[self::getEventName($event)];
        if(is_callable($listener)){
            $args = func_get_args();
            unset($args[0]);
            call_user_func_array($listener,$args);
        }else{
            $listener->handel($event);
        }

        return new self();

    }

    /**
     * Delete event
     * @param $event
     * @return Event
     */
    public static function delete($event): Event
    {
        unset(self::$events[self::getEventName($event)]);
        return new self();
    }

    /**
     * @param $event
     * @return string
     */
    private static function getEventName($event): string
    {
        return is_object($event) ? get_class($event) : $event;
    }
}