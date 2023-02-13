<?php

namespace EventListener;

/**
 * @property array $events
 */
interface EventInterface
{

    /**
     * Save event and listener
     * @param $event
     * @param $listener
     * @return self
     * @throws \Exception
     */
    public static function listen($event, $listener): self;

    /**
     * Call listener
     * @param $event
     * @return self
     */
    public static function fire($event): self;

    /**
     * Delete event
     * @param $event
     * @return self
     */
    public static function delete($event): self;


}