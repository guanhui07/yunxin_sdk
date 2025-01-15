<?php

namespace cccdl\yunxin_sdk\Im;

use cccdl\yunxin_sdk\Exception\cccdlException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @see https://doc.yunxin.163.com/nertc/server-apis/zQ1MDM1MjQ?platform=server
 *
 * @see https://doc.yunxin.163.com/nertc/server-apis/zQ0MDkzNDI?platform=server 推流任务
 * 流程：创建直播房间 createRoom，创建频道createChannel，创建推流任务createStreamTaskV3
 *
 *
 */
class RoomStreamTask extends Base
{

    /**
     * 创建推流任务 创建旁路推流任务
     * @param int $user_id
     * @param string $cname
     * @param string $task_id
     * @param string $stream_url
     * @param  $layout
     * @return array|bool|int|string
     * @see https://doc.yunxin.163.com/nertc/server-apis/DM0MTg2NTM?platform=server
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
     * 创建推流任务 创建旁路推流任务
     * @param int $user_id
     * @param string $cid
     * @param string $task_id
     * @param string $stream_url
     * @param  $layout
     * @return array|bool|int|string
     * @see https://doc.yunxin.163.com/nertc/server-apis/zQ0MDkzNDI?platform=server
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
     * 查看推流任务 查询指定旁路推流任务
     * @param string $cname
     * @param string $task_id
     * @return array|bool|int|string
     * @see https://doc.yunxin.163.com/nertc/server-apis/jE5OTE5NDA?platform=server
     */
    public function getStreamTaskV3(string $cname, string $task_id)
    {
        $url = sprintf('https://logic-dev.netease.im/v3/api/rooms/task?cname=%s&taskId=%s', $cname, $task_id);
        $res = $this->get($url, "", 'GET', true);

        return $res;
    }




    /**
     * 更新推流任务 更新旁路推流任务
     * @param int $user_id
     * @param string $cname
     * @param string $task_id
     * @param string $stream_url
     * @param $layout
     * @param bool $record
     * @param $is_all_audio
     * @return mixed
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/nertc/server-apis/zQ0MDkzNDI?platform=server
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


    /**
     * 删除推流任务 停止旁路推流任务
     * @param string $cname
     * @param string $task_id
     * @param int $user_id
     * @return array|bool|int|string
     * @see https://doc.yunxin.163.com/nertc/server-apis/TE4MjU4NjY?platform=server
     */
    public function deleteStreamTaskV3(string $cname, string $task_id)
    {
        $url = sprintf('https://logic-dev.netease.im/v3/api/rooms/task?cname=%s', $cname);
        $data = [
            'taskId' => $task_id,
        ];
        return $this->postV2($url, $data);
    }

    /**
     * 删除推流任务 停止旁路推流任务
     * @param string $cname
     * @param string $task_id
     * @param int $user_id
     * @return array|bool|int|string
     * @see https://doc.yunxin.163.com/nertc/server-apis/TE4MjU4NjY?platform=server
     */
    public function deleteStreamTask(int $cid, string $task_id)
    {
        $url = sprintf('https://logic-dev.netease.im/v2/api/rooms/%d/task', $cid);
        $data = [
            'taskId' => $task_id,
        ];
        return $this->postV2($url, $data);
    }


}