<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/22
 * Time: 14:57
 */
namespace app\index\command;
use think\console\Command;
use think\console\Input;
use think\console\Output;

class Hongbao extends Command{

    protected function configure(){
        $this->setName('Hongbao')->setDescription("每天发红包");//这里的setName和php文件名一致,setDescription随意
    }

    /*
     * 每天发红包
     */
    protected function execute(Input $input, Output $output)
    {
        //这里写业务逻辑

        var_dump('111');
    //      {
    //     $user = db('users')
    //         ->where("`user_id`={$user_id}")
    //         ->find();

    //     $log = db('log')
    //         ->where("`user_id`={$user_id} and type=6")
    //         ->whereTime('time', 'today')
    //         ->find();

    //     //奖励
    //     $data['reward1'] = 0;  //自身红包
    //     $data['reward2'] = 0;  //邀请会员代数红包
    //     $data['reward3'] = 0;  //合伙人极差

    //     $data['time'] = time();
    //     $data['type'] = 6;  //领取红包
    //     $data['user_id'] = $user_id;

    //     if ($user['level'] > 1 && empty($log) && date("H") > 1 && date("H") < 24) {
    //         //静态收益
    //         $data['reward1'] = $user['hongbao'];

    //         //动态收益
    //         $z_count = db('users')
    //             ->where("`fxid`={$user_id} and `is_red_envelope` = 0")
    //             ->count();  //直推人数 = 奖励代数
    //         $z_count = $z_count > 50 ? 50 : $z_count;  //最高50代
    //         $inv_hongbao = Db::query("select level,hongbao,find_in_set({$user_id},all_fxid) as f from clt_users where `level`>1 and find_in_set({$user_id},all_fxid)>0 and find_in_set({$user_id},all_fxid)<={$z_count} and pass>0 and hongbao>0 and `is_red_envelope` = 0 ");

    //         //代数奖励
    //         //1代 = 1
    //         //2代~5代 = 0.2
    //         //6代至10代 = 0.1
    //         //10代以后 = 0.01
    //         $hongbao = 0;
    //         foreach ($inv_hongbao as $a) {
    //             $a['f'] = ($a['f'] == 1 ? 1 :
    //                 ($a['f'] >= 2 && $a['f'] <= 5 ? 0.2 :
    //                     ($a['f'] >= 6 && $a['f'] <= 10 ? 0.1 : 0.01
    //                     )));
    //             //$a['hongbao'] = ($a['hongbao'] > $user['hongbao'] ? $user['hongbao'] : $a['hongbao']) * $a['f'];  //计算代数奖励不能大于自身会员等级所领取的红包额度
    //                     $a['hongbao'] = $a['hongbao'] > $user['hongbao'] ? $user['hongbao'] : $a['hongbao'];
    //                     $a['level'] = $a['level'] > $user['level'] ? $user['level'] : $a['level'];
    //                     if($a['level']==2){
    //                         $hongbao = 6.3;
    //                     }
    //                     if($a['level']==3){
    //                         $hongbao = 36.75;
    //                     }
    //                     if($a['level']==4){
    //                         $hongbao = 84;
    //                     }
    //                     if($a['level']==5){
    //                         $hongbao = 283.5;
    //                     }
    //                     if($a['level']==6){
    //                         $hongbao = 525;
    //                     }
    //                     if($a['level']==7){
    //                         $hongbao = 2520;
    //                     }
    //             $data['reward2'] += $hongbao * $a['f'];
    //         }

    //         //合伙人极差算法
    //         //计算自身合伙人以下的所有会员的红包金额 - 自身合伙人以下的合伙人下（注意是合伙人）的所有会员的红包金额 = 合伙人极差极差
    //         if ($user['g'] > 0) {
    //             //计算自身合伙人以下的所有会员的红包金额
    //             $money_3 = self::partnerMoney($user);

    //             //自身合伙人以下的合伙人下（注意是合伙人）的所有会员的红包金额
    //             $partner_money = 0;
    //             $partner_list = db('users')
    //                 ->where("find_in_set({$user_id},all_fxid) and g>0 and g<{$user['g']} and `is_red_envelope` = 0")
    //                 ->select();

    //             foreach ($partner_list as $v) {
    //                 $partner_money += self::partnerMoney($v);
    //             }

    //             $data['reward3'] = $money_3 - $partner_money;
    //             $data['reward3'] = $data['reward3'] > 0 ? $data['reward3'] : 0;
    //         }

    //         //总红包 取8位小数
    //         $money = round($data['reward1'] + $data['reward2'] + $data['reward3'], 8);

    //         if ($type > 0 && $money > 0) {
    //             $data['title'] = '领取红包';
    //             $data['nmct'] = $money;  //收款方
    //             $data['nmct_dj'] = -$money;  //待取
    //             $nmct = $user['nmct_dj'] > ($money / 2) ? ($money / 2) : $user['nmct_dj'];
    //             if (db('log')->insert($data)) {
    //                 db('users')
    //                     ->where([
    //                         'user_id' => $user_id,
    //                         'is_red_envelope' => 0
    //                     ])
    //                     ->setField([
    //                         'nmct_dj' => ['exp', "`nmct_dj`-{$nmct}"],
    //                         'nmct' => ['exp', "`nmct`+{$nmct}"],
    //                     ]);
    //                 $data['title'] = '红包复投';
    //                 $data['type'] = 7;
    //                 $data['nmct'] = -$nmct;
    //                 $data['nmct_dj'] = $nmct;
    //                 unset($data['reward1']);
    //                 unset($data['reward2']);
    //                 unset($data['reward3']);
    //                 db('log')->insert($data);
    //             }
    //         }
    //         return $money;
    //     } else {
    //         return 0;
    //     }
    // }
    }
}