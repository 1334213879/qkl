<?php
namespace app\admin\controller;
use app\admin\model\Admin;
use think\Db;

class Borret extends Common {

	public function index() {
	}
	//借款列表
	public function list() {

		$list = Db::table(config('database.prefix') . 'borrow')->alias('k')
			->join(config('database.prefix') . 'users i', 'k.uid = i.user_id', 'left')
			->field('i.nickname,k.*')
			->select();
		$this->assign('list', $list);
		return $this->fetch();
	}
}