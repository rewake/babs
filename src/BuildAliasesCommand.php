<?php


namespace Rewake;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BuildAliasesCommand extends Command
{
    protected static $defaultName = "make";

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $builder = new AliasBuilder();

        $aliases = $builder->parseAliases();

        var_dump($aliases);

//        $filename = dirname(__DIR__) . '/bin/aliases';
//        $file = fopen($filename, 'w+');
//
//        fwrite($file, implode(PHP_EOL, $aliases));
//
//        fclose($file);


        return Command::SUCCESS;
    }
}