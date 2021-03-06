<?php

namespace main\app\ctrl\admin;

use main\app\ctrl\BaseAdminCtrl;
use main\app\model\project\ProjectModel;
use main\app\model\OrgModel;
use main\app\classes\ProjectLogic;

/**
 * 系统管理的项目模块
 */
class Project extends BaseAdminCtrl
{
    public static $page_sizes = [10,20,50,100];

    public function index()
    {
        $data = [];

        $projectModel = new ProjectModel();
        $list = $projectModel->getAll();

        // $data['list'] = $list;
        $data['title'] = 'Projects';
        $data['nav_links_active'] = 'project';
        $data['left_nav_active'] = 'list';
        $this->render('gitlab/admin/project_list.php', $data);
    }

    public function gets()
    {
        $projectLogic = new ProjectLogic();
        $rows = $projectLogic->projectListJoinUser();
        $this->ajaxSuccess('', $rows);
    }

    public function filterData($page = 1, $page_size = 20)
    {
        $projectModel = new ProjectModel();
        $projects = $projectModel->getAll(false);

        $model = new OrgModel();
        $originsMap = $model->getMapIdAndPath();

        foreach ($projects as &$item) {
            $item['type_name'] = isset(ProjectLogic::$typeAll[$item['type']])?ProjectLogic::$typeAll[$item['type']]:'未知';
            $item['path'] = isset($originsMap[$item['org_id']]) ? $originsMap[$item['org_id']]:'';
            $item['create_time_text'] = format_unix_time($item['create_time'], time());
            $item['create_time_origin'] = date('y-m-d H:i:s', $item['create_time']);
        }
        unset($item);

        $data['total'] = 0;
        $data['page'] = $page;
        $data['pages'] = 30;
        $data['rows'] = $projects;

        $this->ajaxSuccess('', $data);
    }

    public function update($project_id, $params)
    {
        if (empty($uid)) {
            $this->ajaxFailed('no_uid');
        }
        // @todo 全局权限
        $model = new ProjectModel();
        $ret = $model->updateById($project_id, $params);
        if (!$ret) {
            $this->ajaxFailed('delete_failed');
        } else {
            $this->ajaxSuccess('success');
        }
    }

    /**
     * 删除项目
     * @param $project_id
     */
    public function delete($project_id)
    {
        if (empty($uid)) {
            $this->ajaxFailed('no_uid');
        }
        // @todo 全局权限
        $model = new ProjectModel();
        $ret = $model->deleteById($project_id);
        if (!$ret) {
            $this->ajaxFailed('delete_failed');
        } else {
            $this->ajaxSuccess('success');
        }
    }
}
