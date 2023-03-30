<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * HOT TO USE
 * php bin/console app:random-spell Bogdan --yell

 */
class RandomSpellCommand extends Command
{
    protected static $defaultName = 'app:random-spell';
    protected static $defaultDescription = 'Cast random spell';
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('your-name', InputArgument::OPTIONAL, 'Your name here')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'make it yell')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $yourName = $input->getArgument('your-name');

        if ($yourName) {
            $io->note(sprintf('Hi %s', $yourName));
        }

        $spells = [
            'alohomora',
            'confundo',
            'expelliarmus',
            'reparo'
        ];

        $spellRandom = $spells[array_rand($spells)];

        if ($input->getOption('yell')) {
            $spellRandom = strtoupper($spellRandom);
        }

        // Logger
        $this->logger->info("CASTING SPELL " . $spellRandom);
        $io->success($spellRandom);

        return 0;
    }
}
