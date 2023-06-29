<?php
class bilibiliAnime
{
    public $total;  // 追番总数
    public $title = array();  // 标题
    public $image_url = array();  // 图链
    public $fan_number = array();  // 番剧总集数
    public $progress = array();  // 观看进度
    public $evaluate = array();  // 简介
    public $type =  array();  // 类型
    public $season_id = array();  // ID号
    public $finish  = array(); //完结状态
    public $follow_status  = array(); //完结状态
    public $rating_score  = array(); //评分
    public $rating_count  = array(); //评分人数
    public $stat_view  = array(); //播放量
    public $area =array();
    
    // 获取追番总数
    private function getpage($uid)
    {
        $url = "https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=0&pn=1&ps=15&vmid=$uid";
        $info = json_decode(file_get_contents($url), true);
        return $info['data']['total'];
    }

    function area ($t)
{
    if(stripos($t,"僅限港澳台")){
        return 2;
    } elseif (stripos($t,"僅限港澳")){
        return 3;
    }
    elseif (stripos($t,"僅限台灣")){
        return 4;
    }
    else{
        return 1;
    };
}

    public function __construct($uid)
    {
        $this->total = $this->getpage($uid);
        for ($i = 1; $i <= ceil($this->total / 15); $i++) {
            $url = "https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=0&pn=$i&ps=15&vmid=$uid";
            $info = json_decode(file_get_contents($url), true);
            foreach ($info['data']['list'] as $data) {
                array_push($this->title, $data['title']);
                array_push($this->image_url, str_replace('http://', '//', $data['cover']));  // 协议跟随
                array_push($this->evaluate, $data['summary']);
                array_push($this->type, $data['season_type_name']);
                array_push($this->season_id, $data['season_id']);
                array_push($this->finish, $data['is_finish']);
                array_push($this->follow_status, $data['follow_status']);
                if (isset($data["rating"])){
                array_push($this->rating_score, $data['rating']['score']);
                array_push($this->rating_count, $data['rating']['count']);}
                else {
                array_push($this->rating_score, null);
                array_push($this->rating_count, null);                    
                }
                 if (isset($data['stat']['view'])){
                array_push($this->stat_view, $data['stat']['view']);}
                else { array_push($this->stat_view, null);}
                array_push($this->area, $this->area($data['title']));
            }
        }
    }
}
