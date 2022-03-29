<?php
require_once 'src/process.php';
?>

<form action="" method="post">
    Nimi: <input type="text" name="name" value="<?php if (!empty($error)) echo $_POST["name"];?>">
    <?php if(isset($error['name'])) echo '<small>'.$error['name'].'</small>'?><br>
    
    Isikukood: <input type="text" name="code" value="<?php if (!empty($error)) echo $_POST["code"];?>">
    <?php if(isset($error['code'])) echo '<small>'.$error['code'].'</small>'?><br>
    
    Laenu summa: <input type="text" name="credit" value="<?php if (!empty($error)) echo $_POST["credit"];?>">
    <?php if(isset($error['credit'])) echo '<small>'.$error['credit'].'</small>'?><br>
    
    Periood kuudes: <input type="text" name="period" value="<?php if (!empty($error)) echo $_POST["period"];?>">
    <?php if(isset($error['period'])) echo '<small>'.$error['period'].'</small>'?><br>
    
    Kasutuseesmärk: <input type="text" name="case"  value="<?php if (!empty($error)) echo $_POST["case"];?>">
    <?php if(isset($error['case'])) echo '<small>'.$error['case'].'</small>'?><br>

    <input class="btn btn-success" type="submit" name="submit" value="Saada">
    <?php if(isset($success)) echo $success?>
</form>