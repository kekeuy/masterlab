<!DOCTYPE html>
<html class="" lang="en">
<head  >

    <? require_once VIEW_PATH.'gitlab/common/header/include.php';?>
    <script src="<?=ROOT_URL?>dev/js/admin/issue_priority.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/lib/handlebars-v4.0.10.js" type="text/javascript" charset="utf-8"></script>

    <script src="<?=ROOT_URL?>dev/lib/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" media="print" href="<?=ROOT_URL?>dev/lib/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css" />

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
                                优先级
                            </form>
                        </div>
                        <div class="nav-controls" style="right: ">

                            <div class="project-item-select-holder">

                                <a class="btn btn-new btn_issue_priority_add" data-target="#modal-issue_priority_add" data-toggle="modal" href="#modal-issue_priority_add">
                                    <i class="fa fa-plus"></i>
                                    New Issue Priority
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
                                        <th class="js-pipeline-info pipeline-info">Key</th>
                                        <th class="js-pipeline-stages pipeline-info">颜色</th>
                                        <th class="js-pipeline-stages pipeline-info">描述</th>
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



<div class="modal" id="modal-issue_priority_add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal" href="#">×</a>
                <h3 class="page-title">新增优先级</h3>
            </div>
            <div class="modal-body">
                <form class="js-quick-submit js-upload-blob-form form-horizontal"  id="form_add" action="<?=ROOT_URL?>admin/issue_priority/add"   accept-charset="UTF-8" method="post">

                    <input type="hidden" name="format" id="format" value="json">
                    <div class="form-group">
                        <label class="control-label" for="id_name">名称:<span style="color: red"> *</span></label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="params[name]" id="id_name"  value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="id_name">颜色:<span style="color: red"> *</span></label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="params[status_color]" id="id_status_color"  value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="id_description">描述:</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="params[description]" id="id_description"  value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="id_font_icon">图标:</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control fontawesome-iconpicker" name="params[font_awesome]" id="id_font_awesome"  value="" >
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button name="submit" type="button" class="btn btn-create" id="btn-issue_priority_add">保存</button>
                        <a class="btn btn-cancel" data-dismiss="modal" href="#">取消</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-issue_priority_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal" href="#">×</a>
                <h3 class="page-title">编辑优先级</h3>
            </div>
            <div class="modal-body">
                <form class="js-quick-submit js-upload-blob-form form-horizontal" id="form_edit"  action="<?=ROOT_URL?>admin/issue_priority/update"   accept-charset="UTF-8" method="post">

                    <input type="hidden" name="id" id="edit_id" value="">
                    <input type="hidden" name="format" id="format" value="json">

                    <div class="form-group">
                        <label class="control-label" for="id_name">显示名称:<span style="color: red"> *</span></label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="params[name]" id="edit_name"  value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="id_name">颜色:<span style="color: red"> *</span></label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="params[status_color]" id="edit_status_color"  value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="id_description">描述:</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="params[description]" id="edit_description"  value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="id_font_icon">图标:</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control fontawesome-iconpicker " name="params[font_awesome]" id="edit_font_awesome"  value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button name="submit" type="button" class="btn btn-save" id="btn-issue_priority_update">保存</button>
                        <a class="btn btn-cancel" data-dismiss="modal" href="#">取消</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/html"  id="list_tpl">
    {{#rows}}
        <tr class="commit">
            <td>
                <strong><i class="fa {{font_awesome}}"></i> {{name}}</strong>
            </td>
            <td>
                {{_key}}
            </td>
            <td>
                <span class="dropdown-label-box" style="background: {{status_color}}"></span>
            </td>
            <td>
                {{description}}
            </td>
            <td  >
                <div class="controls member-controls " style="float: right">

                    <a class="list_for_edit btn btn-transparent " href="#" data-value="{{id}}" style="padding: 6px 2px;">编辑 </a>
                    <a class="list_for_delete btn btn-transparent  "  href="javascript:;" data-value="{{id}}" style="padding: 6px 2px;">
                        <i class="fa fa-trash"></i>
                        <span class="sr-only">Remove</span>
                    </a>
                </div>

            </td>
        </tr>
    {{/rows}}
</script>



<script type="text/javascript">

    var $IssuePriority = null;
    $(function() {

        $('.fontawesome-iconpicker').iconpicker();
        var options = {
            list_render_id:"list_render_id",
            list_tpl_id:"list_tpl",
            filter_form_id:"filter_form",
            filter_url:"<?=ROOT_URL?>admin/issue_priority/fetch_all",
            get_url:"<?=ROOT_URL?>admin/issue_priority/get",
            update_url:"<?=ROOT_URL?>admin/issue_priority/update",
            add_url:"<?=ROOT_URL?>admin/issue_priority/add",
            delete_url:"<?=ROOT_URL?>admin/issue_priority/delete",
            pagination_id:"pagination"

        }
        window.$IssuePriority = new IssuePriority( options );
        window.$IssuePriority.fetchIssuePrioritys( );

    });

</script>
</body>
</html>