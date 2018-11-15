<?php
namespace Anax\View;

?>
<h1>Json</h1>
Choose format
<form action="">
  <input type="radio" name="action" checked onclick="document.getElementById('ipvalidate').action='ipvalidatejson/standard';"> Standard<br>
  <input type="radio" name="action" onclick="document.getElementById('ipvalidate').action='ipvalidatejson/location';"> Location<br>
</form>


<form id="ipvalidate" class="" action="ipvalidatejson/standard" method="get">
    Ip:<input type="text" name="ip" value="<?=$ip["ip"] ?>">
    <input type="submit" name="" value="Submit">
</form>
