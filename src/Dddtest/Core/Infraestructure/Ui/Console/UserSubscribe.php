<?php

namespace Dddtest\Core\Infraestructure\Ui\Console;

use Dddtest\Core\Application\Model\Service\SubscribeUserCommandRequest;
use Dddtest\Core\Application\Model\Service\SubscribeUserCommandResponse;
use Dddtest\SharedKernel\Application\ResponseInterface;
use Dddtest\SharedKernel\Infrastructure\Ui\Service\ContainerAndBusAwareCommand;
use Dddtest\SharedKernel\Infrastructure\Ui\Service\ResponseHandlerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserSubscribe extends ContainerAndBusAwareCommand implements ResponseHandlerInterface
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
        $this->handleResponse(
            $this->dispatch(
                new SubscribeUserCommandRequest(
                    (string)$input->getArgument('email')
                )
            ),
            $output
        );
    }

    /**
     * @var SubscribeUserCommandResponse | ResponseInterface $response
     * @param OutputInterface $output
     */
    public function handleResponse(ResponseInterface $response ,OutputInterface $output)
    {
        try {
            if ($response->getStatus() == 'OK') {
                $output->writeln('<info>user with id ' .
                    $response->getResponse()['id'] .
                    'and email ' .
                    $response->getResponse()['email'] .
                    ' created</info>');
            } else {
                $output->writeln("<error>ERROR:" .
                    $response->getResponse()['failMessage'] .
                    "</error>");
                $output->writeln(print_r($response->getResponse()['prev'],true));
            }
        }catch (\Exception $e) {
            print_r($e);
        }
    }
}
