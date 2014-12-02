<?php
/**
 * 
 *
 */

class Shiyida
{

	//全局变量 Redis 
	public $redis = null;
	
	//构造函数
    public function __construct()
    {
        //实例化Redis
		$this->redis = new Redis();
		//连接Redis
		$this->redis->connect("121.42.8.51");
		$this->redis->auth("memeda");
		
    }
	
	//测试方法，用来打印输出一句话，测试是否调用成功
	public function info(){
		echo "This is Shiyida Interface";
	}
	
	
	//传入分类，返回分类的代号
	public function getCateId($classification){
	
		$categories = $this->redis->keys("category*");
		//存储分类的代号
		$num = 0;   
		foreach ($categories as $category){
			$res = $this->redis->HGET($category,"name");
			if($res&&$res==$classification){
				//如果结果不为空且等于POST的值
				$num = $this->redis->HGET($category,"cid");
				return $num;
			}
		}
		return $num;
	}
    
	//通过分类的ID获取该分类的帖子一共有多少个
	public function getPostsNumByCateId($id){
		$count = count($this->redis->zRange("categories:".$id.":tid",0,-1));
		return $count;
	}
	
	//通过分类的ID获取该分类的帖子代号
	public function getAllPostsIdByCateId($id){
		$postsId = $this->redis->zRange("categories:".$id.":tid",0,-1);
		return $postsId;
	}
	
	//通过分类的ID和开始索引，结束索引，获取该分类的帖子代号
	public function getPostsIdByCateIdAndIndex($id,$start,$end){
		$postsId = $this->redis->zRange("categories:".$id.":tid",$start,$end);
		return $postsId;
	}
	
	//传入总数，页码代号，每页的数量，返回开始和结束的标号
	//如共14条数据，传入14,3(第三页),5(每页五条),返回 10,13 即第11开始、第14结束 
	//返回结果是数组，索引0为开始，索引1为结束
	public function getStartAndEnd($totalNum,$page,$perpage){
		$start = ($page-1)*$perpage;
		$end = $start+$perpage-1;
		//返回的结果
		$result;
		if($start>=$totalNum){
			$result[0] = 0;
			$result[1] = 0;
			return $result;
		}else if($end>=$totalNum){
			$end = $totalNum-1;
		}
		$result[0] = $start;
		$result[1] = $end;
		return $result;
	}
	
	//通过传入分类的代号,页码，每页数量，来获取帖子的代号，返回数组
	public function getPostsIdByCateId($cate_id,$page,$perpage){
	
		//通过分类的ID获取该分类的帖子一共有多少个
		$posts_count = $this->getPostsNumByCateId($cate_id);
		//返回值result保存了开始索引和结束索引，两者皆为0代表无效
		$result = $this->getStartAndEnd($posts_count,$page,$perpage);
		//判断两者不是均为0
		if(!($result[0]==0&&$result[1]==0)){
			//返回每页帖子的代号
			$postsId = $this->getPostsIdByCateIdAndIndex($cate_id,$result[0],$result[1]);
			return $postsId;
		}else{
			return null;
		}
		
	}
	
	//传入分类的名字，页码，每页数量，获取帖子详情，返回JSON
	public function getPostsByCateNameToPage($classification,$page,$perpage){
		$postsId = $this->getPostsIdByCateName($classification,$page,$perpage);
		$count = count($postsId);
		$results = null;
		for($i=0;$i<$count;$i++){
			//数据库查询
			$title = $this->redis->hget("topic:".$postsId[$i],"title");
			//发布时间，时间戳
			$timestamp = $this->redis->hget("topic:".$postsId[$i],"timestamp");
			//最后回复
			$lastposttime = $this->redis->hget("topic:".$postsId[$i],"lastposttime");
			//浏览量
			$viewcount = $this->redis->hget("topic:".$postsId[$i],"viewcount");
			//用户ID
			$uid = $this->redis->hget("topic:".$postsId[$i],"uid");
			//用户头像
			$picture = $this->redis->hget("user:".$uid,"picture");
			//用户名
			$username = $this->redis->hget("user:".$uid,"username");
			//为一维JSON赋值
			$result['title'] = $title;
			$result['posttime'] = $timestamp;
			$result['lastreply'] = $lastposttime;
			$result['viewcount'] = $viewcount;
			$result['picture'] = $picture;
			$result['username'] = $username;
			$results[$i] = $result;
		}
		return  json_encode($results);
	}
	
	//通过传入分类的名字,页码，每页数量，来获取帖子代号数组
	public function getPostsIdByCateName($classification,$page,$perpage){
		$cate_id = $this->getCateId($classification);
		$postsId = $this->getPostsIdByCateId($cate_id,$page,$perpage);
		return $postsId;
	}

}

?>