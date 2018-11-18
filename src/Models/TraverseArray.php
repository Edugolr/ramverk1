<?php

namespace Chai17\Models;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * Helper to create a navbar for sites by reading its configuration from file
 * and then applying some code while rendering the resultning navbar.
 *
 */
class TraverseArray
{
    public function traverseArray($array)
    {
        // Loops through each element. If element again is array, function is recalled. If not, result is echoed.
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                self::traverseArray($value); // Or
                // traverseArray($value);
            } else {
                echo $key . " = " . $value . "<br />\n";
            }
        }
    }
}
