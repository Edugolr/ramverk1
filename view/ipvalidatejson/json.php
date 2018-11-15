<?php
namespace Anax\View;

use Chai17\Models\TraverseArray as traverseArray;

$convert = New traverseArray;
$res =$convert->traverseArray($res);

?>

<div class="">
    <?=$res ?>
</div>
