<?php

namespace cccdl\yunxin_sdk\Im;

use cccdl\yunxin_sdk\Exception\cccdlException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @see https://doc.yunxin.163.com/messaging/server-apis/zk4Mzg0MjE?platform=server#聊天室
 */
class Chatroom extends Base
{
    const MSG_TYPE_TEXT = 0; // 文本类型
    const MSG_TYPE_IMAGE = 1; // 图片消息
    const MSG_TYPE_VOICE = 2; // 语音消息
    const MSG_TYPE_VIDEO = 3; // 视频消息
    const MSG_TYPE_LOCATION = 4; // 地理位置消息
    const MSG_TYPE_FILE = 6; // 文件消息
    const MSG_TYPE_TIP = 10; // 提示tip消息
    const MSG_TYPE_CUSTOM = 100; // 自定义消息

    /**
     * @param int $roomId
     * @param string $fromAccid
     * @param int $msgType
     * @param array $options
     * @return array
     * @throws GuzzleException
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/messaging/server-apis/jY2MDg1MTk?platform=server
     */
    public function sendMsg(int $roomId, string $fromAccid, int $msgType, array $options = []): array
    {
        $data = [
            'roomid' => $roomId,
            'msgId' => $this->getNonce(16) . $roomId . $fromAccid . time(),
            'fromAccid' => $fromAccid,
            'msgType' => $msgType,
        ];

        return $this->post('chatroom/sendMsg.action', array_merge($options, $data));

    }

    /**
     * 发送聊天室消息（指定用户）
     * @param int $fromAccid
     * @param array $toAccids
     * @param int $roomid
     * @param array $attach
     * @param int $msgId
     * @param $options
     * @param $ext
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/messaging/docs/DkzNTA5NTI?platform=server
     */
    public function sendRoomToMsg(int $fromAccid, array $toAccids, int $roomid, array $attach, int $msgId, $options = [], $ext = "")
    {
        $data = [
            'roomid' => $roomid,
            'msgId' => $msgId,
            'attach' => $attach,
            'fromAccid' => $fromAccid,
            'toAccids' => json_encode($toAccids),
            'msgType' => 100,
            'ext' => $ext,
        ];

        if (isset($options['useYidun'])) {
            $data['useYidun'] = $options['useYidun'];
            unset($options['useYidun']);
        }

        return $this->post('chatroom/sendMsgToSomeone.action', array_merge($options, $data));

    }

    /**
     * 发送聊天室消息（全服广播）
     * @param array $attach
     * @param int $msgId
     * @param int $fromAccid
     * @param array $options
     * @param array $ext
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/messaging/docs/zc1MTY2NDQ?platform=server
     */
    public function sendRoomBroadcast(array $attach, int $msgId, int $fromAccid, array $options = [], array $ext = [])
    {
        $data = [
            'msgId' => $msgId,
            'attach' => $attach,
            'fromAccid' => $fromAccid,
            'msgType' => 100,
            'ext' => $ext,
        ];

        if (isset($options['skipHistory'])) {
            $data['skipHistory'] = $options['skipHistory'];
            unset($options['skipHistory']);
        }
        if (isset($options['useYidun'])) {
            $data['useYidun'] = $options['useYidun'];
            unset($options['useYidun']);
        }

        return $this->post('chatroom/broadcast.action', array_merge($options, $data));
    }

    /**
     * 聊天室用户ids是否在线
     * @see https://doc.yunxin.163.com/docs/TM5MzM5Njk/TYyMDI1MTg?platformId=60353#批量获取在线成员信息
     */
    public function queryMembers(int $roomId, array $accids)
    {
        $data = [
            'roomid' => $roomId,
            'accids' => json_encode($accids),
        ];

        return $this->post('chatroom/queryMembers.action', $data);
    }

    /**
     * 聊天室用户 列表
     * @see https://doc.yunxin.163.com/docs/TM5MzM5Njk/TYyMDI1MTg?platformId=60353#分页获取成员列表
     * @param $type 0:固定成员;1:非固定成员;2:仅返回在线的固定成员
     * @see https://doc.yunxin.163.com/messaging/server-apis/zAzMjUxMzc?platform=server
     *
     */
    public function membersByPage(int $roomId, int $endTime = 0, int $type = 1, int $perPage = 100)
    {
        $data = [
            'roomid' => $roomId,
            'endtime' => $endTime,
            'type' => $type,
            'limit' => $perPage,
        ];

        return $this->post('chatroom/membersByPage.action', $data);
    }

    /**
     * 创建聊天室
     * @see https://doc.yunxin.163.com/messaging/server-apis/jA0MzQxOTI?platform=server
     */
    public function addChatRoom($creator, $name, $announcement = '', $broadcasturl = '', $ext = '', $queuelevel = 0)
    {
        $data = [
            'creator' => $creator,
            'name' => $name,
            'announcement' => $announcement,
            'broadcasturl' => $broadcasturl,
            'ext' => $ext,
            'queuelevel' => $queuelevel,
        ];
        return $this->post('chatroom/create.action', $data);
    }

}