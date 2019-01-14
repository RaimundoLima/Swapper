<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<body>

    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s3"><a href="#test1">
                    <i class="medium material-icons">face</i>
                </a></li>
                <li class="tab col s3"><a class="active" href="#test2">  
                    <i class="medium material-icons">star</i>
                </a></li>
                <li class="tab col s3"><a href="#test3">  
                    <i class="medium material-icons">chat</i>
                </a></li>
            </ul>
        </div>
        <div id="test1" class="aba col s12">

             <div class="row">
                <div class="col s12 m7">
                <div class="card">
                    <div class="card-image">
                    <img src="/View/img/rai.jpg">
                    <span class="card-title">Card Title</span>
                    </div>
                    <div class="card-content">
                    <p>I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.</p>
                    </div>
                    <div class="card-action">
                    <a href="#">This is a link</a>
                    </div>
                </div>
                </div>
            </div>


        </div>
        <div id="test2" class="aba col s12">Test 2</div>
        <div id="test3" class="aba col s12">Test 3</div>
    </div>

</body>
<?php include("footer.php"); ?>
</html>