<?php

$aliases = [];

function generateAliases()
{
    parseAliases();

    // TODO: figure out a better way to store/deal with $aliases[]... it works but DAMN is it clunky! lol

}

function parseAliases()
{
    $files = array_diff(scandir(__DIR__ . '/aliases'), ['.', '..']);

    foreach ($files as $file) {
        if ($data = json_decode(file_get_contents(__DIR__ . "/aliases/{$file}"), true)) {

            // TODO: line for filename in comment?
            $iterator = new RecursiveArrayIterator($data);
            iterator_apply($iterator, 'traverse', [$iterator, $iterator->key()]);
        }
    }
}

function traverse($iterator, $alias)
{
    while ($iterator->valid()) {
        $iterator->hasChildren()
            ? traverse($iterator->getChildren(), $iterator->key())
            : storeAlias($alias, $iterator->current());
        $iterator->next();
    }
}

function storeAlias($command, $alias)
{
    global $aliases;
    $aliases[] = "alias {$alias}='{$command}'";
}
