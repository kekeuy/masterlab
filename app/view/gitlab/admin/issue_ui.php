<!DOCTYPE html>
<html class="" lang="en">
<head  >

    <? require_once VIEW_PATH.'gitlab/common/header/include.php';?>
    <script src="<?=ROOT_URL?>dev/js/admin/issue_ui.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/lib/handlebars-v4.0.10.js" type="text/javascript" charset="utf-8"></script>

    <script src="<?=ROOT_URL?>dev/lib/nestable/jquery.nestable.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/lib/bootstrap-select/js/bootstrap-select.js" type="text/javascript" charset="utf-8"></script>
    <link href="<?=ROOT_URL?>dev/lib/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">

    <script type="text/javascript" src="<?=ROOT_URL?>dev/lib/qtip/dist/jquery.qtip.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=ROOT_URL?>dev/lib/qtip/dist/jquery.qtip.min.css" />


    <style type="text/css">

        .dd { position: relative; display: block; margin: 0; padding: 0;  list-style: none; font-size: 13px; line-height: 20px; }

        .dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
        .dd-list .dd-list { padding-left: 30px; }
        .dd-collapsed .dd-list { display: none; }

        .dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
        .dd-dragel > .dd-item .dd-handle { margin-top: 0; }
        .dd-dragel .dd-handle {
            -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
        }

        .dd-hover > .dd-handle { background: #2ea8e5 !important; }

        .dd-dragel > .dd3-item > .dd3-content { margin: 0; }


        /**
         * Socialite
         */

        .socialite { display: block; float: left; height: 35px; }

    </style>
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

                                事项类型

                            </form>
                        </div>
                        <div class="nav-controls" style="right: ">

                            <div class="project-item-select-holder">

                            </div>

                        </div>

                    </div>

                    <div class="content-list pipelines">

                            <div class="table-holder">
                                <table class="table ci-table">
                                    <thead>
                                    <tr>
                                        <th class="js-pipeline-info pipeline-info">名称</th>
                                        <th class="js-pipeline-stages pipeline-info">类型</th>
                                        <th   >操作</th>
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

<div class="modal" id="modal-config_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal" href="#">×</a>
                <h3 class="page-title">创建界面配置</h3>
            </div>
            <div class="modal-body">
                <form class="js-quick-submit js-upload-blob-form form-horizontal"  id="create_form" action="<?=ROOT_URL?>admin/issue_ui/update"   accept-charset="UTF-8" method="post">

                    <input type="hidden" name="format" id="format" value="json">
                    <input type="hidden" name="type" id="type" value="">
                    <input type="hidden" name="type" name="params[issue_type_id]" id="create_issue_type_id" value="">
                    <input type="hidden" name="type" name="params[data]" id="create_data" value="">


                    <ul class="nav nav-tabs" id="create_tabs" >
                        <li role="presentation" class="active"><a id="a_create_default_tab" href="#create_default_tab" role="tab" data-toggle="tab">默认标签页</a></li>
                        <li   id="create_ui-new_tab_li"><a href="#" id="create_ui-new_tab"><i class="fa fa-plus"></i>新增标签页</a></li>
                    </ul>
                    <div id="create_master_tabs" class="tab-content">
                        <div role="tabpanel"  class="tab-pane active" id="create_default_tab">
                            <div class="dd" id="create_ui-nestable_default" style="margin-top:10px">
                                <ol class="dd-list" id="create_ui_config-default_tab">

                                </ol>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class=" form-group">
                        <div class="col-sm-3" style="margin-top: 10px">
                            选择一个字段添加到此界面
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select id="create_field_select" name="create_field_select" class="selectpicker" dropdownAlignRight="true"  data-width="90%" data-live-search="true"   title=""   >
                                        <option value="">请选择字段</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions" style="margin-top: 60px">
                        <button name="submit" type="button" class="btn btn-create" id="btn-issue_type_add" onclick="IssueUi.prototype.saveCreateConfig();">保存</button>
                        <a class="btn btn-cancel" data-dismiss="modal" href="#">取消</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-config_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal" href="#">×</a>
                <h3 class="page-title">编辑界面配置</h3>
            </div>
            <div class="modal-body">
                <form class="js-quick-submit js-upload-blob-form form-horizontal"  id="edit_form" action="<?=ROOT_URL?>admin/issue_ui/edit_ui_update"   accept-charset="UTF-8" method="post">

                    <input type="hidden" name="format" value="json">
                    <input type="hidden" name="type" id="edit_type" value="">
                    <input type="hidden" name="type" name="params[issue_type_id]" id="edit_issue_type_id" value="">
                    <input type="hidden" name="type" name="params[data]" id="edit_data" value="">


                    <ul class="nav nav-tabs" id="edit_tabs" >
                        <li role="presentation" class="active"><a id="a_edit_default_tab" href="#edit_default_tab" role="tab" data-toggle="tab">默认标签页</a></li>
                        <li   id="edit_new_tab_li"><a href="#" id="edit_new_tab"><i class="fa fa-plus"></i>新增标签页</a></li>
                    </ul>
                    <div id="edit_master_tabs" class="tab-content">
                        <div role="tabpanel"  class="tab-pane active" id="edit_default_tab">
                            <div class="dd" id="edit_nestable_default" style="margin-top:10px">
                                <ol class="dd-list" id="edit_ui_config-default_tab">

                                </ol>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class=" form-group">
                        <div class="col-sm-3" style="margin-top: 10px">
                            选择一个字段添加到此界面
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select id="edit_field_select" name="edit_field_select" class="selectpicker" dropdownAlignRight="true"  data-width="90%" data-live-search="true"   title=""   >
                                    <option value="">请选择字段</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions" style="margin-top: 60px">
                        <button name="submit" type="button" class="btn btn-create" id="btn-edit_save" onclick="IssueUi.prototype.saveEditConfig();">保存</button>
                        <a class="btn btn-cancel" data-dismiss="modal" href="#">取消</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/html"  id="list_tpl">
    {{#issue_types}}
        <tr class="commit">
            <td>
                <strong><i class="fa {{font_awesome}}"></i> {{name}}</strong>
            </td>
            <td>
                {{catalog}}
            </td>
            <td>
                <div class="branch-commit">· <a class="commit-id monospace list_for_config_create" href="#"  data-issue_type_id="{{id}}">创建界面配置</a></div>
                <div class="branch-commit">· <a class="commit-id monospace list_for_config_edit" href="#"  data-issue_type_id="{{id}}" >编辑界面配置</a></div>
                <div class="branch-commit">· <a class="commit-id monospace list_for_config_view" href="#"  data-issue_type_id="{{id}}" >查看界面配置</a></div>
            </td>
        </tr>
    {{/issue_types}}

</script>

<script type="text/html"  id="wrap_field">
    <li id="create_warp_{{field.id}}" class="dd-item dd3-item" data-id="{{order_weight}}">
            <div class=" form-group">
                    <div class="dd-handle dd3-handle col-sm-1 "><i class="fa fa-arrows" aria-hidden="true"></i></div>
                    <div class="col-sm-2"><label class="control-label" for="id_name">{{display_name}}:{{required_html}}</label></div>
                    <div class="col-sm-8">{field_html}</div>
                    <div class="col-sm-1"><i data-field_id="{{field.id}}" class="fa fa-trash-o create_li_remove" aria-hidden="true"></i></div>
            </div>
    </li>

</script>

<script type="text/html"  id="create_ui-new_tab_tpl">
    <div class="row">
        <div class="col-md-8">
            <input type="text" id="createui_new_tab_text" name="createui_new_tab_text"  class="form-control" />
        </div>
        <div class="col-md-4"><a class="btn btn-sm" id="new_tab_btn" onclick="IssueUi.prototype.uiAddTab('create',$('#createui_new_tab_text').val())" href="#">确定</a>
        </div>
    </div>
</script>

<script type="text/html"  id="create_ui-edit_tab_tpl">
    <div class="row">
        <div class="col-md-8">
            <input type="text" id="edit_tab_text" name="edit_tab_text"  class="form-control" />
        </div>
        <div class="col-md-4"><a class="btn btn-sm" id="edit_tab_btn" onclick="IssueUi.prototype.createUiSaveEditTab( '{{id}}', $('#edit_tab_text').val())"  href="#">确定</a>
        </div>
    </div>
</script>

<script type="text/html"  id="edit_ui-new_tab_tpl">
    <div class="row">
        <div class="col-md-8">
            <input type="text" id="edit_ui-new_tab_text" name="new_tab_text"  class="form-control" />
        </div>
        <div class="col-md-4"><a class="btn btn-sm" id="edit_ui-new_tab_btn"  onclick="IssueUi.prototype.editUiAddTab($('#edit_ui-new_tab_text').val())"  href="#">确定</a>
        </div>
    </div>
</script>

<script type="text/html"  id="edit_ui-edit_tab_tpl">
    <div class="row">
        <div class="col-md-8">
            <input type="text" id="editui_edit_tab_text" name="edit_tab_text"  class="form-control" />
        </div>
        <div class="col-md-4"><a class="btn btn-sm" id="edit_ui-edit_tab_btn" onclick="IssueUi.prototype.editUiUpdateTab( '{{id}}', $('#editui_edit_tab_text').val())"  href="#">确定</a>
        </div>
    </div>
</script>

<script type="text/html"  id="li_tab_tpl">
    <div role="tabpanel"  class="tab-pane " id="{{id}}">
        <div class="dd" id="nestable_{{id}}" style="margin-top:10px">
            <ol class="dd-list" id="create_ui_config_{{id}}" style="min-height: 200px">

            </ol>
        </div>
    </div>
</script>

<script type="text/html"  id="nav_tab_li_tpl">
    <li role="presentation" class="active">
        <a id="a_{{id}}" href="#{{id}}" role="tab" data-toggle="tab">
            <span id="span_{{id}}">{{title}}&nbsp;</span>
            <i class="fa fa-pencil" data="{{id}}"></i>&nbsp;
            <i class="fa fa-times-circle" data="{{id}}"></i>
        </a>
    </li>
</script>

<script type="text/html"  id="content_tab_tpl">
    <div role="tabpanel"  class="tab-pane " id="{{id}}">
        <div class="dd" id="nestable_{{id}}" style="margin-top:10px">
            <ol class="dd-list" id="create_ui_config-{{id}}" style="min-height: 200px">

            </ol>
        </div>
    </div>
</script>

<script type="text/javascript">

    var $issueType = null;
    $(function() {

        Handlebars.registerHelper('make_scheme', function(scheme_ids, schemes ) {

            var html = '';
            if (scheme_ids == null || scheme_ids == undefined || scheme_ids == '') {
                return html;
            }
            var scheme_ids_arr = scheme_ids.split(',');
            scheme_ids_arr.forEach(function(scheme_id) {
                console.log(scheme_id);
                var scheme_name = '';
                for(var skey in schemes ){
                    if(schemes[skey].id==scheme_id){
                        scheme_name = schemes[skey].name;
                        break;
                    }
                }
                html += "<div class=\"branch-commit\">· <a class=\"commit-id monospace\" href=\"admin/issue_ui/scheme/"+scheme_id+"\">"+scheme_name+"</a></div>";
            });
            return new Handlebars.SafeString( html );

        });

        var options = {
            list_render_id:"list_render_id",
            list_tpl_id:"list_tpl",
            filter_form_id:"filter_form",
            filter_url:"<?=ROOT_URL?>admin/issue_ui/fetch_all",
            get_config_url:"<?=ROOT_URL?>admin/issue_ui/getUiConfig",
            pagination_id:"pagination"

        }
        window.$issueType = new IssueUi( options );
        window.$issueType.fetchIssueTypeUi( );

    });
    $(document).ready(function()
    {
        $('#create_ui-nestable_default').nestable();
        $('#edit_nestable_default').nestable();
        $('#create_ui-new_tab').qtip({
            content: {
                text: $('#create_ui-new_tab_tpl').html(),
                title: "新增Tab",
                button: "关闭"
            },
            show: 'click',
            hide: 'click',
            style:{
                classes:"qtip-bootstrap"
            },
            position: {
                my: 'top left',  // Position my top left...
                at: 'bottom center', // at the bottom right of...
            },
            events: {
                show: function( event, api ) {
                    var t=setTimeout("$('#new_tab_text').focus();",500)
                }
            }
        });
        $('#edit_new_tab').qtip({
            content: {
                text: $('#edit_new_tab_tpl').html(),
                title: "新增Tab",
                button: "关闭"
            },
            show: 'click',
            hide: 'click',
            style:{
                classes:"qtip-bootstrap"
            },
            position: {
                my: 'top left',  // Position my top left...
                at: 'bottom center', // at the bottom right of...
            },
            events: {
                show: function( event, api ) {
                    var t=setTimeout("$('#edit_tab_text').focus();",500)
                }
            }
        });


    });
</script>



</body>
</html>