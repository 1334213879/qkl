<?php
namespace app\user\controller;

class Borret extends Common {

	/**
	 * 借款
	 * @return array
	 * @throws \think\Exception
	 * @throws \think\exception\PDOException
	 */
	public function borrow() {
		// new Users;
		if (!session('user.user_id')) {
			$this->redirect('login/index');
		}
		$uid = session('user.user_id');
		$is_ing = db('borrow')->where('uid', $uid)->whereIn('status', [1, 2, 4])->find();

		if (!empty($is_ing)) {
			return json_encode(['code' => 0, 'msg' => '您已在借款中或您已逾期']);
		}

		$data = [];
		$data['status'] = 1;
		$data['j_time'] = time();
		$data['uid'] = $uid;
		$msg = db('borrow')->insert($data);

		if ($msg) {
			return json_encode(['code' => 1, 'msg' => '已提交申请']);
		} else {
			return json_encode(['code' => 0, 'msg' => '申请失败']);
		}
	}

}