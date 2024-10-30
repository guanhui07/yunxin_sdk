<?php

namespace cccdl\yunxin_sdk\Im;

/**
 * @see https://doc.yunxin.163.com/messaging/server-apis/zk4Mzg0MjE?platform=server#其他
 */
class Translate  extends Base
{

    /**
     * https://doc.yunxin.163.com/messaging/server-apis/DY2OTgxNzc?platform=server#api-
     *
     * https://doc.yunxin.163.com/messaging/server-apis/DY2OTgxNzc?platform=server#language 支持的语言
     * @param $accid int user_id
     * @param $text string 需要翻译的文本
     * @param $to string  目标语言
     * @param $from string  源语言，不传默认为 auto
     * @return array|bool|int|string|null
     */
    public function translateMessage(int $accid ,string $text ,string $to ,string $from = 'auto' ) {

        $body = [
            'accid' => $accid,
            'text'  => $text,
            'to'    => $to,
            'from'    => $from,
        ];

        return $this->post('translator/textMsg.action', $body);
    }


}