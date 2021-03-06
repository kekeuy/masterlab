<!DOCTYPE html>
<html class="" lang="en">
<head  >

    <? require_once VIEW_PATH.'gitlab/common/header/include.php';?>
    <script src="<?=ROOT_URL?>dev/js/admin/workflow_scheme.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/lib/handlebars-v4.0.10.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/lib/bootstrap-select/js/bootstrap-select.js" type="text/javascript" charset="utf-8"></script>
    <link href="<?=ROOT_URL?>dev/lib/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">

</head>

<body class="" data-group="" data-page="projects:issues:index" data-project="xphp">
<? require_once VIEW_PATH.'gitlab/common/body/script.php';?>
<header class="navbar navbar-gitlab with-horizontal-nav">
    <a class="sr-only gl-accessibility" href="#content-body" tabindex="1">Skip to content</a>
    <div class="container-fluid">
        <? require_once VIEW_PATH.'gitlab/common/body/header-content.php';?>
    </div>
</header>
<script>
    var findFileURL = "/ismond/xphp/find_file/master";
</script>
<div class="page-with-sidebar">
    <? require_once VIEW_PATH.'gitlab/admin/common-page-nav-admin.php';?>


    <div class="content-wrapper page-with-layout-nav page-with-sub-nav">
        <div class="alert-wrapper">
            <div class="flash-container flash-container-page">
            </div>
        </div>
        <div class=" ">
            <div class="content" id="content-body">
                <?php include VIEW_PATH.'gitlab/admin/common_issue_left_nav.php';?>
                <div class="container-fluid"  style="margin-left: 160px">
                    <div class="top-area">

                        <div class="nav-controls row-fixed-content" style="float: left;margin-left: 0px">
                            <form id="filter_form" action="<?=ROOT_URL?>admin/user/filter" accept-charset="UTF-8" method="get">
                                工作流
                            </form>
                        </div>
                        <div class="nav-controls" style="right: ">

                            <div class="project-item-select-holder">

                                <a class="btn btn-new btn_workflow_scheme_add" data-target="#modal-workflow_scheme_add" data-toggle="modal" href="#modal-workflow_scheme_add">
                                    <i class="fa fa-plus"></i>
                                    新增工作流方案
                                </a>
                            </div>

                        </div>

                    </div>

                    <div class="content-list pipelines">

                            <div class="table-holder">
                                <table class="table ci-table">
                                    <thead>
                                    <tr>
                                        <th class="js-pipeline-info pipeline-info">名称</th>
                                        <th class="js-pipeline-stages pipeline-info">项目</th>
                                        <th class="js-pipeline-date pipeline-info">关联工作流</th>
                                        <th   style=" float: right" >操作</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list_render_id">

                                    </tbody>
                                </table>
                            </div>
                            <div class="gl-pagination" id="pagination">

                            </div>
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-workflow_scheme_add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal" href="#">×</a>
                <h3 class="page-title">新增工作流方案</h3>
            </div>
            <div class="modal-body">
                <form class="js-quick-submit js-upload-blob-form form-horizontal"  id="form_add" action="<?=ROOT_URL?>admin/workflow_scheme/create"   accept-charset="UTF-8" method="post">
                    <input type="hidden" name="params[issue_type_workflow]" id="add_issue_type_workflow">
                    <div class="form-group">
                        <label class="control-label" >名称:</label>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="" name="params[name]" id="input_name" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" >描述:</label>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <textarea placeholder="" class="form-control" rows="3" maxlength="250" name="params[description]" id="textarea_description"></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group ">
                        <label class="control-label" >工作流定义:</label>
                        <div class="row">
                            <div class="col-md-3">
                                <select   id="issue_type_ids" name="params[issue_type_ids][]" class="selectpicker  " showTick="true"   multiple title="选择事项类型"   >

                                </select>
                            </div>
                            <div class="col-md-3">
                                <select   id="workflow_id" name="params[workflow_id]" class="selectpicker  " showTick="true" title="选择工作流"   >

                                </select>
                            </div>
                            <div class="col-md-2">
                                <button name="btn-issue_type_workflow_add" type="button" class="btn" id="btn-issue_type_workflow_add" >添加</button>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label" ></label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <table class="table ci-table">
                                    <tbody id="add_list_render_id">
                                    <tr class="commit">
                                        <td  ><strong>未分配的事项类型</strong></td>
                                        <td>--></td>
                                        <td>默认工作流</td>
                                        <td  ></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a class="btn btn-cancel" data-dismiss="modal" href="#"  >取消</a>
                        <button name="btn-next" type="button" class="btn btn-create" id="btn-workflow_scheme_add" >保存</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-workflow_scheme_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal" href="#">×</a>
                <h3 class="page-title">编辑工作流方案</h3>
            </div>
            <div class="modal-body">
                <form class="js-quick-submit js-upload-blob-form form-horizontal" id="form_edit"  action="<?=ROOT_URL?>admin/workflow_scheme/edit"   accept-charset="UTF-8" method="post">
                    <input type="hidden" name="params[issue_type_workflow]" id="edit_issue_type_workflow">
                    <input type="hidden" name="id" id="edit_id" value="">
                    <input type="hidden" name="format" id="format" value="json">

                    <div class="form-group">
                        <label class="control-label" >名称:</label>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="" name="params[name]" id="edit_name" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" >描述:</label>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <textarea placeholder="" class="form-control" rows="3" maxlength="250" name="params[description]" id="edit_description"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group ">
                        <label class="control-label" >工作流定义:</label>
                        <div class="row">
                            <div class="col-md-3">
                                <select   id="edit_issue_type_ids" name="params[issue_type_ids][]" class="selectpicker  " showTick="true"   multiple title="选择事项类型"   >

                                </select>
                            </div>
                            <div class="col-md-3">
                                <select   id="edit_workflow_id" name="params[workflow_id]" class="selectpicker  " showTick="true" title="选择工作流"   >

                                </select>
                            </div>
                            <div class="col-md-2">
                                <button name="btn-issue_type_workflow_add" type="button" class="btn" id="btn-issue_type_workflow_edit" >添加</button>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label" ></label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <table class="table ci-table">
                                    <tbody id="edit_list_render_id">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button name="edit_issue_type_workflow_save" type="button" class="btn  btn-create " id="btn-workflow_scheme_update">保存</button>
                        <a class="btn btn-cancel" data-dismiss="modal" href="#">取消</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/html"  id="list_tpl">
    {{#workflow_scheme}}
        <tr class="commit">
            <td style="width:40%">
                <strong>{{name}}</strong><br>
                <span>{{description}}</span>
            </td>
            <td> 

            </td>
            <td>
                {{make_relation relation}}
            </td>
            <td  >
                <div class="controls member-controls " style="float: right">
                    <a class="list_for_edit btn btn-transparent " href="#" data-value="{{id}}" style="padding: 6px 2px;">编辑 </a>
                    <a class="list_for_delete btn btn-transparent "  href="javascript:;" data-value="{{id}}" style="padding: 6px 2px;">
                        <i class="fa fa-trash"></i>
                        <span class="sr-only">Remove</span>
                    </a>
                </div>

            </td>
        </tr>
    {{/workflow_scheme}}

</script>




<script type="text/javascript">

    var $WorkflowScheme = null;
    $(function() {

        Handlebars.registerHelper('make_relation', function(relations ) {

            var html = '';
            for(var i=0;i<relations.length;i++ ){
                var issue_type_name = relations[i].issue_name;
                var workflow_name = relations[i].workflow_name;
                html += "<div class=\"branch-commit\">"+issue_type_name+"--><a class=\"commit-id monospace\" href=\"#\">"+workflow_name+"</a></div>";
            }
            return new Handlebars.SafeString( html );

        });

        var options = {
            list_render_id:"list_render_id",
            list_tpl_id:"list_tpl",
            filter_form_id:"filter_form",
            filter_url:"<?=ROOT_URL?>admin/workflow_scheme/fetch_all",
            get_url:"<?=ROOT_URL?>admin/workflow_scheme/get",
            update_url:"<?=ROOT_URL?>admin/workflow_scheme/update",
            add_url:"<?=ROOT_URL?>admin/workflow_scheme/add",
            delete_url:"<?=ROOT_URL?>admin/workflow_scheme/delete",
            pagination_id:"pagination"

        }
        window.$WorkflowScheme = new WorkflowScheme( options );
        window.$WorkflowScheme.fetchWorkflowSchemes( );

    });

</script>
</body>
</html>