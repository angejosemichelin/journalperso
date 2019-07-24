<?php $langue = langue(); ?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>N</b>otifications";}elseif($langue=="en"){echo"<b>N</b>otification";} ?></h1>
<?php 
notifications($_SESSION["id"]);
efface_vue($_SESSION["id"]);
?>