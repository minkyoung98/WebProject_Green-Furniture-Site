Green Furniture Web Site
1. 개발 환경 구축
1.1 Wampserver 설치
WampServer는 Apache2, PHP, MySQL 및 MariaDB를 사용하여 동적 웹 응용 프로그램을 만들 수 있는 Windows의 웹 개발 플랫폼이다. 
WampServer는 웹 애플리케이션을 직관적으로 개발하기 위해 필요한 모든 것을 자동으로 설치한다. 

http://www.wampserver.com/en/download-wampserver-64bits/ 에 접속하여 버전에 맞는 WampServer를 다운로드 한다.


다운로드된 설치파일을 실행하면 설치 과정이 자동으로 진행된다.


인터넷 익스플로러가 아닌 다른 웹브라우저를 WampServer에서 사용하는 디폴트 웹브라우저로 지정하려면 "예" 를 선택한다.


노트패드가 아닌 다른 편집기를 WampServer에서 사용하는 디폴트 웹브라우저로 지정하려면 "예" 를 선택한다.


Windows 보안 경고 창에서 아파치 웹서버에 접근할 수 있게 허용할 네트워크를 묻는데 보통 사용하는 곳이 공공장소라면 두번째 항목, 집 같은 곳에서 사용한다면 첫번째 항목을 선택한다.


바탕화면에 생긴 단축 아이콘이나 시작 메뉴에서 Wampserver64를 검색하여 실행한다.


오른쪽 아래 시계옆에 Wampserver 상태를 트레이 아이콘으로 표시해준다.


붉은색은 Wampserver가 제공하는 모든 서비스가 중단된 상태이다.


주황색일 경우 일부 서비스만 실행되고 있는 상태이다.


초록색은 모든 서비스가 문제 없이 동작 중인 상태이다.


설치된 wamp64의 www경로에 assets폴더와 project폴더를 넣어준다. 주소창에 localhost/project 경로를 검색하면 project폴더에있는 index.php파일이 실행된다. assets에는 layout 관련 폴더들이 들어있는데, 이 폴더들은 project폴더 안의 php 파일에서 불러온다.


1.2 데이터 베이스 생성
Wampserver설치시 함께 설치된 DB에 phpmyadmin 으로 접근하기 위해서는 id와 password를 알아야 한다. 초기 등록되어있는 아이디는 'root'이고 password는 공백이다. root 사용자의 암호를 지정하기 위해서 WampServer 트레이 아이콘 위에서 마우스 왼쪽 버튼을 클릭하면 보이는 메뉴에서 MariaDB > MariaDB console을 선택한다.


로그인할 사용자 이름이 root 로 되어있는데, 변경하지 않고 OK버튼을 클릭해준다.

초기에는 암호가 지정되어 있지 않기 때문에 Enter password:에서 엔터만 입력하면 로그인이 된다.

암호를 지정하기 위해 다음 명령어를 실행시킨다.

SET PASSWORD FOR root@localhost = PASSWORD('your_root_password');
주소창에 localhost/phpmyadmin을 검색하면 나오는 다음 창에서 아이디 root와 설정해준 비밀번호를 입력하여 DB에 접속한다. 


데이터베이스메뉴에있는 새 데이터베이스 만들기를 이용하여 'project'라는 이름의 데이터베이스를 생성해준다.

로그인 회원가입 관련 table생성

생성된 project DB에 새 테이블 만들기를 이용하여 'user_info" 테이블을 생성해 준다. 
실행을 누르면 나오는 창에서 다음과 같이 입력해주고 저장을 누르면 테이블이 생성된다. 

게시판 관련 table생성
홈페이지에 필요한 게시판은 그린의 가구, 주문문의, 고객상담, A/S접수, 공지사항, 고객후기, 전체글 이렇게 7개 이다.

위의 그림은 all_question 테이블 생성과정이다 위의 그림과 같은 칼럼내용으로 all_question, a_s, customer_reviews, notice, order_inquiry, user_info 테이블을 생성해준다. 
그린의 가구 게시판의 경우 이미지가 들어가야 함으로 아래와 같은 칼럼내용으로 gallery 테이블을 생성해준다. 

 결과적으로 그림과 같이 project DB에 8개의 테이블이 생성되었다. 


