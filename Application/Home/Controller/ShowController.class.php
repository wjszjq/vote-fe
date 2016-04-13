<?php
/**
 * Created by IntelliJ IDEA.
 * User: Felix
 * Date: 2016/4/11
 * Time: 21:30
 */

namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Think\Page;

class ShowController extends Controller
{

    public function index()
    {
        $this->display();
    }

    public function show()
    {
        $departmentId = I('get.departmentId');

        $model = new Model();
        $select_allDepartments = "SELECT * FROM department";
        $allDepartments = $model->query($select_allDepartments);

        $departmentId = empty($departmentId) ? $allDepartments[0]['id'] : $departmentId;

        $select_deptEmployees = "SELECT * FROM employee WHERE department_id = 1 AND status = 1 ORDER BY vote DESC";
        $allDeptEmployees = $model->query($select_deptEmployees);

        //$this->ajaxReturn($allDeptEmployees, 'data.json');
        //$this->display();
        $this->ajaxReturn($allDeptEmployees,'json',0);
    }
}