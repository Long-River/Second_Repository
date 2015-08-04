


<?php
	
	header("Content-Type: text/html; charset=utf-8");//强制转换为UTF-8编码格式
	require_once'conn.php';
	if(isset($_GET['var']))
	{
		$var = $_GET['var'];
		Select($var);
	}
	//根据传递进来的数据 从数据库中找到其他需要的信息
    //例如：传递进来一个学生学号 我们想要知道该学生的名字，年龄等等
	function Select($var)
	{
		connect("218.7.221.44","panther","panther123","CampusCircle");
		//connect("localhost","root","root","pan");

		mysql_query("SET NAMES UTF8");   //可以矫正从数据库读出数据到浏览器上显示乱码的错误，其位置为connect函数后
		$result = mysql_query("SELECT *FROM Student WHERE StudentID = $var");
		$row = mysql_fetch_array($result);    	
    	if($row)
  		{
        $StudentID = md5($var);

        $testJSON = array(
          'Name' => $row['Name'],
          'Nickname' => $row['Nickname'],
          'StudentID' => $StudentID,
          'School'=>$row['School'],
          'Professionals'=>$row['Professionals'],
          'Sex'=>$row['Sex'],
          'Post'=>$row['Post'],
          "Admission-time"=>$row['Admission-time'],
          "College"=>$row['College']);
        
         foreach ( $testJSON as $key => $value ) 
         {  
            $testJSON[$key] = urlencode ( $value );
         }  
         echo urldecode (json_encode( $testJSON ));
         //测试
         //鸡血石


  			// echo "昵称:".$row['niCheng'];
  			// echo "<br \>";
  			// echo "学号:".$row['StudentID'];
  			// echo "<br \>";
  			// echo "学校:".$row['xueXiao'];
  			// echo "<br \>";
  			// echo "系别:".$row['xiBie'];
  			// echo "<br \>";
  			// echo "性别:".$row['Sex'];
  			// echo "<br \>";
  			// echo "职务:".$row['zhiWu'];
  			// echo "<br \>";
  			// echo "入学时间:".$row['ruXueNianFen'];
  			
  		}
	}
	

?>