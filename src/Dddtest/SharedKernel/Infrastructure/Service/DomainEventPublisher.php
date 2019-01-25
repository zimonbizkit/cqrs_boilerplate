<?php

namespace Dddtest\SharedKernel\Infrastructure\Service;

use Dddtest\SharedKernel\Domain\Entity\TransactionalEventStore;
use Dddtest\SharedKernel\Domain\Service\DomainEventPublisherInterface;
use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\Plugin\Router\EventRouter;
use Symfony\Component\Yaml\Yaml;

class DomainEventPublisher implements DomainEventPublisherInterface
{
    /** @var EventBus */
    private $eventBus;

    /** @var EventRouter  */
    private $eventRouter;

    private $eventBindings = [];

    private $eventsToPublish = [];

    use ContainerTrait;

    /** DomainEventPublisher constructor*/
    public function __construct()
    {


    }

    public function publish(array $events)
    {
        $this->eventBus = new EventBus();
        $this->eventRouter = new EventRouter();

        $this->eventBindings = Yaml::parse(
            './src/Dddtest/Core/Infraestructure/Resources/DependencyInjection/core_domain_event_subscribers.yml'
        );

        foreach($events as $event) {
            foreach ($this->eventBindings as $binding) {
                if ($binding['event'] === get_class($event)) {
                    foreach($binding['listeners'] as $listener) {
                        $this->routeEventToListener($binding['event'], $listener);
                        //var_dump($event);
                        $this->eventsToPublish[] = $event;
                    }

                }
            }
        }

        $this->eventRouter->attachToMessageBus($this->eventBus);
        foreach($this->eventsToPublish as $event) {
            $this->eventBus->dispatch($event);
        }

    }

    private function routeEventToListener($eventName, $listener)
    {
        $this->eventRouter->route($eventName)
            ->to($this->getContainerService($listener));
    }
}