<?php
    
    function config_init(){
        $conf=fopen("./seagroup.conf","r");
        do{
        $str=fgets($conf,1024);
        if($str[0]!="#"&&$str[0]!=""){
            $aim=explode(" ",$str);
            $i=$aim[0];
            global $$i;
            $$i=str_replace("\n","",$aim[1]);
        }
        }while($str!=NULL);
    }
    
    function UseAPI($ID){
        global $TOKEN,$API_URL,$GROUP_ID;
        $api = curl_init();
        $header = array("Authorization: Token {$TOKEN}");//定义请求头，这里需要使用TOKEN做验证
        $request = "user_name={$ID}@tsinghua.edu.cn";//定义提交的数据，这里传入学号
        $URL = "{$API_URL}groups/{$GROUP_ID}/members/";
        $data=json_encode($request);//这里进行对数据进行JSON编码
        curl_setopt($api, CURLOPT_URL,$URL); //定义请求地址
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_SSL_VERIFYHOST, false);// 跳过SSL检查
        curl_setopt($api, CURLOPT_CUSTOMREQUEST, "PUT"); //定义请求类型为PUT
        curl_setopt($api, CURLOPT_HEADER,0); //定义是否显示状态头 1：显示 ； 0：不显示
        curl_setopt($api, CURLOPT_HTTPHEADER, $header);//定义header
        curl_setopt($api, CURLOPT_RETURNTRANSFER,1);//定义是否直接输出返回流
        curl_setopt($api, CURLOPT_POSTFIELDS, $request); //定义提交的数据
        
        return curl_exec($api);//返回请求结果
        
    }

    function Addmembers($aid,$bid){ //本函数用于循环添加学生
        $aid=(int)$aid;
        $bid=(int)$bid;
        $err=array();
        $count=0;
        for($i=$aid;$i<=$bid;$i++){
            echo "*";
            $result=UseAPI($i);
            $result=json_decode($result);
            if(!isset($result->{'success'})){
                $err[$i]=$result->{'error_msg'};
            }else{
                $count++;
            }
        }
        $err['count']=$count;
        echo "\n";
        return $err;
    }
    
    function EchoAddInfo($res){
        printf("共操作成功%d名用户，以下用户无法添加:\n",$res['count']);
        unset($res['count']);
        foreach($res as $x => $val){
            printf("%d:%s\n",$x,$val);
        }
    }
    
?>
