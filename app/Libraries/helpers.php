<?php

if (! function_exists('carbon')) {
    // Create a new Carbon instance for the given datetime and/or timezone.
    function carbon($datetime = null, $timeZone = null)
    {
        if ($datetime instanceof \DateTime) {
            return Carbon\Carbon::instance($datetime)->setTimezone($timeZone);
        }

        return Carbon\Carbon::parse($datetime, $timeZone);
    }
}

function parseIncludes($request, $delimiter = ',')
{
    return array_filter(
        explode($delimiter, $request->query('include', null))
    );
}

function parseAppends($request, $delimiter = ',')
{
    return array_filter(
        explode($delimiter, $request->query('append', null))
    );
}

/**
 * Replace a given string within a given file.
 */
function replaceInFile(string $search, string $replace, string $path, bool $isPattern = false): void
{
    if ($isPattern) {
        $data = preg_replace($search, $replace, file_get_contents($path));
    } else {
        $data = str_replace($search, $replace, file_get_contents($path));
    }

    file_put_contents($path, $data);
}

/**
 * Copy a list of files to their new locations.
 */
function copyFiles(array $files): void
{
    foreach ($files as $from => $to) {
        copy($from, $to);
    }
}