2.웹 페이지 기능
2.1 로그인 회원가입 기능
데이터베이스 project에 있는 테이블 중 회원 정보 저장 테이블인 user_info 테이블을 사용한다. 


상단부의 로그인, 회원가입 버튼을 이용하여 로그인을 하거나 회원가입을 할 수 있다.
 로그인 전
 로그인 후

<C:\wamp64\www\project\header.inc.php>

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
    </form>



(1) 회원가입
회원가입 버튼을 누르면 회원가입 창으로 이동한다.


<C:\wamp64\www\project\0\signUp.php>

<div id="form">
    <div id="title">회원가입</div>
    <hr>
    <form  id="signUp" action="signUp.pro.php" method="post">
        <table>
            <tr>
                <th><label for="id" class="form-control"> *아이디 </label></th>
                <td><input type="text" name="id" id="text" class="form-control" placeholder="아이디 입력" required autofocus><br></td>
                <!-- <td><input id="text" type="text" name="id" placehorder="아이디 입력"></td> -->
            </tr>
            <tr>
                <th><label for="pw" class="form-control"> *비밀번호</label></th>
                <td><input type="text" name="pw" id="text" class="form-control" placeholder="비밀번호 입력" required ="required"><br></td>
                <!-- <td><input id="text" type="text" name="pw"></td> -->
            </tr>
            <tr>
                <th><label for="pwc" class="form-control"> *비밀번호 확인</label></th>
                <td><input type="text" name="pwc" id="text" class="form-control" placeholder="비밀번호 확인" required ="required"><br></td>
                <!-- <td><input id="text" type="text" name="pwc"></td> -->
            </tr>
            <tr>
                <th><label for="name" class="form-control"> *이름</label></th>
                <td><input type="text" name="name" id="text" class="form-control" placeholder="이름 입력" required ="required"><br></td>
                <!-- <td><input id="text" type="text" name="name"></td> -->
            </tr>
        </table>                
        <div class="button">
            <button type="submit" class="btn btn-secondary">가입하기</button>
        </div>
    </form>
</div>
텍스트박스의 required 속성을 "required"로 설정해주어 모든 값을 입력하도록 한다. 입력된 값들은 POST형식으로 "signUp.pro.php"파일로 보낸다. 



<C:\wamp64\www\project\0\signUp.pro.php>

if($pw!=$pwc)
{
    echo"<script>alert(\"비밀번호와 비밀번호 확인이 다릅니다.\");
            history.back();
        </script>";
    exit();
}
받아온 $pw값과 $pwc값이 다르면 비밀번호와 비밀번호 확인이 다르다는 알림창이 뜬다.

$select_query = "SELECT id FROM user_info WHERE id='$id' ";
$result_set = mysqli_query($conn, $select_query)or die(mysqli_error($conn));
$count = mysqli_num_rows($result_set);
echo $count;
if($count > 0){
    echo"<script>alert(\"이미 사용중인 아이디 입니다.\");
            history.back();
        </script>";
    exit();    
}
select 문을 이용하여 user_info테이블에 있는 id속성중 입력된 id인 $id와 일치하는 값이 있으면 가져온다. 가져온 값의 개수를 변수$count에 저장한다. $count의 개수가 0개 이상이면 이미 사용중인 아이디가 있다는 알림창이 뜬다.


가입이 완료되면 DB의 user_info테이블에 입력된 정보들을 저장하고 가입 완료 창으로 이동한다.

<C:\wamp64\www\project\0\signUp.complete.php>

<section id="section">
<main id="main" class="pl-5 pt-4 pr-5 border-left">
    <div id="text">가입 완료
        <br>       
    </div>
    <div id="button">
    <a class="btn btn-secondary" href="login.php">로그인창으로 이동</a>
    <a class="btn btn-secondary" href="../index.php">시작페이지로 이동</a>
    </div>
</main>
</section><!-- /section -->



(2) 로그인

로그인 버튼을 누르면 로그인 창으로 이동한다.
<C:\wamp64\www\project\0\login.php>

    <form class="form-signin" action="login.pro.php" method="post">     
        <label for="userid" class="sr-only">아이디</label>
        <input type="text" name="id" id="userid" class="form-control" placeholder="사용자 아이디" required autofocus><br>
        <label for="passwd" class="sr-only">비밀번호</label>
        <input type="password" name="pw" id="passwd" class="form-control" placeholder="사용자 비밀번호" required="required"><br>
        <button class="btn btn-secondary" type="submit">로그인</button>
    </form>

