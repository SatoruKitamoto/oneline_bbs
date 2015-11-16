<?php
	//データベース接続オブジェクトを作成
	$db = mysqli_connect('localhost','root','nexseed');
	// $db = mysql_connect('mysql103.phy.lolipop.lan','LAA0673641','nexseed');

	//接続するDBにonelin_bbsを選択
	mysqli_select_db('oneline_bbs',$db);　//<- 引数の指定が逆です
	// mysql_select_db('LAA0673641-onelinebbs',$db);
	

	//文字コードの設定 
	mysqli_set_charset('utf8',$db);

	//var_dumpで変数の中身を確認
	// var_dump($_POST);

	// if (!$db) {
 //    	die('接続失敗です。'.mysql_error());
	// }

	//DBに保存
	//POST送信されたら
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    	mysqli_select_db('oneline_bbs',$db);
    	// $sql = "INSERT INTO posts SET nickname='$_POST[nickname]',comment='$_POST[comment]',password='',created=NOW()";
       $nickname = mysqli_real_escape_string($_POST['nickname']); 
       $comment = mysqli_real_escape_string($_POST['comment']); 

       $sql = sprintf('INSERT INTO posts SET nickname="%s", comment="%s", created=NOW()',$nickname, $comment);
  
       $_SESSION["nickname"] = $nickname;

		//SQL文実行
    	// mysqli_query($sql,$db);
       mysqli_query($db, $sql) or die(mysqli_error($db));

    	//bbs.php再読み込み
    	// header('Location: bbs.php');

    }
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta carset="UTF-8">
		<title>セブ掲示板</title>

		<!-- CSS --> 
		<link rel="stylesheet" href="assets/css/bootstrap.css"> 
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css"> 
		<link rel="stylesheet" href="assets/css/form.css"> 
		<link rel="stylesheet" href="assets/css/timeline.css"> 
		<link rel="stylesheet" href="assets/css/main.css"> 

	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top"> 
	    	<div class="container"> 
	          	<!-- Brand and toggle get grouped for better mobile display --> 
	           	<div class="navbar-header page-scroll"> 
	              	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
	                   <span class="sr-only">Toggle navigation</span> 
	                   <span class="icon-bar"></span> 
	                   <span class="icon-bar"></span> 
	                   <span class="icon-bar"></span> 
	               	</button> 
	               	<a class="navbar-brand" href="#page-top"><span class="strong-title"><i class="fa fa-linux"></i>Oneline bbs</span></a> 
	           	</div>
	       	    <!-- Collect the nav links, forms, and other content for toggling --> 
	           	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
	               <ul class="nav navbar-nav navbar-right"> 
				<!--    <li class="hidden"> 
	                       <a href="#page-top"></a> 
	                  </li> 
	                  <li class="page-scroll"> 
	                       <a href="#portfolio">Portfolio</a> 
	                   </li> 
	                   <li class="page-scroll"> 
	                       <a href="#about">About</a> 
	                   </li> 
	                   <li class="page-scroll"> 
	                       <a href="#contact">Contact</a> 
	                   </li> --> 
	              	</ul> 
	          	</div> 
	           <!-- /.navbar-collapse --> 
	       	</div> 
	       <!-- /.container-fluid --> 
	  	</nav> 
	  	<div class="container">
	  		<div class="row">
	  			<div class="col-md-4 content-margin-top">
					<form method="post" action="bbs.php">

						<div class="form-group">
							<div class="input-group">
								<?php
								// nickname<input name="nickname" type="text" style="width:100px">
									if (isset($_SESSION["nickname"])) {
	                       				echo sprintf('<input type="text" name="nickname" class="form-control" 
	                        				id="validate-text" placeholder="nickname" value="%s" required>', 
	                           				$_SESSION["nickname"] 
	                       				); 
	                   				} else {
	                       				echo '<input type="text" name="nickname" class="form-control" 
	                        				id="validate-text" placeholder="nickname" required>'; 
	                   				}
								?>
								<!-- <input type="text" name="nickname" class="form-control" id="validate-text" placeholder="nickname" required> -->
								<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
							</div>
						</div>

						<div class="form-group">
							<div class="input-group" data-validate="length" data-length="4">
								<!-- comment<input name="comment" type="text" style="width:200px"> -->
								<textarea type="text" class="form-control" name="comment" id="validate-length" placeholder="comment" required></textarea> 
				                <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span> 

							</div>
						</div>

						<!-- <input type="submit" value="送信"> -->
						<button type="submit" class="btn btn-primary col-xs-12" disabled>つぶやく</button>
					</form>
				</div><!-- col-md-4 -->

				<div class="col-md-8 content-margin-top">
					<?php
						//1.データの取得
						// $sql = 'SELECT * FROM posts ORDER BY `created` DESC';
						// $posts = mysqli_query($sql,$db) or die(mysqli_error($db));
					?>

					<div class="timeline-centered">

						<?php 
						// while ($post = mysqli_fetch_assoc($posts)): 
						?> 
 
 
        					<article class="timeline-entry"> 
 
	             				<div class="timeline-entry-inner"> 
	 
		                 			<div class="timeline-icon bg-success"> 
					                    <i class="entypo-feather"></i> 
					                    <i class="fa fa-cogs"></i> 
		                			</div> 
	 
	 				                <div class="timeline-label"> 
					                    <h2><a href="#"><?php 
					                    // echo $post['nickname'] 
					                    ?></a> <span>
					                    <?php 
					                    // echo $post['created'] 
					                    ?></span></h2> 
					                    <p><?php
					                     // echo $post['comment']
					                      ?></p> 
					                </div> 
	            				 </div> 
  
         					</article> 
         				<?php 
         				// endwhile; 
         				?>
 
         				<article class="timeline-entry begin"> 
 
 
						        <div class="timeline-entry-inner"> 
						 
						 
						            <div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);"> 
						                <i class="entypo-flight"></i> + 
						            </div> 
						 
						 
						        </div> 
					
						</article> 
					<!-- <ul> -->
						<!-- <li>id,nickname,comment,password,created,modified</li> -->
						<?php
							//2.1行ずつデータを取り出す
							// while ($post = mysql_fetch_assoc($posts)){
							// 	echo '<li>'.$post['id'];
							// 	echo ','.$post['nickname'];
							// 	echo ','.$post['comment'];
							// 	echo ','.$post['password'];
							// 	echo ','.$post['created'];
							// 	echo ','.$post['modified'];
							// 	echo '</li>';
							// }
						?>
						<!-- <li>1,おなまえ1,こめんと1,ぱすわーど,2015-10-22 13:00,2015-10-22 13:00</li> -->
						<!-- <li>2,おなまえ2,こめんと1,ぱすわーど,2015-10-22 13:00,2015-10-22 13:00</li> -->
					<!-- </ul> -->
				</div><!-- col-md-8 -->
			</div><!-- row -->
		</div><!-- container -->
   	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <!-- Include all compiled plugins (below), or include individual files as needed --> 
    <script src="assets/js/bootstrap.js"></script> 
    <script src="assets/js/form.js"></script> 
</body>
</html>
