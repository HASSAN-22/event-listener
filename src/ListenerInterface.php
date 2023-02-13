<?php

namespace EventListener;

interface ListenerInterface
{

    /**
     * Handle the event.
     * @param $event
     * @return mixed
     */
   public function handel($event);
}