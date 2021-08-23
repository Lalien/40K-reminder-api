<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Faction;
class ImportFactionsCommand extends Command
{
    protected static $defaultName = 'import:factions';
    protected static $defaultDescription = 'Add a short description for your command';

    function __construct(EntityManagerInterface $em) {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('faction-csv', InputArgument::REQUIRED, 'Faction CSV File')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $csv = fopen($input->getArgument('faction-csv'),'r');
        $num = 0;
        while ($data = fgetcsv($csv,1000,',')) {
            if ($num != 0) {
                $factionName = $data[0];
                $faction = $this->em->getRepository(Faction::class,'faction')->findOneBy([
                    'name' => $factionName
                ]);
                if (!$faction) {
                    $faction = new Faction();
                    $faction->setName($factionName);
                    $this->em->persist($faction);
                    $this->em->flush();
                }
            }
            $num++;
        }
        $io->success('The factions have been imported.');

        return Command::SUCCESS;
    }
}
