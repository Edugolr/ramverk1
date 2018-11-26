<?php
namespace Anax\View;

?>
<h1>Ip validator Json</h1>
Choose format

<div class="">
    <form action="">
      <input type="radio" name="action" onclick="document.getElementById('ipvalidate').action='<?= url("ipvalidatejson/standard") ?>';"> Standard<br>
      <input type="radio" name="action" onclick="document.getElementById('ipvalidate').action='<?= url("ipvalidatejson/location") ?>';"> Location<br>
      <input type="radio" name="action" onclick="document.getElementById('ipvalidate').action='<?= url("ipvalidatejson/weather") ?>';"> Weather<br>
    </form>
</div>


<div class="">
    <form id="ipvalidate" class="" action='<?= url("ipvalidatejson/standard") ?>' method="get">
        Ip:<input type="text" name="ip" value="<?=$ip["ip"] ?>">
        <input class="btn" type="submit" name="" value="Submit">
    </form>
</div>

<a class="fa-pull-right" href="<?= url("verktyg/ipvalidatorJson") ?>">REST API Guide</a>