<C:\wamp64\www\project\0\login.pro.php>

    $sql = "SELECT * FROM user_info WHERE id = '$id' AND pw = '$pw'" ;
    $result = $conn->query($sql);
	
    if ($result->num_rows > 0) {
        if($row = $result->fetch_assoc()) {
           //로그인 성공!
           $_SESSION['id'] = $row['id'];
           $_SESSION['name'] = $row['name'];

           echo "로그인 성공";
           Header("Location:../index.php");
        }
    } else {
        echo "로그인 실패";
        Header("Location:login.php");
    }
입력된 id와 pw값이 DB에 있는 값과 일치하면 session에 id와 그에 일치하는 name값을 session에 저장한다.


<C:\wamp64\www\project\0\logout.php>

<?php
    session_start();

    unset($_SESSION['id']);
    unset($_SESSION['name']);

    header('Location: ../index.php');
?>
로그인된 상태에서 로그아웃 버튼을 누르면 session에 저장된 id값과 name값을 제거된다.

2.2 검색 기능

상단부의 텍스트박스와 버튼을 이용하여 웹페이지에 작성되어있는 전체 글 중에서 검색어가 포함된 제목의 글을 찾을 수 있다. "주문" 이라는 검색어를 텍스트박스에 입력하고 검색을 누르면 다음과 같이 결과를 보여주는 창이 뜬다. 


<C:\wamp64\www\project\header.inc.php>

    <form class="form-inline" action="editor.search.php" method="post">
        <img id="magnifyingGlass" src="/project/magnifying_glass.png">
        <label for="search" class="sr-only">검색</label>
        <input type="text" name="search" id="search" class="form-control mr-sm-0" placeholder="search" required="required"><br>
        <button class="btn btn-outline-secondary" type="submit">검색</button>
    </form>
검색 버튼을 누르면 입력된 텍스트 값을 editor.search.php로 POST 형식으로 보낸다. 이때 텍스트값의 required 속성을 "required"로 설정해 주어서 텍스트박스에 값이 입력되어야만 검색 버튼을 누를 수 있게 해준다.


<C:\wamp64\www\project\editor.search.php>

<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "project";
$search=$_POST['search'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM all_question WHERE title LIKE '%$search%' ORDER BY seq DESC ";
$result = $conn->query($sql);
?>
header.inc.php에서 받은값을 변수 $search에 저장한다.

SELECT 문을 사용하여 project DB의 all_question테이블에서 title속성의 값에 $search 가 포함된 행의 모든 속성값을 가져와 seq 속성값의 내림차순으로 $result에 저장한다.


<C:\wamp64\www\project\editor.search.inc.php>

        <table class="table table-bordered table-striped">
            <colgroup>
                <col width="10%">
                <col width="15%">
                <col width="*">
                <col width="15%">
                <col width="15%">
            </colgroup>
            <thead>
                <tr>
                    <th>번호</th>
                    <th>카테고리</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>등록일</th>    
                </tr>
            </thead> 
            <tbody>
        <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo <<< BBS
                    <tr id="text">
                        <td>{$row['seq']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['userid']}</td>
                        <td>{$row['reg_date']}</td>
                    </tr>
BBS;
                }
            } else {
                echo <<< NOBBS
                    <tr>
                        <td colspan="6">검색 결과가 없습니다.</td>
                    <tr>
NOBBS;
            }
            $conn->close();
        ?>
            </tbody>
        </table>
$result에 저장된 값을 테이블형식으로 입력해준다.

2.3 게시판 기능
데이터베이스 project에 있는 테이블들을 사용한다.

all_question --> 전체글 목록 저장 테이블
a_s --> A/S문의글 목록 저장 테이블
customer_consultation --> 고객상담글 목록 저장 테이블
customer_reviews --> 고객후기글 목록 저장 테이블
gallery --> 가구 사진을 저장하는 테이블
notice --> 공지글 저장 테이블
order_inquiry --> 주문문의글 저장 테이블


(1) 게시글 작성
(2) 게시글 수정
2.4 카카오 다음지도 API
