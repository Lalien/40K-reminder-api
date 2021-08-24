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
use App\Entity\FactionUnit;
use App\Entity\Faction;

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
            $factionName = $data[2];
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
            $faction = $this->em->getRepository(Faction::class, 'faction')->findOneBy([
                'name' => $factionName
            ]);
            if ($faction) {
                $factionUnit = $this->em->getRepository(FactionUnit::class, 'faction_unit')->findOneBy([
                    'faction_id' => $faction->getId(),
                    'unit_id' => $unit->getId()
                ]);
                if (!$factionUnit) {
                    $factionU    nit = new FactionUnit();
                    $factionUnit->setUnit($unit);
                    $factionUnit->setFaction($faction);
                    $this->em->persist($factionUnit);
                    $this->em->flush();
                }
            } else {
                $io->error('Faction ' . $factionName . ' doesn\'t exist.');
            }
            $num++;
        }
        $io->success('The units have been imported.');

        return Command::SUCCESS;
    }
}
