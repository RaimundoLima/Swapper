<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<body>

    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s3"><a href="#test1">Perfil</a></li>
                <li class="tab col s3"><a class="active" href="#test2">Busca</a></li>
                <li class="tab col s3 disabled"><a href="#test3">Matchs</a></li>
            </ul>
        </div>
        <div id="test1" class="col s12">Test 1</div>
        <div id="test2" class="col s12">Test 2</div>
        <div id="test3" class="col s12">Test 3</div>
    </div>

</body>
<?php include("footer.php"); ?>
</html>