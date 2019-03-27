<?php
$jiekou = trim(isset($_POST['jiekou']) ? $_POST['jiekou'] : '');


$a="localhost";    //主机名
$b="root";  //数据库用户名
$c="";  //密码 没有就填空
$d="zhouyingwei2";  //数据库名称
$lian=new mysqli($a,$b,$c,$d); //连接数据库

        /*
    验证用户名存不存在接口 
    接口：register;
    yonghu: 要注册的用户名
    返回0 不存在此用户名
    返回1 存在此用户名 
    */
if($jiekou=="register"){
    $yonghu = trim(isset($_POST['yonghu']) ? $_POST['yonghu'] : '');
    $sql="select * from user where shouji like '$yonghu'"; 
    $res=$lian->query($sql); 
    $rom=$res->fetch_all(MYSQLI_ASSOC); 
    if($rom==null){
        echo 0;
    }else{
        echo 1;
    }
}

        /*
    注册接口 
    接口：register2;
    shouji: 要注册的手机号
    name: 要注册的用户名
    mima: 要注册的密码
    youxiang: 要注册的邮箱
    返回 false 失败
    返回 true 成功
    */
if($jiekou=="register2"){
    $shouji = trim(isset($_POST['shouji']) ? $_POST['shouji'] : '');
    $name = trim(isset($_POST['name']) ? $_POST['name'] : '');
    $mima = trim(isset($_POST['mima']) ? $_POST['mima'] : '');
    $youxiang = trim(isset($_POST['youxiang']) ? $_POST['youxiang'] : '');
    $zheng="INSERT INTO user(shouji,name,mima,youxiang) VALUES('$shouji','$name','$mima','$youxiang')";
    $res=$lian->query($zheng);
    echo json_encode($res,JSON_UNESCAPED_UNICODE); 
}

        /*
    登录接口 
    yonghu: 要登录的用户名
    mima:   要登录的密码
    */
if($jiekou=="login"){
    $shouji = trim(isset($_POST['shouji']) ? $_POST['shouji'] : '');
    $mima = trim(isset($_POST['mima']) ? $_POST['mima'] : '');

    $sql="select * from user where `shouji` like '$shouji' and `mima` like '$mima'";
    $res=$lian->query($sql);
    $rom=$res->fetch_all(MYSQLI_ASSOC);
    echo json_encode($rom,JSON_UNESCAPED_UNICODE);
}


        /*
    渲染接口 
    biao:要查询的表
    leixing : 要查询的类型
    mingcheng : 要查询的名称
    tiao : 从第几条开始
    tiao2 : 每次加载多少条
    */
if($jiekou=="xuanran"){
$biao = trim(isset($_POST['biao']) ? $_POST['biao'] : '');
$leixing = trim(isset($_POST['leixing']) ? $_POST['leixing'] : '');
$mingcheng = trim(isset($_POST['mingcheng']) ? $_POST['mingcheng'] : '');
$tiao = trim(isset($_POST['tiao']) ? $_POST['tiao'] : '');
$tiao2 = trim(isset($_POST['tiao2']) ? $_POST['tiao2'] : '');

$sql="SELECT * FROM $biao WHERE $leixing LIKE '$mingcheng' LIMIT $tiao,$tiao2";
$res=$lian->query($sql);
$rom=$res->fetch_all(MYSQLI_ASSOC);
echo json_encode($rom,JSON_UNESCAPED_UNICODE);
}


