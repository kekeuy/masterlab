<?php

/**
 * Created by PhpStorm.
 * User: sven
 * Date: 2017/7/7 0007
 * Time: 下午 3:56
 */

namespace main\app\classes;

use main\app\model\project\ProjectModel;
use main\app\model\user\UserProjectRoleModel;
use main\app\model\user\UserModel;
use main\app\model\issue\IssueTypeModel;
use main\app\model\issue\IssueTypeSchemeModel;
use main\app\model\issue\IssueTypeSchemeItemsModel;
use main\app\model\project\ProjectIssueTypeSchemeDataModel;

class IssueTypeLogic
{
    const DEFAULT_ISSUE_TYPE_SCHEME_ID = 1;
    const SCRUME_ISSUE_TYPE_SCHEME_ID = 2;
    const SOFTWARE_ISSUE_TYPE_SCHEME_ID = 3;
    const FLOW_ISSUE_TYPE_SCHEME_ID = 4;
    const TASK_ISSUE_TYPE_SCHEME_ID = 5;

    public function getAdminIssueTypes()
    {
        $sql = "Select t.* ,GROUP_CONCAT(s.scheme_id ) as scheme_ids From `issue_type` t 
                Left join issue_type_scheme_data s on s.type_id=t.id 
                Group by t.id 
                Order by t.id ASC ";

        $issueTypeModel = new IssueTypeModel();
        return $issueTypeModel->db->getRows($sql);
    }

    private function getIssueTypeSchemeIdByProjectId($projectId)
    {
        $projectModel = new ProjectModel($projectId);
        $project = $projectModel->getById($projectId);
        if (!isset($project['type'])) {
            return false;
        }
        $type = $project['type'];
        unset($projectModel, $project);
        if (in_array($type, [ProjectLogic::PROJECT_TYPE_KANBAN, ProjectLogic::PROJECT_TYPE_SCRUM])) {
            return self::SCRUME_ISSUE_TYPE_SCHEME_ID;
        }
        if ($type == ProjectLogic::PROJECT_TYPE_SOFTWARE_DEV) {
            return self::SOFTWARE_ISSUE_TYPE_SCHEME_ID;
        }

        if ($type == ProjectLogic::PROJECT_TYPE_FLOW_MANAGE) {
            return self::FLOW_ISSUE_TYPE_SCHEME_ID;
        }

        if ($type == ProjectLogic::PROJECT_TYPE_FLOW_MANAGE) {
            return self::TASK_ISSUE_TYPE_SCHEME_ID;
        }

        return false;
    }

    public function getIssueType($projectId)
    {
        $issueTypeSchemeId = self::DEFAULT_ISSUE_TYPE_SCHEME_ID;
        if (!empty($projectId)) {
            // 获取项目的自定义方案
            $model = new ProjectIssueTypeSchemeDataModel();
            $prjCustomSchemeId = $model->getSchemeId($projectId);
            if (!$prjCustomSchemeId) {
                // 如果项目没有自定义的方案,则根据项目所属的类别进行筛选
                $ret = $this->getIssueTypeSchemeIdByProjectId($projectId);
                if ($ret !== false) {
                    $issueTypeSchemeId = $ret;
                }
            } else {
                $issueTypeSchemeId = $prjCustomSchemeId;
            }
        }
        $issueTypeModel = new IssueTypeModel();
        $issueTypes = $issueTypeModel->getAll(true);

        $model = new IssueTypeSchemeItemsModel();
        $typeItems = $model->getItemsBySchemeId($issueTypeSchemeId);
        $types = [];
        foreach ($typeItems as $item) {
            $typeId = $item['type_id'];
            if (isset($issueTypes[$typeId])) {
                $types[] = $issueTypes[$typeId];
            }
        }
        return $types;
    }

    public function getAdminIssueTypesBySplit()
    {
        $issueTypeModel = new IssueTypeModel();
        $issueTypes = $issueTypeModel->getAll(false);

        $issueTypeSchemeModel = new IssueTypeSchemeModel();
        $issueTypeSchemes = $issueTypeSchemeModel->getAll();

        $schemeItemsModel = new IssueTypeSchemeItemsModel();
        $issueTypeSchemeDatas = $schemeItemsModel->getAll();

        if (!empty($issueTypes)) {
            foreach ($issueTypes as $issueTypeId => &$issueType) {
                $schemes = [];
                if (!empty($issueTypeSchemeDatas)) {
                    foreach ($issueTypeSchemeDatas as $row) {
                        if ($issueTypeId == $row['type_id'] && isset($issueTypeSchemes[$row['scheme_id']])) {
                            $schemes[] = $issueTypeSchemes[$row['scheme_id']];
                        }
                    }
                }
                $issueType['schemes'] = $schemes;
            }
        }

        $data = [];
        $data['issue_types'] = $issueTypes;
        $data['issue_type_schemes'] = $issueTypeSchemes;
        $data['issue_type_schemes_data'] = $issueTypeSchemeDatas;

        return $data;
    }

    public function getAdminIssueTypeSchemes()
    {
        $issueTypeSchemeModel = new IssueTypeSchemeModel();
        $issueTypeSchemeTable = $issueTypeSchemeModel->getTable();

        $model = new IssueTypeSchemeItemsModel();
        $issueTypeSchemeDataTable = $model->getTable();

        $model = new ProjectIssueTypeSchemeDataModel();
        $projectIssueTypeSchemeDataTable = $model->getTable();

        $sql = "SELECT
                    ts.*,
                    GROUP_CONCAT(sd.type_id) AS type_ids,
                    GROUP_CONCAT(psd.project_id) AS project_ids
                FROM
                    {$issueTypeSchemeTable} ts
                LEFT JOIN {$issueTypeSchemeDataTable} sd ON ts.id = sd.scheme_id
                LEFT JOIN {$projectIssueTypeSchemeDataTable} psd ON ts.id = psd.issue_type_scheme_id
                GROUP BY
                    ts.id;";

        return $issueTypeSchemeModel->db->getRows($sql);
    }

    public function updateSchemeTypes($schemeId, $types)
    {
        if (empty($types)) {
            return [false, 'data_is_empty'];
        }
        $model = new IssueTypeSchemeItemsModel();
        try {
            $model->db->beginTransaction();
            $model->deleteBySchemeId($schemeId);
            $rowsAffected = 0;
            if (!empty($types)) {
                $infos = [];
                foreach ($types as $typeId) {
                    $info = [];
                    $info['scheme_id'] = $schemeId;
                    $info['type_id'] = $typeId;
                    $infos [] = $info;
                }
                $rowsAffected = $model->insertRows($infos);
            }
            $model->db->commit();
            return [true, $rowsAffected];
        } catch (\PDOException $e) {
            $model->db->rollBack();
            return [false, $e->getMessage()];
        }
        return [true, 'ok'];
    }
}
