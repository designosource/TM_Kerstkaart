<ul id="vorige-volgende" class="clearfix">
    <? if($_SERVER['PHP_SELF'] != "index.php"): ?>
    <li id="left"><a id="gbStap1" class="button-vorigevolgende" href="index.php"><?php if(isset($_SESSION['taal'])){ echo $previousstep; }else{echo "Vorige stap";} ?></a></li>
    <?php endif; ?>
    <li id="right"><a id="gtStap3" class="button-vorigevolgende" href="stap3.php"><?php if(isset($_SESSION['taal'])){ echo $nextstep; }else{echo "Volgende stap";} ?></a></li>
</ul>