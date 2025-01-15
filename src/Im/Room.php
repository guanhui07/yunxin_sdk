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





}