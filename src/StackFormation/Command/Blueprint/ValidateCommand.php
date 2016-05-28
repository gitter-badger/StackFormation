<?php

namespace StackFormation\Command\Blueprint;

use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ValidateCommand extends \StackFormation\Command\AbstractCommand
{

    protected function configure()
    {
        $this
            ->setName('blueprint:validate')
            ->setDescription('Validate a blueprint\'s template')
            ->addArgument(
                'blueprint',
                InputArgument::REQUIRED,
                'Blueprint'
            );
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $this->interactAskForBlueprint($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $blueprint = $input->getArgument('blueprint');
        $this->stackManager->validateTemplate($blueprint);
        // will throw an exception if there's a problem

        $formatter = new FormatterHelper();
        $formattedBlock = $formatter->formatBlock(['No validation errors found.'], 'info', true);

        $output->writeln("\n\n$formattedBlock\n\n");
    }
}