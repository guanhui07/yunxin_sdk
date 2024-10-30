<?php

namespace cccdl\yunxin_sdk\Im;

use cccdl\yunxin_sdk\Traits\Request;

/**
 *
 * @see https://doc.yunxin.163.com/messaging/server-apis/Dg1NDYxNTM?platform=server
 *
 * @see https://doc.yunxin.163.com/nertc/server-apis/zY3NDA3MTc?platform=server 音视频
 *
 * 所有接口列表
 * https://doc.yunxin.163.com/messaging/server-apis/zk4Mzg0MjE?platform=server
 *
 * 发送消息    https://api.netease.im/nimserver/msg/sendMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 批量发送单聊消息    https://api.netease.im/nimserver/msg/sendBatchMsg.action	单个应用默认最高调用频率：120 次/分，如超限，将被屏蔽 1 分钟。
 * 发送单聊已读回执    https://api.netease.im/nimserver/msg/markReadMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 发送群聊已读回执    https://api.netease.im/nimserver/msg/markReadTeamMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 双向撤回消息    https://api.netease.im/nimserver/msg/recall.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 单向撤回消息    https://api.netease.im/nimserver/msg/delMsgOneWay.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 发送广播消息    https://api.netease.im/nimserver/msg/broadcastMsg.action	单个应用默认最高调用频率：10 次/分，如超限，将被屏蔽 1 分钟。
 * 删除单条广播消息    https://api.netease.im/nimserver/history/delBroadcastMsgById.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 上传文件（非分片）    https://api.netease.im/nimserver/msg/upload.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 分片上传文件    https://api.netease.im/nimserver/msg/fileUpload.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 清理已上传文件    https://api.netease.im/nimserver/job/nos/del.action	单个应用默认最高调用频率：5 次/天，如超限，将被屏蔽 1 天。
 * 删除单条消息    https://api.netease.im/nimserver/msg/delMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 删除漫游消息    https://api.netease.im/nimserver/msg/delRoamSession.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 *
 *
 * 注册云信 IM 账号    https://api.netease.im/nimserver/user/create.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 刷新指定 Token    https://api.netease.im/nimserver/user/update.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 刷新不指定 Token    https://api.netease.im/nimserver/user/refreshToken.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 封禁账号    https://api.netease.im/nimserver/user/block.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 解禁账号    https://api.netease.im/nimserver/user/unblock.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 账号全局禁言    https://api.netease.im/nimserver/user/mute.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 账号功能模块禁言    https://api.netease.im/nimserver/user/muteModule.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 设置移动端是否需要推送（桌面端在线时）    https://api.netease.im/nimserver/user/setDonnop.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 消息功能
 * 历史消息与记录
 * API    请求URL    默认频控值
 * 单聊云端历史消息查询    https://api.netease.im/nimserver/history/querySessionMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 群聊云端历史消息查询    https://api.netease.im/nimserver/history/queryTeamMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 聊天室云端历史消息查询    https://api.netease.im/nimserver/history/queryChatroomMsg.action	单个应用默认最高调用频率：1200 次/分，如超限，将被屏蔽 1 分钟。
 * 删除聊天室云端历史消息    https://api.netease.im/nimserver/chatroom/deleteHistoryMessage.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 云端会话列表查询    https://api.netease.im/nimserver/history/querySessionList.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 查询单条广播消息    https://api.netease.im/nimserver/history/queryBroadcastMsgById.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 批量查询广播消息    https://api.netease.im/nimserver/history/queryBroadcastMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * IM 登录/登出记录查询    https://api.netease.im/nimserver/history/queryUserEvents.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 自定义系统通知
 * API    请求URL    默认频控值
 * 发送自定义系统通知    https://api.netease.im/nimserver/msg/sendAttachMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 批量发送自定义系统通知    https://api.netease.im/nimserver/msg/sendBatchAttachMsg.action	单个应用默认最高调用频率：120 次/分，如超限，将被屏蔽 1 分钟。
 * 用户和好友关系
 * API    请求URL    默认频控值
 * 获取用户名片    https://api.netease.im/nimserver/user/getUinfos.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 更新用户名片    https://api.netease.im/nimserver/user/updateUinfo.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 添加好友    https://api.netease.im/nimserver/friend/add.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 更新好友相关信息    https://api.netease.im/nimserver/friend/update.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 删除好友关系    https://api.netease.im/nimserver/friend/delete.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 获取好友列表    https://api.netease.im/nimserver/friend/get.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 获取好友关系    https://api.netease.im/nimserver/friend/getByAccid.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 设置黑名单/静音    https://api.netease.im/nimserver/user/setSpecialRelation.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 获取指定用户的黑名单和静音列表    https://api.netease.im/nimserver/user/listBlackAndMuteList.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 高级群
 * API    请求URL    默认频控值
 * 创建高级群    https://api.netease.im/nimserver/team/create.action	单个应用中默认 1 秒内所有的高级群操作 API 合计最多可调用 100 次，如超限，将被屏蔽 10 秒。
 * 除发送群消息 API 外，其他所有高级群 API 都属于高级群操作 API。
 * 拉人入群    https://api.netease.im/nimserver/team/add.action
 * 添加管理员    https://api.netease.im/nimserver/team/addManager.action
 * 移除管理员    https://api.netease.im/nimserver/team/removeManager.action
 * 转让群主    https://api.netease.im/nimserver/team/changeOwner.action
 * 禁言群主    https://api.netease.im/nimserver/team/muteTlistAll.action
 * 禁言指定群成员    https://api.netease.im/nimserver/team/muteTlist.action
 * 踢人出群    https://api.netease.im/nimserver/team/kick.action
 * 主动退群    https://api.netease.im/nimserver/team/leave.action
 * 修改群组信息    https://api.netease.im/nimserver/team/update.action
 * 修改群昵称    https://api.netease.im/nimserver/team/updateTeamNick.action
 * 设置群消息提醒开关    https://api.netease.im/nimserver/team/muteTeam.action
 * 解散群组    https://api.netease.im/nimserver/team/remove.action
 * 获取群组详细信息    https://api.netease.im/nimserver/team/queryDetail.action
 * 获取群组禁言列表    https://api.netease.im/nimserver/team/listTeamMute.action
 * 获取群消息已读未读详情    https://api.netease.im/nimserver/team/getMarkReadInfo.action
 * 获取用户已加入的群组信息    https://api.netease.im/nimserver/team/joinTeams.action
 * 获取用户已加入的群组的所有群成员信息    https://api.netease.im/nimserver/team/listMemberInfo.action
 * 获取群组的在线成员列表    https://api.netease.im/nimserver/team/listOnlineUsers.action
 * 批量获取群组信息与成员列表    https://api.netease.im/nimserver/team/query.action
 * 批量获取群组的在线成员数量    https://api.netease.im/nimserver/team/listOnlineUserCount.action
 * 发送群消息    https://api.netease.im/nimserver/msg/sendMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 超大群
 * API    请求URL    默认频控值
 * 创建超大群    https://api.netease.im/nimserver/superteam/create.action	单个应用中默认 1 秒内所有的超大群操作 API 合计最多可调用 100 次，如超限，将被屏蔽 10 秒。
 * 除超大群消息相关 API 外，其他所有超大群 API 都属于超大群操作 API。
 * 超大群消息相关 API 包括：发送超大群消息，发送超大群自定义系统通知，撤回超大群消息，根据用户 ID/消息 ID 查询超大群历史消息。
 * 拉人入群    https://api.netease.im/nimserver/superteam/invite.action
 * 添加管理员    https://api.netease.im/nimserver/superteam/addManager.action
 * 移除管理员    https://api.netease.im/nimserver/superteam/removeManager.action
 * 转让群主    https://api.netease.im/nimserver/superteam/changeOwner.action
 * 禁言超大群    https://api.netease.im/nimserver/superteam/mute.action
 * 禁言指定超大群成员    https://api.netease.im/nimserver/superteam/muteTlist.action
 * 踢人出群    https://api.netease.im/nimserver/superteam/kick.action
 * 主动退群    https://api.netease.im/nimserver/superteam/leave.action
 * 修改超大群昵称    https://api.netease.im/nimserver/superteam/updateTeamNick.action
 * 修改超大群信息    https://api.netease.im/nimserver/superteam/updateTinfo.action
 * 修改超大群成员信息    https://api.netease.im/nimserver/superteam/updateTlist.action
 * 解散超大群    https://api.netease.im/nimserver/superteam/dismiss.action
 * 修改超大群人数级别    https://api.netease.im/nimserver/superteam/changeLevel.action
 * 获取超大群信息    https://api.netease.im/nimserver/superteam/getTinfos.action
 * 获取超大群成员信息    https://api.netease.im/nimserver/superteam/getTlists.action
 * 获取超大群禁言成员信息    https://api.netease.im/nimserver/superteam/getMuteTlists.action
 * 获取已加入的超大群信息    https://api.netease.im/nimserver/superteam/joinTeams.action
 * 根据用户 ID 查询超大群历史消息    https://api.netease.im/nimserver/superteam/queryHistoryMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 根据消息 ID 查询超大群历史消息    https://api.netease.im/nimserver/superteam/queryHistoryMsgByIds.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 发送超大群消息    https://api.netease.im/nimserver/superteam/sendMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 发送超大群自定义系统通知    https://api.netease.im/nimserver/superteam/sendAttachMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 撤回超大群消息    https://api.netease.im/nimserver/superteam/recallMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 聊天室
 * API    请求URL    默认频控值
 * 创建聊天室    https://api.netease.im/nimserver/chatroom/create.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 获取聊天室地址    https://api.netease.im/nimserver/chatroom/requestAddr.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 更新聊天室信息    https://api.netease.im/nimserver/chatroom/update.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 查询聊天室信息    https://api.netease.im/nimserver/chatroom/get.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 批量查询聊天室信息    https://api.netease.im/nimserver/chatroom/getBatch.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 开放/关闭聊天室    https://api.netease.im/nimserver/chatroom/toggleCloseStat.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 查询开放状态的聊天室    https://api.netease.im/nimserver/chatroom/queryUserRoomIds.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 设置聊天室定时关闭    https://api.netease.im/nimserver/chatroom/updateDelayClosePolicy.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 开启/关闭进出聊天室时间通知    https://api.netease.im/nimserver/chatroom/updateInOutNotification.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 聊天室踢人    https://api.netease.im/nimserver/chatroom/kickMember.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 设置聊天室角色    https://api.netease.im/nimserver/chatroom/setMemberRole.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 变更聊天室角色    https://api.netease.im/nimserver/chatroom/updateMyRoomRole.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 分页获取聊天室成员列表    https://api.netease.im/nimserver/chatroom/membersByPage.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 根据角色获取聊天室成员列表    https://api.netease.im/nimserver/chatroom/queryMembersByRole.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 批量获取聊天室成员信息    https://api.netease.im/nimserver/chatroom/queryMembers.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 发送聊天室消息    https://api.netease.im/nimserver/chatroom/sendMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 批量发送聊天室消息    https://api.netease.im/nimserver/chatroom/batchSendMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 撤回聊天室消息    https://api.netease.im/nimserver/chatroom/recall.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 发送聊天室定向消息    https://api.netease.im/nimserver/chatroom/sendMsgToSomeone.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 批量发送聊天室定向消息    https://api.netease.im/nimserver/chatroom/batchSendMsgToSomeone.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 发送聊天室全服广播消息    https://api.netease.im/nimserver/chatroom/broadcast.action	单个应用默认最高调用频率：10 次/分，如超限，将被屏蔽 1 分钟。
 * 添加聊天室机器人    https://api.netease.im/nimserver/chatroom/addRobot.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 删除聊天室机器人    https://api.netease.im/nimserver/chatroom/removeRobot.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 清空聊天室机器人    https://api.netease.im/nimserver/chatroom/cleanRobot.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 设置临时禁言状态    https://api.netease.im/nimserver/chatroom/temporaryMute.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 聊天室整体禁言    https://api.netease.im/nimserver/chatroom/muteRoom.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 标签禁言    https://api.netease.im/nimserver/chatroom/tagTemporaryMute.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 查询标签下的在线用户数    https://api.netease.im/nimserver/chatroom/tagMembersCount.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 根据标签查询在线成员列表    https://api.netease.im/nimserver/chatroom/tagMembersQuery.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 根据标签查询历史消息    https://api.netease.im/nimserver/chatroom/queryTagHistoryMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 修改聊天室用户标签    https://api.netease.im/nimserver/chatroom/updateChatRoomRoleTag.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 初始化队列    https://api.netease.im/nimserver/chatroom/queueInit.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 删除清理队列    https://api.netease.im/nimserver/chatroom/queueDrop.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 添加或更新元素    https://api.netease.im/nimserver/chatroom/queueOffer.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 批量添加队列元素    https://api.netease.im/nimserver/chatroom/queueBatchOffer.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 批量更新队列元素    https://api.netease.im/nimserver/chatroom/queueBatchUpdateElements.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 排序列出队列中所有元素    https://api.netease.im/nimserver/chatroom/queueList.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 从队列中取出元素    https://api.netease.im/nimserver/chatroom/queuePoll.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 获取指定的队列元素    https://api.netease.im/nimserver/chatroom/queueMultiGet.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 在线状态订阅
 * API    请求URL    默认频控值
 * 订阅在线状态事件    https://api.netease.im/nimserver/event/subscribe/add.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 查询在线状态事件订阅关系    https://api.netease.im/nimserver/event/subscribe/query.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 取消在线状态事件订阅    https://api.netease.im/nimserver/event/subscribe/delete.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 取消全部在线状态事件订阅    https://api.netease.im/nimserver/event/subscribe/batchdel.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 其他
 * API    请求URL    默认频控值
 * 文本翻译    https://api.netease.im/nimserver/translator/textMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 圈组
 * 圈组相关 API 请参考圈组 API 概览。
 *
 * 调整接口频控
 * 对于部分接口支持在云信控制台自行调整，其他接口频控的变更需要联系云信商务经理处理。
 *
 * 支持在云信控制台自行调整的接口：
 *
 * API    请求 URL    默认频控值
 * 发送普通消息    https://api.netease.im/nimserver/msg/sendMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 批量发送普通消息    https://api.netease.im/nimserver/msg/sendBatchMsg.action	单个应用默认最高调用频率：120 次/分，如超限，将被屏蔽 1 分钟。
 * 发送自定义系统通知    https://api.netease.im/nimserver/msg/sendAttachMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 批量发送自定义系统通知    https://api.netease.im/nimserver/msg/sendBatchAttachMsg.action	单个应用默认最高调用频率：120 次/分，如超限，将被屏蔽 1 分钟。
 * 发送广播消息    https://api.netease.im/nimserver/msg/broadcastMsg.action	单个应用默认最高调用频率：10 次/分，如超限，将被屏蔽 1 分钟。
 * 发送聊天室消息    https://api.netease.im/nimserver/chatroom/sendMsg.action	单个应用默认最高调用频率：100 次/秒，如超限，将被屏蔽 10 秒。
 * 发送聊天室全服广播消息    https://api.netease.im/nimserver/chatroom/broadcast.action	单个应用默认最高调用频率：10 次/分，如超限，将被屏蔽 1 分钟。
 * 群组管理操作    除发送群消息 API 外，其他所有高级群 API 都属于高级群操作 API。    单个应用中默认 1 秒内所有的高级群操作 API 合计最多可调用 100 次，如超限，将被屏蔽 10 秒。
 *
 *
 * https://doc.yunxin.163.com/messaging/server-apis/DE0MTk0OTY?platform=server#单聊云端历史消息查询
 *
 *
 * https://doc.yunxin.163.com/messaging/server-apis/jE0ODgwMDM?platform=server#登录登出事件记录查询
 *
 *
 *
 */
