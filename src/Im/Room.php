<?php

namespace cccdl\yunxin_sdk\Im;

use cccdl\yunxin_sdk\Exception\cccdlException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @see https://doc.yunxin.163.com/nertc/server-apis/TE0NDI4MjY?platform=server 房间管理
 * 创建频道
 * @see https://doc.yunxin.163.com/live-streaming/server-apis/TkzNzkzNTk?platform=server#%E5%88%9B%E5%BB%BA%E9%A2%91%E9%81%93
 *
 * @seehttps://doc.yunxin.163.com/nertc/server-apis/zQ0MDkzNDI?platform=server 推流任务
 * 流程：创建房间 createRoom，创建频道createChannel，创建推流任务createStreamTaskV3
 *
 *
 */
class Room extends Base
{

    /**
     * 创建音视频房间
     * @see https://doc.yunxin.163.com/nertc/server-apis/jg3NjcyNTE?platform=server
     */
    public function createRoom($channelName, $uid): array
    {
        $url = 'https://logic-dev.netease.im/v2/api/room';
        $data = [
            'channelName' => $channelName,
            'mode' => 2,
            'uid' => $uid,
        ];
        return $this->postV2($url, $data);

    }

    /**
     * 创建频道
     * @param string $name
     * @param int $type
     * @return array
     * @see https://doc.yunxin.163.com/live-streaming/server-apis/TkzNzkzNTk?platform=server#%E5%88%9B%E5%BB%BA%E9%A2%91%E9%81%93
     *
     */
    public function createChannel(string $name, int $type = 0): array
    {
        $url = 'https://vcloud.163.com/app/channel/create';
        $data = [
            'name' => $name,
            'type' => $type,
        ];
        return $this->postV2($url, $data);

    }



    /**
     * 创建推流任务
     * @param int $user_id
     * @param string $cname
     * @param string $task_id
     * @param string $stream_url
     * @param  $layout
     * @return array|bool|int|string
     * https://doc.yunxin.163.com/nertc/server-apis/DM0MTg2NTM?platform=server
     */
    public function createStreamTaskV3(int $user_id, string $cname, string $task_id, string $stream_url,  $layout)
    {
        $url = sprintf('https://logic-dev.netease.im/v3/api/rooms/task?cname=%s', $cname);
        $data = [
            'hostuid' => $user_id,
            'taskId' => $task_id,
            'streamUrl' => $stream_url,
            'layout' => $layout,
            'version' => 1,
        ];
        return $this->postV2($url, $data);
    }

    /**
     * 创建推流任务
     * @param int $user_id
     * @param string $cid
     * @param string $task_id
     * @param string $stream_url
     * @param  $layout
     * @return array|bool|int|string
     * https://doc.yunxin.163.com/nertc/server-apis/zQ0MDkzNDI?platform=server
     */
    public function createStreamTaskV3ByCid(int $user_id, string $cid, string $task_id, string $stream_url, $layout)
    {
        $url = sprintf('https://logic-dev.netease.im/v2/api/rooms/%s/task', $cid);
        $data =[
            'hostuid' => $user_id,
            'taskId' => $task_id,
            'streamUrl' => $stream_url,
            'layout' => $layout,
            'version' => 1,
        ];
        return $this->postV2($url, $data);

    }


    /**
     * 查看推流任务
     * @param string $cname
     * @param string $task_id
     * @return array|bool|int|string
     * https://doc.yunxin.163.com/nertc/server-apis/jE5OTE5NDA?platform=server
     */
    public function getStreamTaskV3(string $cname, string $task_id)
    {
        $url = sprintf('https://logic-dev.netease.im/v3/api/rooms/task?cname=%s&taskId=%s', $cname, $task_id);
        $res = $this->get($url, "", 'GET', true);

        return $res;
    }




    /**
     * 更新推流任务
     * @param int $user_id
     * @param string $cname
     * @param string $task_id
     * @param string $stream_url
     * @param $layout
     * @param bool $record
     * @param $is_all_audio
     * @return mixed
     * @throws cccdlException
     * https://doc.yunxin.163.com/nertc/server-apis/zQ0MDkzNDI?platform=server
     */
    public function updateStreamTaskV3(int $user_id, string $cname, string $task_id, string $stream_url,  $layout, bool $record = false, $is_all_audio = false)
    {
        $url = sprintf('https://logic-dev.netease.im/v3/api/rooms/update/task?cname=%s', $cname);
        $data = [
            'taskId' => $task_id,
            'streamUrl' => $stream_url,
            'layout' => $layout,
            'record' => $record,
            'hostuid' => $user_id,
        ];
        if($is_all_audio){
            $data['config'] = ['subAllAudio' => true];
            $data['version'] = 1;
        }
        return $this->postV2($url, $data);
    }

}