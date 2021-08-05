<?php


namespace Rewake;


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
    protected array $aliases;

    /**
     * Parses alias config files in aliases directory and generates
     * proper aliases, which are stored in $this->aliases array.
     *
     * @return array
     */
    public function parseAliases(): array
    {
        // TODO: aliases dir from config/env
        $files = array_diff(scandir(__DIR__ . '/aliases'), ['.', '..']);

        foreach ($files as $file) {

            if ($data = json_decode(file_get_contents(__DIR__ . "/aliases/{$file}"), true)) {

                $iterator = new RecursiveArrayIterator($data);
                iterator_apply($iterator, [__CLASS__, 'traverse'], [$iterator]);
            }
        }

        return $this->aliases;
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