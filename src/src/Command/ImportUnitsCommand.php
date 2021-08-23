<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Unit;

class ImportUnitsCommand extends Command
{
    protected static $defaultName = 'import:units';
    protected static $defaultDescription = 'Add a short description for your command';

    function __construct(EntityManagerInterface $em) {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('unit-csv', InputArgument::REQUIRED, 'Unit CSV File')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $csv = fopen($input->getArgument('unit-csv'),'r');
        $num = 0;
        while ($data = fgetcsv($csv,1000,',')) {
            $unitName = $data[0];
            $isCharacter = $data[1];
            $unit = $this->em->getRepository(Unit::class,'unit')->findOneBy([
                'name' => $unitName
            ]);
            if (!$unit) {
                $unit = new Unit();
                $unit->setName($unitName);
                $unit->setIsCharacter((Boolean) $isCharacter );
                $this->em->persist($unit);
                $this->em->flush();
            }
            $num++;
        }
        $io->success('The units have been imported.');

        return Command::SUCCESS;
    }
}
