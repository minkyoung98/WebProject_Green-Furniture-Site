<?php
    session_start();   
?>
<header id="header">
<div id="top">
    <form class="form-inline" action="" method="GET">
        <?php
        if(isset($_SESSION['id'])){
            //로그인 후
            echo '<div>'.$_SESSION['name'].' 님</div><button id="loginButton" type="button" class="btn btn-outline-secondary"><a href="/project/0/logout.php">로그아웃</a></button>';
            echo '<button type="button" class="btn btn-outline-secondary"><a href="/0/join.html"></a></button>';
        }
        else{
            //로그인 전
            echo '<button id="loginButton" type="button" class="btn btn-outline-secondary"><a href="/project/0/login.php">로그인</a></button>';
            echo '<button type="button" class="btn btn-outline-secondary"><a href="/project/0/signUp.php">회원가입</a></button>';
        }
        ?>
        <img id="magnifyingGlass" src="/project/magnifying_glass.png">
        <input class="form-control mr-sm-0" type="search" placeholder="search">
        <button type="submit" class="btn btn-outline-secondary"><a href="/project/0/search.html">검색</a></button>
    </form>
</div>
<div id="logo">
    <a href="/project/index.php">그린가구</a>
</div>
</header><!-- /header -->