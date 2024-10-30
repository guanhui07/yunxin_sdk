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
     */
    public function sendRoomToMsg(int $fromAccid,array $toAccids,int $roomid,array $attach,int $msgId, $options = [], $ext = "")
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
     */
    public function sendRoomBroadcast(array $attach,int $msgId,int $fromAccid,array $options = [],array $ext = [])
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

}