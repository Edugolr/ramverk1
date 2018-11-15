<?php
namespace Anax\View;

use Chai17\Models\TraverseArray as traverseArray;

?>

<h1>Standard</h1>
Choose format
<form action="">
  <!-- <input type="radio" name="action" onclick="document.getElementById('ipvalidate').action='ipvalidate/json';"> JSON<br> -->
  <input type="radio" name="action" checked onclick="document.getElementById('ipvalidate').action='';"> Standard<br>
  <input type="radio" name="action" onclick="document.getElementById('ipvalidate').action='ipvalidate/location';"> Location<br>
</form>

<form id="ipvalidate" class="" action="" method="post">
    Ip:<input type="text" name="ip" value="<?=$ip["ip"] ?>">
    <input type="submit" name="" value="Submit">
</form>
<?php
if (isset($res)) {
    $convert = New traverseArray;
    $flattened =$convert->traverseArray($res);
    ?>
    <div class="">
        <p class="">Ip: <?=$res["ip"]?></p>
        <p class="">Type: <?=$res["type"]?></p>
        <p class="">Continent: <?=$res["continent_name"]?></p>
        <p class="">Country: <?=$res["country_name"]?></p>
        <p class="">Region: <?=$res["region_name"]?></p>
        <p class="">City: <?=$res["city"]?></p>
        <p class="">Zip: <?=$res["zip"]?></p>
        <p class="">Language: <?=$res["location"]["languages"][0]["name"]?></p>
    </div>
    <div class="flag">
        <img src="<?=$res["location"]["country_flag"] ?>" alt="">
    </div>
    <?php
}
 ?>