/*
搜索渲染接口（多字段查询）（排序查询）（搜索查询）
mingcheng : 要查询的名称
tiao : 从第几条开始
tiao2 : 每次加载多少条
paixun : 要排序的类型
$shengjiang1 : 价格的升序和降序
$shengjiang2 : 销量的升序和降序
*/
if($jiekou=="sousuo"){
$mingcheng = trim(isset($_POST['mingcheng']) ? $_POST['mingcheng'] : '');
$mingcheng2 = trim(isset($_POST['mingcheng2']) ? $_POST['mingcheng2'] : '');
$leixing = trim(isset($_POST['leixing']) ? $_POST['leixing'] : '');
$tiao = trim(isset($_POST['tiao']) ? $_POST['tiao'] : '');
$tiao2 = trim(isset($_POST['tiao2']) ? $_POST['tiao2'] : '');

$paixun = trim(isset($_POST['paixun']) ? $_POST['paixun'] : '');
$shengjiang = trim(isset($_POST['shengjiang']) ? $_POST['shengjiang'] : '');
//正常搜索的语句
if($paixun==null){
    if($leixing==null){
        //搜索框语句
        $sql="SELECT * FROM list WHERE  `name` LIKE '%$mingcheng%' OR fenlei1 LIKE '%$mingcheng%' OR fenlei2 LIKE '%$mingcheng%' LIMIT $tiao,$tiao2";
    }
    if($leixing!=null){
        //分类栏语句
        $sql="SELECT * FROM list WHERE  fenlei1 LIKE '$mingcheng' AND $leixing LIKE '$mingcheng2' LIMIT $tiao,$tiao2";
    } 
}
if($paixun!=null){//点击排序时的语句
    if($leixing==null){
        if($shengjiang=="true"){
            //升序
            $sql="SELECT * FROM list WHERE  `name` LIKE '%$mingcheng%' OR fenlei1 LIKE '%$mingcheng%' OR fenlei2 LIKE '%$mingcheng%' ORDER BY `$paixun` LIMIT $tiao,$tiao2";
        }
        if($shengjiang=="false"){
            //降序
            $sql="SELECT * FROM list WHERE  `name` LIKE '%$mingcheng%' OR fenlei1 LIKE '%$mingcheng%' OR fenlei2 LIKE '%$mingcheng%' ORDER BY `$paixun` DESC LIMIT $tiao,$tiao2";
        }
    }
    if($leixing!=null){
        if($shengjiang=="true"){
            //升序
            $sql="SELECT * FROM list WHERE  fenlei1 LIKE '$mingcheng' AND $leixing LIKE '$mingcheng2' ORDER BY `$paixun`  LIMIT $tiao,$tiao2";
        }
        if($shengjiang=="false"){
            //降序
            $sql="SELECT * FROM list WHERE  fenlei1 LIKE '$mingcheng' AND $leixing LIKE '$mingcheng2' ORDER BY `$paixun` DESC  LIMIT $tiao,$tiao2";
        }
    }
}
$res=$lian->query($sql);
$rom=$res->fetch_all(MYSQLI_ASSOC);
echo json_encode($rom,JSON_UNESCAPED_UNICODE);
}

// 购物车添加商品接口
//id: 商品的id
//user: 用户id
//返回 true 添加成功
//返回 false 添加失败
//把商品id和用户id一起存到数据库
if($jiekou=="jiagouwu"){
    $id = trim(isset($_POST['id']) ? $_POST['id'] : '');
    $user = trim(isset($_POST['user']) ? $_POST['user'] : '');
    $shuliang = trim(isset($_POST['shuliang']) ? $_POST['shuliang'] : '');

    $sql="INSERT INTO shopping(`id`,`user`,`shuliang`) VALUES('$id','$user','$shuliang')";
    $res=$lian->query($sql);
    echo json_encode($res,JSON_UNESCAPED_UNICODE);
}

//购物车渲染接口（不同用户 不同购物车）
//user 用户ID
//id 商品id
//先根据用户名id查询此用户存的商品id
//再根据商品id查询列表页数据，进行渲染
if($jiekou=="gouwuche"){
    $user=trim(isset($_POST['user']) ? $_POST['user'] : '');
    $id=trim(isset($_POST['id']) ? $_POST['id'] : '');
    if($user!=null){
        $sql="SELECT * FROM shopping WHERE user LIKE '$user'";
    }
    if($id!=null){
        $sql="SELECT * FROM list WHERE id LIKE '$id'";
    }
    $res=$lian->query($sql);
    $rom=$res->fetch_all(MYSQLI_ASSOC);
    echo json_encode($rom,JSON_UNESCAPED_UNICODE);

}
//删除商品接口
//id 要删除的商品ID
//记得后面设条件是1条 不然会把同样id的商品全删了 
if($jiekou=="shanchu"){
    $id=trim(isset($_POST['id']) ? $_POST['id'] : '');
    $user=trim(isset($_POST['user']) ? $_POST['user'] : '');
    $sql="DELETE FROM `shopping` WHERE id='$id' AND user='$user' LIMIT 1";
    $res=$lian->query($sql);
    echo json_encode($res,JSON_UNESCAPED_UNICODE);
}



$lian->close();
?>