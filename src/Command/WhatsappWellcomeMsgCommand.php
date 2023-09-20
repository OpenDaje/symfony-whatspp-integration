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
    name: 'app:whatsapp:wellcome-msg',
    description: 'Send wellcome message',
)]
class WhatsappWellcomeMsgCommand extends Command
{
    public function __construct(private UltraMsgClient $whatsApp)
    {
        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->addArgument('phone', InputArgument::REQUIRED, 'Phone number')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $phoneNumber = $input->getArgument('phone');

        if ($phoneNumber) {
            $io->note(sprintf('You passed an argument: %s', $phoneNumber));
        }

        $response =$this->whatsApp->api('messages')->sendChatMessage($phoneNumber, 'Wellcome from symfony whatsApp demo application.', 1);

        var_dump($response);
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
