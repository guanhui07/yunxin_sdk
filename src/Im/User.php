<?php

namespace cccdl\yunxin_sdk\Im;


use cccdl\yunxin_sdk\Exception\cccdlException;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 用户管理
 * @see https://doc.yunxin.163.com/messaging/server-apis/zk4Mzg0MjE?platform=server#云信-im-账号管理
 * @see https://doc.yunxin.163.com/messaging/server-apis/DQ3Nzk1MTY?platform=server
 */
class User extends Base
{
    /**
     * 创建网易云通信ID
     *
     * @param string $accid 网易云通信ID，最大长度32字符，必须保证一个APP内唯一。
     * （只允许字母、数字、半角下划线_、@、半角点以及半角-组成，不区分大小写，会统一小写处理，请注意以此接口返回结果中的accid为准）
     * @param array  $options 可选参数集合，支持如下：
     *
     * - name: string, 网易云通信ID昵称，最大长度64字符。
     *
     * - icon: string, 网易云通信ID头像URL，开发者可选填，最大长度1024
     *
     * - token: string,  网易云通信ID可以指定登录token值，最大长度128字符，并更新，如果未指定，会自动生成token，并在创建成功后返回
     *
     * - sign: string, 用户签名，最大长度256字符
     *
     * - email: string, 用户email，最大长度64字符
     *
     * - birth: string, 用户生日，最大长度16字符
     *
     * - mobile: string, 用户mobile，最大长度32字符，非中国大陆手机号码需要填写国家代码(如美国：+1-xxxxxxxxxx)或地区代码(如香港：+852-xxxxxxxx)
     *
     * - gender: int, 用户性别，0表示未知，1表示男，2女表示女，其它会报参数错误
     *
     * - ex: string, 用户名片扩展字段，最大长度1024字符，用户可自行扩展，建议封装成JSON字符串
     *
     * @return array 内容 ["token"=>"xx","accid"=>"xx","name"=>"xx"]
     * @throws GuzzleException
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/messaging/server-apis/DQ3Nzk1MTY?platform=server
     *
     */
    public function create(string $accid, array $options): array
    {
        return $this->post('user/create.action', array_merge($options, ['accid' => $accid]));

    }


    /**
     * 更新网易云通信token，可以对accid更新到指定的token，更新后请开发者务必做好本地的维护
     * @param string $accid 网易云通信ID，最大长度32字符，必须保证一个APP内唯一
     * @param string $token 网易云通信ID可以指定登录token值（即密码），最大长度128字符
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/messaging/server-apis/DUxNDQ3NjA?platform=server
     */
    public function update(string $accid, string $token)
    {
       return $this->post('user/update.action', ['accid' => $accid, 'token' => $token]);
    }


    /**
     * 封禁网易云通信ID
     *
     * - 封禁网易云通信ID后，此ID将不能再次登录。若封禁时，该id处于登录状态，则当前登录不受影响，仍然可以收发消息。封禁效果会在下次登录时生效。
     *   因此建议，将needkick设置为true，让该账号同时被踢出登录。
     * - 封禁时踢出，会触发登出事件消息抄送。
     * - 出于安全目的，账号创建后只能封禁，不能删除；封禁后账号仍计入应用内账号总数。
     *
     * @param string $accid 网易云通信ID，最大长度32字符，必须保证一个APP内唯一
     * @param bool   $needkick 是否踢掉被禁用户，true或false
     *
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/messaging/server-apis/TUzOTA4NTY?platform=server
     */
    public function block(string $accid, bool $needkick = true)
    {
        return $this->post('user/block.action', ['accid' => $accid, 'needkick' => $needkick]);
    }


    /**
     * 解禁网易云通信ID
     *
     * @param string $accid 网易云通信ID，最大长度32字符，必须保证一个APP内唯一
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/messaging/docs/TUzOTA4NTY?platform=server#%E8%A7%A3%E7%A6%81%E8%B4%A6%E5%8F%B7
     */
    public function unblock(string $accid)
    {
        return $this->post('user/unblock.action', ['accid' => $accid]);
    }

    /**
     * 更新用户名片
     *
     * @param string $accid 用户帐号，最大长度32字符，必须保证一个APP内唯一
     * @param array  $options 可选参数集合，支持参数如下：
     *
     * - name: string, 网易云通信ID昵称，最大长度64字符。
     *
     * - icon: string, 网易云通信ID头像URL，开发者可选填，最大长度1024
     *
     * - sign: string, 用户签名，最大长度256字符
     *
     * - email: string, 用户email，最大长度64字符
     *
     * - birth: string, 用户生日，最大长度16字符
     *
     * - mobile: string, 用户mobile，最大长度32字符，非中国大陆手机号码需要填写国家代码(如美国：+1-xxxxxxxxxx)或地区代码(如香港：+852-xxxxxxxx)
     *
     * - gender: int, 用户性别，0表示未知，1表示男，2女表示女，其它会报参数错误
     *
     * - ex: string, 用户名片扩展字段，最大长度1024字符，用户可自行扩展，建议封装成JSON字符串
     *
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/messaging/server-apis/zI0NzYyMDQ?platform=server#url-1
     */
    public function updateUserInfo(string $accid, array $options)
    {
        return $this->post('user/updateUinfo.action', array_merge($options, ['accid' => $accid]));
    }

    /**
     * 获取用户名片，可以批量
     *
     * @param array $accids 用户帐号（一次查询最多为200）
     *
     * @return array
     * @throws GuzzleException
     * @throws cccdlException
     * @see https://doc.yunxin.163.com/messaging/server-apis/zI0NzYyMDQ?platform=server
     */
    public function getUserInfos(array $accids): array
    {
        return $this->post('user/getUinfos.action', ['accids' => json_encode($accids)]);
    }


    /**
     * 设置桌面端在线时，移动端是否需要推送
     *
     * @param string $accid 用户帐号
     * @param bool   $donnopOpen 桌面端在线时，移动端是否不推送：true:移动端不需要推送，false:移动端需要推送
     *
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function setDonnop(string $accid, bool $donnopOpen)
    {
        return $this->post('user/setDonnop.action', ['accid' => $accid, 'donnopOpen' => $donnopOpen]);
    }


    /**
     * 账号全局禁言
     *
     * @param string $accid 用户帐号
     * @param bool   $mute 是否全局禁言：true：全局禁言，false:取消全局禁言
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function mute(string $accid, bool $mute)
    {
        return $this->post('user/mute.action', ['accid' => $accid, 'mute' => $mute]);
    }


    /**
     * 账号全局禁用音视频
     *
     * @param string $accid 用户帐号
     * @param bool   $mute 是否全局禁言：true：全局禁言，false:取消全局禁言
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function muteAv(string $accid, bool $mute)
    {
        return $this->post('user/muteAv.action', ['accid' => $accid, 'mute' => $mute]);
    }


    /**
     * 获取语音视频安全认证签名
     * @param $uid int
     * @param $repeatUse bool
     * @param $expire int
     * @param $channelName string
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function getCallToken(int $uid, bool $repeatUse = true, int $expire = 600, string $channelName = '')
    {
        $body = [
            'uid' => $uid,
            'repeatUse' => $repeatUse ? 'true' : 'false',
            'expireAt' => $expire,
            'channelName' => $channelName,
        ];
        return $this->post('user/getToken.action', $body);
    }


    /**
     * 获取用户在线状态
     * @param int $accid
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function checkUserOnline(int $accid)
    {
        $body = [
            'accid' => $accid,
        ];
        return $this->post('user/checkOnline.action', $body);
    }


}
