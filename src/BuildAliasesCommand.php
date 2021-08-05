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

        // TODO: check env
        $builder->parse(getenv('ALIAS_DIR') ?: __DIR__ . '/aliases');

        // TODO: output file location/name
        $stub = file_get_contents(__DIR__ . '/stubs/install.stub');
        $file = str_replace('{{ $aliases_placeholder }}', $builder->aliases(), $stub);

        file_put_contents('bin/install.sh', $file);


//        $filename = dirname(__DIR__) . '/bin/aliases';
//        $file = fopen($filename, 'w+');
//
//        fwrite($file, implode(PHP_EOL, $aliases));
//
//        fclose($file);


        return Command::SUCCESS;
    }
}