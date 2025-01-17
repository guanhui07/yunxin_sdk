<?php

namespace cccdl\yunxin_sdk\Im;


use cccdl\yunxin_sdk\Exception\cccdlException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 消息管理
 * @see https://doc.yunxin.163.com/messaging/server-apis/DQ2NTg4ODE?platform=server
 * @see https://doc.yunxin.163.com/messaging/server-apis/zk4Mzg0MjE?platform=server#消息功能
 * @see https://doc.yunxin.163.com/messaging/server-apis/zk4Mzg0MjE?platform=server#历史消息与记录
 */
class Msg extends Base
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
     * 发送普通消息
     *
     * @param string $from 发送者accid，用户帐号，最大32字符，必须保证一个APP内唯一
     * @param int $ope 类型 0：点对点个人消息，1：群消息（高级群），其他返回414
     * @param string $to ope==0是表示accid即用户id，ope==1表示tid即群id
     * @param int $type 消息类型 对应self::MSG_TYPE_*
     * @param string $body 消息内容，最大长度5000字符，JSON格式
     * @param array $options 可选参数集合，支持如下：
     *
     * - antispam: bool, 对于对接了易盾反垃圾功能的应用，本消息是否需要指定经由易盾检测的内容（antispamCustom）。true或false, 默认false。
     *   只对消息类型为：100 自定义消息类型 的消息生效。
     *
     * - option: string, 指定消息的漫游，存云端历史，发送方多端同步，推送，消息抄送等特殊行为,使用 self::chatOption
     *
     * - pushcontent: string, 推送文案,最长500个字符，android以此为推送显示文案；ios若未填写payload，显示文案以pushcontent为准
     * - payload: sting, ios 推送对应的payload,必须是JSON,不能超过2k字符
     *
     * - ext: string, 开发者扩展字段，长度限制1024字符
     *
     * - forcepushlist: string, 发送群消息时的强推用户列表（云信demo中用于承载被@的成员），格式为JSONArray，如["accid1","accid2"]。
     *   若forcepushall为true，则forcepushlist为除发送者外的所有有效群成员
     *
     * - forcepushcontent: string, 发送群消息时，针对强推列表forcepushlist中的用户，强制推送的内容
     *
     * - forcepushall: bool, 发送群消息时，强推列表是否为群里除发送者外的所有有效成员，true或false，默认为false
     *
     * - bid: string, 反垃圾业务ID，实现“单条消息配置对应反垃圾”，若不填则使用原来的反垃圾配置
     *
     * - useYidun: int, 单条消息是否使用易盾反垃圾，可选值为0。0：（在开通易盾的情况下）不使用易盾反垃圾而是使用通用反垃圾，包括自定义消息。
     *   若不填此字段，即在默认情况下，若应用开通了易盾反垃圾功能，则使用易盾反垃圾来进行垃圾消息的判断
     *
     * - markRead: int, 群消息是否需要已读业务（仅对群消息有效），0:不需要，1:需要
     *
     * - checkFriend: bool, 是否为好友关系才发送消息，默认false，注：使用该参数需要先开通功能服务
     *
     * @param string $pushcontent 推送文案,最长500个字符,为空则不推送，写入内容则推送
     * @return array
     * @throws GuzzleException
     * @throws cccdlException
     *
     * @see https://doc.yunxin.163.com/messaging/docs/DQ2NTg4ODE?platform=server
     */
    public function sendMsg(string $from, int $ope, string $to, int $type, string $body, array $options = [], string $pushcontent = ''): array
    {
        $data = [
            'from' => $from,
            'ope' => $ope,
            'to' => $to,
            'type' => $type,
            'body' => $body,
        ];

        if (!empty($pushcontent)) {
            $data['pushcontent'] = $pushcontent;
        }

        return $this->post('msg/sendMsg.action', array_merge($options, $data));

    }

    /**
     * 批量发送点对点普通消息
     *
     * @param string $fromAccid 发送者accid，用户帐号，最大32字符，必须保证一个APP内唯一
     * @param array $toAccids 接受者数组，限500人
     * @param int $type 消息类型 对应self::MSG_TYPE_*
     * @param string $body 消息内容，最大长度5000字符，JSON格式
     * @param array $options 可选参数，支持如下
     *
     * - option: string, 指定消息的漫游，存云端历史，发送方多端同步，推送，消息抄送等特殊行为,使用 self::chatOption
     *
     * - pushcontent: string, 推送文案,最长500个字符，android以此为推送显示文案；ios若未填写payload，显示文案以pushcontent为准
     *
     * - payload: sting, ios 推送对应的payload,必须是JSON,不能超过2k字符
     *
     * - ext: string, 开发者扩展字段，长度限制1024字符
     *
     * - bid: string, 反垃圾业务ID，实现“单条消息配置对应反垃圾”，若不填则使用原来的反垃圾配置
     *
     * - useYidun: int, 单条消息是否使用易盾反垃圾，可选值为0。0：（在开通易盾的情况下）不使用易盾反垃圾而是使用通用反垃圾，包括自定义消息。
     *   若不填此字段，即在默认情况下，若应用开通了易盾反垃圾功能，则使用易盾反垃圾来进行垃圾消息的判断
     *
     * @param string $pushcontent
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function sendBatchMsg(string $fromAccid, array $toAccids, int $type, string $body, array $options = [], string $pushcontent = '')
    {
        $data = [
            'fromAccid' => $fromAccid,
            'toAccids' => json_encode($toAccids),
            'type' => $type,
            'body' => $body,
        ];

        if (!empty($pushcontent)) {
            $data['pushcontent'] = $pushcontent;
        }

        return $this->post('msg/sendBatchMsg.action', array_merge($options, $data));
    }

    /**
     * 发送自定义系统通知
     *
     * @param string $from 发送者accid，用户帐号，最大32字符，APP内唯一
     * @param int $msgtype 消息类型，0：点对点自定义通知，1：群消息自定义通知，其他返回414
     * @param string $to msgtype==0是表示accid即用户id，msgtype==1表示tid即群id
     * @param string $attach 自定义通知内容，第三方组装的字符串，建议是JSON串，最大长度4096字符
     * @param array $options 可选参数集合，支持如下：
     *
     * - option: string, 指定消息计数等特殊行为,使用 self::noticeOption生成
     *
     * - pushcontent: string, 推送文案,最长500个字符，android以此为推送显示文案；ios若未填写payload，显示文案以pushcontent为准
     *
     * - payload: sting, ios 推送对应的payload,必须是JSON,不能超过2k字符
     *
     * - sound: string, 如果有指定推送，此属性指定为客户端本地的声音文件名，长度不要超过30个字符，如果不指定，会使用默认声音
     *
     * - save: int, 1表示只发在线，2表示会存离线，其他会报414错误。默认会存离线
     *
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/messaging/server-apis/jYxMjQ1NTk?platform=server#api-
     * @see https://doc.yunxin.163.com/messaging/server-apis/zk4Mzg0MjE?platform=server#自定义系统通知
     */
    public function sendAttachMsg(string $from, int $msgtype, string $to, string $attach, array $options = [])
    {
        return $this->post('msg/sendAttachMsg.action', array_merge($options, [
            'from' => $from,
            'msgtype' => $msgtype,
            'to' => $to,
            'attach' => $attach,
        ]));
    }


    /**
     * 批量发送点对点自定义系统通知
     *
     * @param string $fromAccid 发送者accid，用户帐号，最大32字符，APP内唯一
     * @param array $toAccids 接收者 最大限500人
     * @param string $attach 自定义通知内容，第三方组装的字符串，建议是JSON串，最大长度4096字符
     * @param array $options 可选参数集合，支持以下选项:
     *
     * - option: string, 指定消息计数等特殊行为,使用 self::noticeOption生成
     *
     * - pushcontent: string, 推送文案,最长500个字符，android以此为推送显示文案；ios若未填写payload，显示文案以pushcontent为准
     *
     * - payload: sting, ios 推送对应的payload,必须是JSON,不能超过2k字符
     *
     * - sound: string, 如果有指定推送，此属性指定为客户端本地的声音文件名，长度不要超过30个字符，如果不指定，会使用默认声音
     *
     * - save: int, 1表示只发在线，2表示会存离线，其他会报414错误。默认会存离线
     *
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/messaging/server-apis/Dk2MjQwODA?platform=server
     *
     * @see https://doc.yunxin.163.com/messaging/server-apis/Dk2MjQwODA?platform=server
     */
    public function sendBatchAttachMsg(string $fromAccid, array $toAccids, string $attach, array $options = [])
    {
        return $this->post('msg/sendBatchAttachMsg.action', array_merge($options, [
            'fromAccid' => $fromAccid,
            'toAccids' => json_encode($toAccids),
            'attach' => $attach,
        ]));
    }


    /**
     * 对在应用内的用户发送广播消息
     *
     * @param string $body 广播消息内容
     * @param array $options 可选参数集合，支持以下选项:
     *
     * - from: string, 发送者accid, 用户帐号，最大长度32字符，必须保证一个APP内唯一
     *
     * - isOffline: bool, 是否存离线，true或false，默认false
     *
     * - ttl: int, 存离线状态下的有效期，单位小时，默认7天
     *
     * - targetOs: string, 目标客户端，默认所有客户端，jsonArray，例如 ["ios","aos","pc","web","mac"]
     *
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function broadcastMsg(string $body, array $options = [])
    {
        return $this->post('msg/broadcastMsg.action', array_merge($options, ['body' => $body]));
    }


    /**
     * 生成文本消息
     * @param string $msg
     * @return string
     */
    public static function textFormat(string $msg): string
    {
        return json_encode(['msg' => $msg]);
    }

    /**
     * 图片消息
     * @param string $name
     * @param string $md5
     * @param string $url
     * @param string $ext
     * @param int $w
     * @param int $h
     * @param int $size
     * @return string
     */
    public static function imageFormat(string $name, string $md5, string $url, string $ext, int $w, int $h, int $size): string
    {
        return json_encode([
            'name' => $name,
            'md5' => $md5,
            'url' => $url,
            'ext' => $ext,
            'w' => $w,
            'h' => $h,
            'size' => $size,
        ]);
    }

    /**
     * 语音消息
     * @param int $dur 时长ms
     * @param string $md5 播放地址
     * @param string $url
     * @param int $size 文件大小
     * @return string
     */
    public static function voiceFormat(int $dur, string $md5, string $url, int $size): string
    {
        return json_encode([
            'dur' => $dur,
            'md5' => $md5,
            'url' => $url,
            'ext' => 'acc', // 语音消息格式，只能是aac格式
            'size' => $size,
        ]);
    }

    /**
     * 视频消息
     * @param int $dur 视频持续时长ms
     * @param string $md5
     * @param string $url 播放地址
     * @param int $w 宽
     * @param int $h 高
     * @param string $ext 后缀名
     * @param int $size 文件大小
     * @return string
     */
    public static function videoFormat(int $dur, string $md5, string $url, int $w, int $h, string $ext, int $size): string
    {
        return json_encode([
            'dur' => $dur,
            'md5' => $md5,
            'url' => $url,
            'w' => $w,
            'h' => $h,
            'ext' => $ext,
            'size' => $size,
        ]);
    }

    /**
     * 地理位置消息
     * @param string $title 地理位置说明，例如：中国 浙江省 杭州市 网商路 599号
     * @param string $lng 经度，例如 120.1908686708565
     * @param string $lat 纬度，30.18704515647036
     * @return string
     */
    public static function locationFormat(string $title, string $lng, string $lat): string
    {
        return json_encode(['title' => $title, 'lng' => $lng, 'lat' => $lat]);
    }

    /**
     * 文件消息
     * @param string $name 文件名
     * @param string $md5
     * @param string $url 地址
     * @param string $ext 格式，例如ttf
     * @param int $size 文件大小
     * @return string
     */
    public static function fileFormat(string $name, string $md5, string $url, string $ext, int $size): string
    {
        return json_encode(['name' => $name, 'md5' => $md5, 'url' => $url, 'ext' => $ext, 'size' => $size]);
    }


    /**
     * 系统通知的附加选项
     * @param bool $route 该消息是否需要抄送第三方 (需要app开通消息抄送功能)
     * @param bool $badge 该消息是否需要计入到未读计数中
     * @param bool $needPushNick 推送文案是否需要带上昵称
     * @return string
     */
    public static function noticeOption(bool $route = false, bool $badge = true, bool $needPushNick = false): string
    {
        return json_encode(['route' => $route, 'badge' => $badge, 'needPushNick' => $needPushNick]);
    }

    /**
     * 聊天消息附加选项
     * @param bool $roam 该消息是否需要漫游（需要app开通漫游消息功能）
     * @param bool $history 该消息是否存云端历史
     * @param bool $sendersync 该消息是否需要发送方多端同步
     * @param bool $push 该消息是否需要APNS推送或安卓系统通知栏推送
     * @param bool $route 该消息是否需要抄送第三方 (需要app开通消息抄送功能)
     * @param bool $badge 该消息是否需要计入到未读计数中
     * @param bool $needPushNick 推送文案是否需要带上昵称
     * @param bool $persistent 是否需要存离线消息
     * @return string
     */
    public static function chatOption(
        bool $roam = true,
        bool $history = false,
        bool $sendersync = false,
        bool $push = true,
        bool $route = false,
        bool $badge = true,
        bool $needPushNick = false,
        bool $persistent = true
    ): string
    {
        return json_encode([
            'roam' => $roam,
            'history' => $history,
            'sendersync' => $sendersync,
            'push' => $push,
            'route' => $route,
            'badge' => $badge,
            'needPushNick' => $needPushNick,
            'persistent' => $persistent,
        ]);
    }

    /**
     * 发送单聊已读回执
     * https://doc.yunxin.163.com/messaging/server-apis/zcwMDk2Mzk?platform=server
     * @param $accid
     * @param $accid2
     * @param $msgidClient string 客户端消息 ID 指由 SDK 侧生成的消息 ID。
     * @return array|bool|int|string|null
     */
    public function markReadMsg(int $accid, int $accid2, string $msgidClient, array $options = [])
    {
        $body = [
            'from' => $accid,
            'to' => $accid2,
            'msgidClient' => $msgidClient,
        ];
        return $this->post('/msg/markReadMsg.action', $body);
    }

    /**
     * 双向撤回 消息
     * https://doc.yunxin.163.com/messaging/server-apis/zE1NjUyNDg?platform=server
     * @param $accid
     * @param $accid2
     * @param $msgidClient string 客户端消息 ID 指由 SDK 侧生成的消息 ID。
     * @return array|bool|int|string|null
     */
    public function retractDelMsg($accid, $accid2, $msgidClient, $options = [])
    {
        $body = array(
            'from' => (string)$accid,
            'to' => (string)$accid2,
            'type' => 7, //表示单聊消息撤回
            'deleteMsgid' => $msgidClient,
        );
        return $this->post('/msg/recall.action', $body);
    }


    /**
     * 消息功能-文件上传
     * @param  $content [字节流base64串(Base64.encode(bytes)) ，最大15M的字节流]
     * @param  $type [上传文件类型]
     * @return $result      [返回array数组对象]
     * @see https://doc.yunxin.163.com/messaging/docs/zQyNDM0NzE?platform=server
     * @see  https://doc.yunxin.163.com/messaging/docs/zQyNDM0NzE?platform=server#%E5%88%86%E7%89%87%E4%B8%8A%E4%BC%A0
     */
    public function uploadMsg($content, $type = '0', $options = [])
    {
        $body = [
            'content' => $content,
            'type' => $type,
        ];
        return $this->post('/msg/upload.action', $body);
    }


    /**
     * 历史记录-单聊
     * @param  $from [发送者accid]
     * @param  $to [接收者accid]
     * @param  $begintime [开始时间，ms]
     * @param  $endtime [截止时间，ms]
     * @param  $limit [本次查询的消息条数上限(最多100条),小于等于0，或者大于100，会提示参数错误]
     * @param  $reverse [1按时间正序排列，2按时间降序排列。其它返回参数414.默认是按降序排列。]
     * @return $result      [返回array数组对象]
     * @see https://doc.yunxin.163.com/messaging/server-apis/DE0MTk0OTY?platform=server#%E5%8D%95%E8%81%8A%E4%BA%91%E7%AB%AF%E5%8E%86%E5%8F%B2%E6%B6%88%E6%81%AF%E6%9F%A5%E8%AF%A2
     *
     */
    public function querySessionMsg($from, $to, $begintime, $endtime = '', $limit = '100', $reverse = '1')
    {
        $body = [
            'from' => $from,
            'to' => $to,
            'begintime' => $begintime,
            'endtime' => $endtime,
            'limit' => $limit,
            'reverse' => $reverse,
          ];
        return $this->post('/msg/querySessionMsg.action', $body);
    }


}
