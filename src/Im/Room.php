<?php

namespace cccdl\yunxin_sdk\Im;

use cccdl\yunxin_sdk\Exception\cccdlException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @see https://doc.yunxin.163.com/nertc/server-apis/TE0NDI4MjY?platform=server 房间管理
 * 创建频道
 * @see https://doc.yunxin.163.com/live-streaming/server-apis/TkzNzkzNTk?platform=server#%E5%88%9B%E5%BB%BA%E9%A2%91%E9%81%93
 *
 * @see https://doc.yunxin.163.com/nertc/server-apis/zQ0MDkzNDI?platform=server 推流任务
 * 流程：创建直播房间 createRoom，创建频道createChannel，创建推流任务createStreamTaskV3
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
     * 查询房间在线成员信息
     * @see https://doc.yunxin.163.com/nertc/server-apis/jUzODcwODE?platform=server
     */
    public function getRtcRoomUsers(string $cid)
    {
        $url = 'https://logic-dev.netease.im/v2/api/rooms/' . $cid . '/members';
        return $this->get($url);
    }

    /**
     * 通过房间名剔除某人
     * https://doc.yunxin.163.com/nertc/server-apis/zY3NDA3MTc?platform=server
     */
    public function kickUerForVoiceVideoByCname($cname, $uid)
    {
        $url = 'https://logic-dev.netease.im/v3/api/kicklist/members?cname=' . $cname . '&uid=' . $uid;
        return $this->postV2($url, []);
    }


    //-------------频道-----------------

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
     * 获取频道信息
     * @param string $channel_id
     * @return array|bool|int|string
     */
    public function getChannel(string $channel_id)
    {
        $url = 'https://vcloud.163.com/app/channelstats';
        $data = [
            'cid' => $channel_id,
        ];
        return $this->postV2($url, $data);
    }

    /**
     * 删除频道
     * @param string $channel_id
     * @return array
     */
    public function deleteChannel(string $channel_id)
    {
        $url = 'https://vcloud.163.com/app/channel/delete';
        $data = [
            'cid' => $channel_id,
        ];
        return $this->postV2($url, $data);
    }


}