<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Ability;
use App\Entity\Unit;
use App\Entity\UnitAbility;


class ImportAbilitiesCommand extends Command
{
    protected static $defaultName = 'import:abilities';
    protected static $defaultDescription = 'Add a short description for your command';

    function __construct(EntityManagerInterface $em) {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('ability-csv', InputArgument::REQUIRED, 'Ability CSV File')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $csv = fopen($input->getArgument('ability-csv'),'r');
        $num = 0;
        while ($data = fgetcsv($csv,1000,',')) {
            $unitName = $data[0];
            $abilityName = $data[1];
            $abilityDescription = $data[2];
            $ability = $this->em->getRepository(Ability::class,'ability')->findOneBy([
                'name' => $abilityName
            ]);
            if (!$ability) {
                $ability = new Ability();
                $ability->setName($abilityName);
                $ability->setDescription($abilityDescription);
                $this->em->persist($ability);
                $this->em->flush();
            }
            $unit = $this->em->getRepository(Unit::class,'unit')->findOneBy([
                'name' => $unitName
            ]);

            if (!$unit) {
                $io->error("The unit " . $unitName . " doesn't exist");
            }

            $unitAbility = $this->em->getRepository(UnitAbility::class,'unit_ability')->findOneBy([
                'unit_id' => $unit->getId(),
                'ability_id' => $ability->getId()
            ]);
            if (!$unitAbility) {
                $unitAbility = new UnitAbility();
                $unitAbility->setUnitId($unit);
                $unitAbility->setAbilityId($ability);
                $this->em->persist($unitAbility);
                $this->em->flush();
            }

            $num++;
        }
        $io->success('The abilities have been imported.');

        return Command::SUCCESS;
    }
}