class Base
{
    use Request;

    /**
     * 请求域名
     * @var string
     */
    protected $baseUrl = 'https://api.netease.im/nimserver/';

    /**
     * 开发者平台分配的appkey
     * @var
     */
    protected $AppKey;

    /**
     * 密钥
     * @var
     */
    protected $AppSecret;

    /**
     * 随机数（最大长度128个字符）
     * @var
     */
    protected $Nonce;

    /**
     * SHA1(AppSecret + Nonce + CurTime)，三个参数拼接的字符串，进行SHA1哈希计算，转化成16进制字符(String，小写)
     * @var
     */
    private $CheckSum;


    public function __construct($appKey, $appSecrt)
    {
        $this->AppKey = $appKey;
        $this->AppSecret = $appSecrt;
        $this->Nonce = self::getNonce(128);
    }

    /**
     * 获取随机字符串
     * @param int $length 位数
     * @return string
     */
    protected function getNonce(int $length = 128): string
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            // 这里提供两种字符获取方式
            // 第一种是使用 substr 截取$chars中的任意一位字符；
            // 第二种是取字符数组 $chars 的任意元素
            // $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
            $password .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $password;
    }

    /**
     * 将数组中的bool值转换为字符类型
     *
     * @param array $data
     *
     * @return array
     */
    private function bool2String(array $data): array
    {
        foreach ($data as &$datum) {
            if (is_bool($datum)) {
                $datum = $datum ? 'true' : 'false';
            } elseif (is_array($datum)) {
                $datum = $this->bool2String($datum);
            }
        }

        return $data;
    }




}
