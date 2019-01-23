<?php

namespace Dddtest\Core\Infraestructure\Ui\Console;

use Dddtest\Core\Application\Model\Service\SubscribeUserCommandRequest;
use Dddtest\Core\Application\Model\Service\SubscribeUserCommandResponse;
use Dddtest\SharedKernel\Infrastructure\Ui\Service\ContainerAndBusAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserSubscribe extends ContainerAndBusAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('user:subscribe')
            ->setDescription('Subscribe user to the newsletter')
            ->addArgument('email', InputArgument::REQUIRED, 'User email to subscribe')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var SubscribeUserCommandResponse $response */
        $response = $this->container->get('dddtest.core.application.model.service.subscribe_user_use_case')->handle(
            new SubscribeUserCommandRequest((string)$input->getArgument('email'))
        );

        $output->writeln(
            sprintf(
                '<info>User with id %s and email %s created</info>',
                $response->getResponse()['id'],
                $response->getResponse()['email']
            )
        );
    }
}
