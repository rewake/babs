<?php


namespace Rewake\AliasBuilder;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildAliasesCommand extends Command
{
    protected static $defaultName = "make";

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $builder = new AliasBuilder();

        $builder->parse(__DIR__ . '/aliases');

        // TODO: output file location/name command arg
        $stub = file_get_contents(__DIR__ . '/stubs/install.stub');
        $file = str_replace('{{ $aliases_placeholder }}', $builder->aliases(), $stub);

        @mkdir('bin');
        file_put_contents('bin/install.sh', $file);

        return Command::SUCCESS;
    }
}