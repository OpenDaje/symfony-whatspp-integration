<?php

namespace App\Command;

use OpenDaje\UmWa\UltraMsgClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:whatsapp:show-settings',
    description: 'Show instance settings',
)]
class InstanceInfoCommand  extends Command
{
    public function __construct(private UltraMsgClient $whatsApp)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $settings =$this->whatsApp->api('instance')->getSettings();

        var_dump($settings);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
