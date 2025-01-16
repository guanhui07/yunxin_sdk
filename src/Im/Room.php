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
     *  创建音视频房间
     * @see https://doc.yunxin.163.com/nertc/server-apis/jg3NjcyNTE?platform=server
     * @param string $channelName 随机字符串
     * @param int $uid
     * @return array
     * @throws cccdlException
     */
    public function createRoom(string $channelName, int $uid): array
    {
        $url = 'https://logic-dev.netease.im/v2/api/room';
        $data = [
            'channelName' => $channelName, //
            'mode' => 2, //云信固定要求2
            'uid' => $uid,
        ];
        return $this->postV2($url, $data);

    }

    /**
     *  查询房间在线成员信息
     * @see https://doc.yunxin.163.com/nertc/server-apis/jUzODcwODE?platform=server
     * @param string $cid
     * @return mixed
     * @throws cccdlException
     */
    public function getRtcRoomUsers(string $cid)
    {
        $url = 'https://logic-dev.netease.im/v2/api/rooms/' . $cid . '/members';
        return $this->get($url);
    }


    /**
     *  通过房间名剔除某人
     *  https://doc.yunxin.163.com/nertc/server-apis/zY3NDA3MTc?platform=server
     * @param string $cname
     * @param int $uid
     * @return mixed
     * @throws cccdlException
     */
    public function kickUerForVoiceVideoByCname(string $cname, int $uid)
    {
        $url = 'https://logic-dev.netease.im/v3/api/kicklist/members?cname=' . $cname . '&uid=' . $uid;
        return $this->postV2($url, []);
    }


    /**
     *  通过房间名删除某个房间
     *  https://doc.yunxin.163.com/nertc/server-apis/zY3NDA3MTc?platform=server
     * @param string $cname
     * @return false
     */
    public function delRoomForVoiceVideoByCName(string $cname)
    {
//        $url = 'https://logic-dev.netease.im/v3/api/rooms?cname=' . $cname;
//        $this->postDataCurl($url, [], 'DELETE');

        return false;
    }

    /**
     * @param string $cid
     */
    public function delRoomForVoiceVideo(string $cid)
    {
//        $url = 'https://logic-dev.netease.im/v2/api/rooms/' . $cid;
//        $this->postDataCurl($url, [], 'DELETE');

    }


    /**
     *  查询某个房间状态信息
     *  https://doc.yunxin.163.com/nertc/server-apis/TI5MTIwNDc
     * @param string $cid
     * @return mixed
     * @throws cccdlException
     */
    public function getRoomStateForVoiceVideo(string $cid)
    {
        $url = 'https://logic-dev.netease.im/v2/api/rooms/' . $cid;
        return $this->get($url);
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