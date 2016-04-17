<?php
/**
 * Created by IntelliJ IDEA.
 * User: Angelina
 * Date: 2016/4/11
 * Time: 21:30
 */

namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Think\Page;

class EmployeeController extends Controller
{
    public function index()
    {
        $employeeId = I('get.employeeId');
        $departmentId = I('get.departmentId');
        $model = new Model();
        $select_employee = "SELECT * FROM employee WHERE id = $employeeId";
        $selectEmployee = $model->query($select_employee);
        $model2 = new Model();
        $select_Departments = "SELECT * FROM department WHERE id = $departmentId";
        $selectDepartments = $model2->query($select_Departments);
        $this->assign('selectDepartments', $selectDepartments);
        $this->assign('departmentId', $departmentId);
        $this->assign('selectEmployee', $selectEmployee);
        $this->assign('avatarUrlPrefix', C('AVATAR_URL_PREFIX'));
        $this->display();
    }

 }