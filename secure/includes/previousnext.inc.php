<ul id="vorige-volgende">
    <? if(isset($linkprevious) && $linkprevious != null): ?>
    <li id="left"><a id="gbStap1" class="button-vorigevolgende" href="<?php echo $linkprevious; ?>"><?php if(isset($_SESSION['taal'])){ echo $previousstep; }else{echo "Vorige stap";} ?></a></li>
    <?php endif; ?>
    <? if(isset($linknext) && $linknext != null): ?>
    <li id="right"><a id="gtStap3" class="button-vorigevolgende" href="<?php echo $linknext; ?>"><?php if(isset($_SESSION['taal'])){ echo $nextstep; }else{echo "Volgende stap";} ?></a></li>
    <?php endif; ?>
</ul>