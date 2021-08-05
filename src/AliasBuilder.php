<?php


namespace Rewake\AliasBuilder;


use RecursiveArrayIterator;

/**
 * Class AliasBuilder
 * @package Rewake
 */
class AliasBuilder
{
    /**
     * @var array
     */
    protected $aliases;

    /**
     * Parses alias config files in aliases directory and generates
     * proper aliases, which are stored in $this->aliases array.
     *
     * @param string $aliasDir
     * @return void
     */
    public function parse(string $aliasDir): void
    {
        // TODO: array filter for non json files
        $files = array_diff(scandir($aliasDir), ['.', '..']);

        foreach ($files as $file) {

            if ($data = json_decode(file_get_contents("{$aliasDir}/{$file}"), true)) {

                $iterator = new RecursiveArrayIterator($data);
                iterator_apply($iterator, [__CLASS__, 'traverse'], [$iterator]);
            }
        }
    }

    /**
     * @return string
     */
    public function aliases(): string
    {
        return implode(PHP_EOL, $this->aliases);
    }

    /**
     * @param RecursiveArrayIterator $iterator
     * @param string|null $newAlias
     */
    protected function traverse(RecursiveArrayIterator $iterator, string $newAlias = null): void
    {
        while ($iterator->valid()) {

            $alias = $newAlias ?? $iterator->key();

            $iterator->hasChildren()
                ? $this->traverse($iterator->getChildren(), $alias)
                : $this->storeAlias($alias, $iterator->current());

            $iterator->next();
        }
    }

    /**
     * @param string $command
     * @param string $alias
     */
    protected function storeAlias(string $command, string $alias): void
    {
        $this->aliases[] = "alias {$alias}='{$command}'";
    }
}