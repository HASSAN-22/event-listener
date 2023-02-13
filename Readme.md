## PHP event listener
#### With this package, you can easily add and use `event` and `listener` to your project

---
 ```
    composer require hasan-22/event-listener
 ```
---

Usage:

You can create a class for the event and a class for the listener.
Note that the Listener class must be implemented from the `\EventListener\ListenerInterface` interface

In this example, we think we have two event listener classes for login

Our classes name is `LoginEvent` and `LoginListener`


```php
require_once __DIR__.'/vendor/autoload.php';
 
//With function listen we can add register our event and listener
\EventListener\Event::listen(LoginEvent::class, LoginListener::class);

// Now we can fire events anywhere in the project like this
\EventListener\Event::fire(new LoginEvent());

// If your event have constructor with parameters you can pass the parameters like this
// Be careful that your parameters must have public access
\EventListener\Event::fire(new LoginEvent('Armia','123456'));

```
---
If you don't want to create class for listener and event, we can create event and listener in this way
```php

\EventListener\Event::listen('login',function(){
    echo 'user is login';
})
\EventListener\Event::fire('login');

// With parameter

\EventListener\Event::listen('login',function($username){
    echo "Hello $username";
})
\EventListener\Event::fire('login','Armia');

```
---
If you have multiple events and listeners, you can `listen` or `fire` them one after the other
```php
\EventListener\Event::listen('event_one',function($name){
    echo "Hello $name";
})->listen(EventTow::class, ListenerTow::class)->listen('event_three', function(){});

// Fire events
\EventListener\Event::fire('event_one','Armia')->fire(new EventTow())->fire('event_three');
```
If you want to delete the event, do so
```php
\EventListener\Event::delete('event_name');
```