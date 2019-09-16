<?php

namespace App\Bundle\OneSignalNotificationsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateNotificationCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('onesignal:notification:create')
            ->setDescription('Create a push notification.')
            ->setHelp(
                <<<EOF
                    The <info>%command.name%</info> create a push notification:
                    <info>php %command.full_name% --env=dev</info>
                    <info>php %command.full_name% --env=prod --no-debug</info>
                    EOF
            );
    }
    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $api = $this->getContainer()->get('app_onesignal_notifications.service.client');



        try {
            $api->notifications->add([
                'contents' => [
                    'en' => 'Notification message'
                ],
                'included_segments' => ['All'],
                'data' => ['foo' => 'bar'],
                'isChrome' => true,
                'send_after' => new \DateTime('1 hour'),
                'filters' => [
                    [
                        'field' => 'tag',
                        'key' => 'is_vip',
                        'relation' => '!=',
                        'value' => 'true',
                    ],
                    [
                        'operator' => 'OR',
                    ],
                    [
                        'field' => 'tag',
                        'key' => 'is_admin',
                        'relation' => '=',
                        'value' => 'true',
                    ],
                ],
                // ..other options
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
