<!DOCTYPE html>
<html class="" lang="en">
<head  >

    <? require_once VIEW_PATH . 'gitlab/common/header/include.php';?>

    <? require_once VIEW_PATH . 'gitlab/common/header/include.php'; ?>

    <script src="<?=ROOT_URL?>gitlab/assets/webpack/common_vue.bundle.js"></script>
    <script src="<?=ROOT_URL?>gitlab/assets/webpack/issuable.bundle.js"></script>

    <script src="<?=ROOT_URL?>dev/lib/url_param.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/js/issue/main.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/js/issue/form.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/js/issue/detail.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/lib/handlebars-v4.0.10.js" type="text/javascript" charset="utf-8"></script>

    <script>
        window.project_uploads_path = "/ismond/xphp/uploads";
        window.preview_markdown_path = "/ismond/xphp/preview_markdown";
    </script>

    <script src="<?=ROOT_URL?>dev/lib/bootstrap-select/js/bootstrap-select.js" type="text/javascript" charset="utf-8"></script>
    <link href="<?=ROOT_URL?>dev/lib/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">

    <script type="text/javascript" src="<?=ROOT_URL?>dev/lib/qtip/dist/jquery.qtip.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=ROOT_URL?>dev/lib/qtip/dist/jquery.qtip.min.css" />

    <script src="<?=ROOT_URL?>dev/lib/simplemde/dist/simplemde.min.js"></script>
    <link rel="stylesheet" href="<?=ROOT_URL?>dev/lib//simplemde/dist/simplemde.min.css">

    <!-- Fine Uploader jQuery JS file-->
    <link href="<?=ROOT_URL?>dev/lib/fine-uploader/fine-uploader.css" rel="stylesheet">
    <link href="<?=ROOT_URL?>dev/lib/fine-uploader/fine-uploader-gallery.css" rel="stylesheet">
    <script src="<?=ROOT_URL?>dev/lib/fine-uploader/jquery.fine-uploader.js"></script>

    <link href="<?=ROOT_URL?>dev/lib/laydate/theme/default/laydate.css" rel="stylesheet">
    <script src="<?=ROOT_URL?>dev/lib/laydate/laydate.js"></script>

    <script src="<?=ROOT_URL?>dev/lib/mousetrap/mousetrap.min.js"></script>

    <link rel="stylesheet" href="<?=ROOT_URL?>dev/lib/editor.md/css/editormd.css" />
    <script src="<?=ROOT_URL?>dev/lib/editor.md/editormd.js"></script>


</head>
<body class="" data-group="" data-page="projects:issues:index" data-project="xphp">
<? require_once VIEW_PATH . 'gitlab/common/body/script.php';?>
<header class="navbar navbar-gitlab with-horizontal-nav">
    <a class="sr-only gl-accessibility" href="#content-body" tabindex="1">Skip to content</a>
    <div class="container-fluid">
        <? require_once VIEW_PATH . 'gitlab/common/body/header-content.php';?>
    </div>
</header>

<div class="page-gutter page-with-sidebar right-sidebar-expanded">
    <? require_once VIEW_PATH . 'gitlab/project/common-page-nav-project.php';?>

    <div class="content-wrapper page-with-layout-nav ">
        <div class="alert-wrapper">

            <div class="flash-container flash-container-page">
            </div>

        </div>
        <div class="container-fluid ">
            <input type="hidden" name="issue_id" id="issue_id" value="" />
            <div class="content" id="content-body">


                <div class="clearfix detail-page-header">
                    <div class="issuable-header" id="issuable-header">
                        <script type="text/html" id="issuable-header_tpl">
                            <a class="btn btn-default pull-right visible-xs-block gutter-toggle issuable-gutter-toggle js-sidebar-toggle" href="#">
                                <i class="fa fa-angle-double-left"></i>
                            </a>
                            <div class="issuable-meta">
                                <strong class="identifier">Issue
                                    <a href="<?=ROOT_URL?>issue/main/{{issue.id}}" id="a_issue_key">#{{issue.pkey}}{{issue.id}}</a></strong>
                                由
                                <strong>
                                    <a class="author_link  hidden-xs" href="/sven">
                                        <img id="creator_avatar" width="24" class="avatar avatar-inline s24 " alt="" src="{{issue.creator_info.avatar}}">
                                        <span id="author" class="author has-tooltip" title="@{{issue.creator_info.username}}" data-placement="top">{{issue.creator_info.display_name}}</span></a>
                                    <a class="author_link  hidden-sm hidden-md hidden-lg" href="/sven">
                                        <span class="author">@{{issue.creator_info.username}}</span></a>
                                </strong>
                                于
                                <time class="js-timeago js-timeago-render" title="" >{{issue.create_time}}
                                </time>
                                创建
                            </div>
                        </script>
                    </div>
                    <div class="issuable-actions" id="issue-actions">
                        <div class="btn-group" role="group" aria-label="...">
                            <button id="btn-edit" type="button" class="btn btn-default"><i class="fa fa-edit"></i> 编辑</button>
                            <button id="btn-copy" type="button" class="btn btn-default"><i class="fa fa-copy"></i> 复制</button>
                            <!--<button id="btn-attachment" type="button" class="btn btn-default"><i class="fa fa-file-image-o"></i> 附件</button>-->
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    更多
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a id="btn-watch" href="#">关注</a></li>
                                    <li><a id="btn-create_subtask" href="#">创建子任务</a></li>
                                    <li><a id="btn-convert_subtask" href="#">转化为子任务</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="allow_update_status" style="margin-left: 20px" class="btn-group" role="group" aria-label="...">

                        </div>
                        <div style="margin-left: 20px" class="btn-group" role="group" aria-label="...">
                            <button id="btn-reopen" type="button" class="btn  btn-reopen">重新打开</button>
                            <button id="btn-close" type="button" class="btn btn-default">关闭</button>

                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    管理
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">管理关注</a></li>
                                    <li><a id="btn-move" href="#">移动</a></li>
                                    <li><a id="btn-delete" href="#">删除</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="issue_fields">

                </div>
                <script type="text/html" id="issue_fields_tpl">
                    <h3 class="page-title">
                        事项详情
                    </h3>
                    <hr>
                    <div class="row">
                        <div class=" form-group col-lg-6">
                            <div class="form-group issue-assignee">
                                <label class="control-label col-sm-2" >类型:</label>
                                <div class=" col-sm-10">
                                    <span><i class="fa {{issue.issue_type_info.font_awesome}}"></i> {{issue.issue_type_info.name}}</span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-lg-6">
                            <div class="form-group">
                                <label class="control-label col-sm-2"  >解决结果:</label>
                                <div class="col-sm-10">
                                    <span style=" color: {{issue.resolve_info.color}}" >{{issue.resolve_info.name}}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 ">
                            <label class="control-label col-sm-2"  >状态:</label>
                            <div class="col-sm-10">
                                <span class="label label-{{issue.status_info.color}} prepend-left-5">{{issue.status_info.name}}</span>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="control-label col-sm-2" for="issue_label_ids">优先级:</label>
                            <div class="col-sm-10">
                                <span class="label " style="color:{{issue.priority_info.status_color}}">{{issue.priority_info.name}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6 ">
                            <label class="control-label col-sm-2" for="issue_milestone_id">影响版本:</label>
                            <div class="col-sm-10">
                                {{#issue.effect_version_names}}
                                <span>{{name}}</span>&nbsp;
                                {{/issue.effect_version_names}}
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="control-label col-sm-2" for="issue_label_ids">解决版本:</label>
                            <div class="col-sm-10">
                                {{#issue.fix_version_names}}
                                <span>{{name}}</span>&nbsp;
                                {{/issue.fix_version_names}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 ">
                            <label class="control-label col-sm-2" for="issue_milestone_id">模块:</label>
                            <div class="col-sm-10">
                                <span>{{issue.module_name}}</span>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="control-label col-sm-2" for="issue_label_ids">标签:</label>
                            <div class="col-sm-10">
                                {{#issue.labels_names}}
                                <a class="label-link" href="<?=ROOT_URL?>issue/main/?label={{name}}">
                                    <span class="label color-label has-tooltip" style="background-color: {{bg_color}}; color: {{color}}"
                                          title="" data-container="body" data-original-title="red waring">{{title}}</span>
                                </a>
                                {{/issue.labels_names}}
                            </div>
                        </div>
                    </div>
                </script>


                <div class="issue-details issuable-details">
                    <div id="detail-page-description" class="content-block detail-page-description">
                        <div class="issue-title-data hidden" data-endpoint="#" data-initial-title="{{issue.summary}}"></div>
                        <script type="text/html" id="detail-page-description_tpl">
                            <div class="issue-title-data hidden" data-endpoint="/" data-initial-title="{{issue.summary}}"></div>
                            <h2 class="title">{{issue.summary}}</h2>
                            <div class="description js-task-list-container is-task-list-enabled">
                                <div class="wiki">
                                    <p dir="auto">{{issue.description}}</p></div>
                                <textarea class="hidden js-task-list-field">{{issue.description}}</textarea>
                            </div>

                            <small class="edited-text"><span>最后修改于 </span>
                                <time class="js-timeago issue_edited_ago js-timeago-render" title=""
                                      datetime="{{issue.updated_text}}" data-toggle="tooltip"
                                      data-placement="bottom" data-container="body" data-original-title="{{issue.updated}}">{{issue.updated_text}}</time>
                            </small>
                        </script>
                    </div>
                    <section class="issuable-discussion">
                        <div id="notes">
                            <ul class="notes main-notes-list timeline" id="timelines_list">

                            </ul>
                            <div class="note-edit-form">

                            </div>
                            <ul class="notes notes-form timeline">
                                <li class="timeline-entry">
                                    <div class="flash-container timeline-content"></div>
                                    <div class="timeline-icon hidden-xs hidden-sm">
                                        <a class="author_link" href="/<?=$user['username']?>">
                                            <img alt="@<?=$user['username']?>" class="avatar s40" src="<?=$user['avatar']?>" /></a>
                                    </div>

                                    <div class="timeline-content timeline-content-form">
                                        <form data-type="json" class="new-note js-quick-submit common-note-form gfm-form js-main-target-form" enctype="multipart/form-data" action="<?=ROOT_URL?>issue/main/comment" accept-charset="UTF-8" data-remote="true" method="post" style="display: block;">
                                            <input name="utf8" type="hidden" value="✓">
                                            <input type="hidden" name="authenticity_token" value="alAZE77Wv+jsZsepqr5ffMh6XJjLYUkeLjs0bvLB64/6J1vbN6l9FujLjDfRLABcXz9HXgsOk4Ob9gBXooWBaA==">
                                            <input type="hidden" name="view" id="view" value="inline">

                                            <div id="editor_md">
                                                <textarea style="display:none;"></textarea>
                                            </div>

                                            <div class="note-form-actions clearfix">
                                                <input id="btn-comment" class="btn btn-nr btn-create comment-btn js-comment-button js-comment-submit-button" type="button" value="Comment">

                                                <a id="btn-comment-reopen"  class="btn btn-nr btn-reopen btn-comment js-note-target-reopen " title="Reopen issue" href="#">Reopen issue</a>
                                                <a data-no-turbolink="true" data-original-text="Close issue" data-alternative-text="Comment &amp; close issue" class="btn btn-nr btn-close btn-comment js-note-target-close hidden" title="Close issue" href="/ismond/xphp/issues/1.json?issue%5Bstate_event%5D=close">Close issue</a>
                                                <a class="btn btn-cancel js-note-discard" data-cancel-text="Cancel" role="button">Discard draft</a>
                                            </div>
                                        </form>
                                    </div>

                                </li>
                            </ul>

                        </div>
                    </section>
                </div>
                <aside  aria-live="polite" class="js-right-sidebar right-sidebar right-sidebar-expanded" data-offset-top="102" data-spy="affix">
                    <div class="issuable-sidebar">
                        <div class="block issuable-sidebar-header">
                            <span class="issuable-header-text hide-collapsed pull-left hidden">
                                用户
                            </span>
                            <a aria-label="Toggle sidebar" class="gutter-toggle pull-right js-sidebar-toggle" href="#" role="button">
                                <i aria-hidden="true" class="fa fa-angle-double-right"></i>
                            </a>
                            <a  href="<?=ROOT_URL?>issue/main" aria-label="Back issue list" class="btn btn-default issuable-header-btn  pull-left"   title="Back issue list"  >
                                <i aria-hidden="true" class="fa fa-arrow-left"></i><span class="issuable-todo-inner js-issuable-todo-inner">返回事项列表</span>
                            </a>
                        </div>
                        <form class="issuable-context-form inline-update js-issuable-update" id="edit_issue_1"
                              action="<?=ROOT_URL?>issue/main/patch" accept-charset="UTF-8" data-remote="true" method="post">
                            <input name="utf8" type="hidden" value="&#x2713;" />
                            <input type="hidden" name="_method" value="post" />

                            <div class="block assignee">
                                <div class="sidebar-collapsed-icon sidebar-collapsed-user" data-container="body" data-placement="left" data-toggle="tooltip" title="<?=$issue['assignee_info']['display_name']?>">
                                    <a class="author_link  " href="/sven">
                                        <img width="24" class="avatar avatar-inline s24 " alt="" src="<?=$issue['assignee_info']['avatar']?>">
                                        <span class="author "><?=$issue['assignee_info']['display_name']?></span></a>
                                </div>
                                <div class="title hide-collapsed">Assignee
                                    <i aria-hidden="true" class="fa fa-spinner fa-spin hidden block-loading"></i>
                                    <a class="edit-link pull-right" href="#" style="font-size: 12px;">Edit</a></div>
                                <div class="value hide-collapsed" style="">
                                    <a class="author_link bold " href="/<?=$issue['assignee_info']['username']?>">
                                        <img width="32" class="avatar avatar-inline s32 " alt="" src="http://192.168.3.213/uploads/user/avatar/15/avatar.png">
                                        <span class="author "><?=$issue['assignee_info']['display_name']?></span>
                                        <span class="username">@<?=$issue['assignee_info']['username']?></span></a>
                                </div>
                                <div class="selectbox hide-collapsed">
                                    <input value="15" id="issue_assignee_id" type="hidden" name="issue[assignee_id]" />
                                    <div class="dropdown ">
                                        <button class="dropdown-menu-toggle js-user-search js-author-search"
                                                type="button"
                                                data-first-user="<?=$issue['assignee_info']['username']?>"
                                                data-current-user="true"
                                                data-project-id="<?=$project_id?>"
                                                data-author-id="<?=$issue['assignee_info']['uid']?>"
                                                data-field-name="assignee_id"
                                                data-issue-update="<?=ROOT_URL?>issue/main/patch/<?=$issue_id?>"
                                                data-ability-name="issue"
                                                data-null-user="true"
                                                data-toggle="dropdown"
                                                aria-expanded="false">
                                            <span class="dropdown-toggle-text ">Select assignee</span>
                                            <i class="fa fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-select dropdown-menu-user dropdown-menu-selectable dropdown-menu-author">
                                            <div class="dropdown-title">
                                                <span>Assign to</span>
                                                <button class="dropdown-title-button dropdown-menu-close" aria-label="Close" type="button">
                                                    <i class="fa fa-times dropdown-menu-close-icon"></i>
                                                </button>
                                            </div>
                                            <div class="dropdown-input">
                                                <input type="search" id="" class="dropdown-input-field" placeholder="Search users" autocomplete="off" />
                                                <i class="fa fa-search dropdown-input-search"></i>
                                                <i role="button" class="fa fa-times dropdown-input-clear js-dropdown-input-clear"></i>
                                            </div>
                                            <div class="dropdown-content "></div>
                                            <div class="dropdown-loading">
                                                <i class="fa fa-spinner fa-spin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="block milestone">
                                <div class="sidebar-collapsed-icon">
                                    <i aria-hidden="true" class="fa fa-clock-o"></i>
                                    <small>None</small></div>
                                <div class="title hide-collapsed "><span class="bold">Milestone</span>
                                    <i aria-hidden="true" class="fa fa-spinner fa-spin hidden block-loading"></i>
                                    <a class="edit-link pull-right" href="#"><small>Edit</small></a></div>
                                <div class="value hide-collapsed">
                                    <small class="no-value">None</small></div>
                                <div class="selectbox hide-collapsed">
                                    <input type="hidden" name="issue[milestone_id]" />
                                    <div class="dropdown ">
                                        <button class="dropdown-menu-toggle js-milestone-select js-extra-options"
                                                type="button"
                                                data-show-no="true"
                                                data-field-name="issue[milestone_id]"
                                                data-project-id="<?=$project_id?>"
                                                data-issuable-id="<?=$issue_id?>"
                                                data-milestones="/api/v4/milestones.json"
                                                data-ability-name="issue"
                                                data-issue-update="<?=ROOT_URL?>issue/main/patch/<?=$issue_id?>"
                                                data-use-id="true"
                                                data-toggle="dropdown">
                                            <span class="dropdown-toggle-text ">Milestone</span>
                                            <i class="fa fa-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-select dropdown-menu-selectable">
                                            <div class="dropdown-title">
                                                <span>Assign milestone</span>
                                                <button class="dropdown-title-button dropdown-menu-close" aria-label="Close" type="button">
                                                    <i class="fa fa-times dropdown-menu-close-icon"></i>
                                                </button>
                                            </div>
                                            <div class="dropdown-input">
                                                <input type="search" id="" class="dropdown-input-field" placeholder="Search milestones" autocomplete="off" />
                                                <i class="fa fa-search dropdown-input-search"></i>
                                                <i role="button" class="fa fa-times dropdown-input-clear js-dropdown-input-clear"></i>
                                            </div>
                                            <div class="dropdown-content "></div>
                                            <div class="dropdown-loading">
                                                <i class="fa fa-spinner fa-spin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="title hide-collapsed " style="margin-top: 10px"><span class="bold">时间</span>
                            </div>
                            <div class="block due_date" style="border-bottom: 0px solid #e8e8e8;padding: 10px 0;">
                                <div class="sidebar-collapsed-icon">
                                    <i aria-hidden="true" class="fa fa-calendar"></i>
                                    <span class="js-due-date-sidebar-value"><?=$issue['start_date']?></span></div>
                                <div class="title hide-collapsed"><small  >开始时间</small>
                                    <i aria-hidden="true" class="fa fa-spinner fa-spin hidden block-loading"></i>
                                    <a class="edit-link2 pull-right" href="#" style="color: rgba(0,0,0,0.85);"><small id="a_start_date_edit">Edit</small></a></div>
                                <div class="value hide-collapsed">
                                    <span class="value-content">
                                            <small class="no-value" id="small_start_date" ><?=$issue['start_date']?></small>

                                    </span>
                                    <span class="hidden js-remove-due-date-holder no-value">-
                                    <a class="js-remove-due-date" href="#" role="button">remove due date</a>
                                    </span>
                                </div>

                            </div>
                            <div class="block due_date">
                                <div class="sidebar-collapsed-icon">
                                    <i aria-hidden="true" class="fa fa-calendar"></i>
                                    <small class="js-due-date-sidebar-value"><?=$issue['due_date']?></small></div>
                                <div class="title hide-collapsed"><small>截止时间</small>
                                    <i aria-hidden="true" class="fa fa-spinner fa-spin hidden block-loading"></i>
                                    <a class="edit-link2 pull-right" href="#"  style="color: rgba(0,0,0,0.85);"><small id="a_due_date_edit">Edit</small></a></div>
                                <div class="value hide-collapsed">
                                  <span class="value-content">
                                    <small class="no-value" id="small_due_date" ><?=$issue['due_date']?></small>
                                  </span>
                                    <span class="hidden js-remove-due-date-holder no-value">-
                                        <a class="js-remove-due-date" href="#" role="button">remove due date</a>
                                    </span>
                                </div>

                            </div>
                            <div class="block participants">
                                <div class="sidebar-collapsed-icon">
                                    <i class="fa fa-users"></i>
                                    <span>1</span></div>
                                <div class="title hide-collapsed">协助人</div>
                                <div class="hide-collapsed participants-list">
                                    <div class="participants-author js-participants-author">
                                        <a class="author_link has-tooltip" title="" data-container="body" href="/sven" data-original-title="韦朝夺"><img width="24" class="avatar avatar-inline s24 " alt="" src="http://192.168.3.213/uploads/user/avatar/15/avatar.png"></a>
                                    </div>
                                    <div class="participants-author js-participants-author">
                                        <a class="author_link has-tooltip" title="" data-container="body" href="/yangwenjie" data-original-title="杨文杰" aria-describedby="tooltip290122"><img width="24" class="avatar avatar-inline s24 " alt="" src="http://192.168.3.213/uploads/user/avatar/21/avatar.png"></a>
                                    </div>
                                    <div class="participants-author js-participants-author">
                                        <a class="author_link has-tooltip" title="" data-container="body" href="/lijian" data-original-title="李健"><img width="24" class="avatar avatar-inline s24 " alt="" src="http://192.168.3.213/uploads/user/avatar/10/avatar.png"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="block project-reference">
                                <div class="sidebar-collapsed-icon dont-change-state">
                                    <button class="btn btn-clipboard btn-transparent" data-toggle="tooltip" data-placement="left" data-container="body" data-title="Copy reference to clipboard" data-clipboard-text="ismond/xphp#1" type="button" title="Copy reference to clipboard">
                                        <i aria-hidden="true" class="fa fa-clipboard"></i>
                                    </button>
                                </div>
                                <div class="title hide-collapsed">
                                    子任务
                                </div>
                                <div class="cross-project-reference hide-collapsed">
                                    <span>
                                    <cite title="ismond/xphp#1">ismond/xphp#1</cite>
                                    </span>
                                    <button class="btn btn-clipboard btn-transparent" data-toggle="tooltip" data-placement="left" data-container="body" data-title="Copy reference to clipboard" data-clipboard-text="ismond/xphp#1" type="button" title="Copy reference to clipboard">
                                        <i aria-hidden="true" class="fa fa-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block project-reference">
                                <div class="sidebar-collapsed-icon dont-change-state">
                                    <button class="btn btn-clipboard btn-transparent" data-toggle="tooltip" data-placement="left" data-container="body" data-title="Copy reference to clipboard" data-clipboard-text="ismond/xphp#1" type="button" title="Copy reference to clipboard">
                                        <i aria-hidden="true" class="fa fa-clipboard"></i>
                                    </button>
                                </div>
                                <div class="title hide-collapsed">
                                    自定义字段
                                </div>
                                <div class="cross-project-reference hide-collapsed">
                                    <span>
                                    <cite title="ismond/xphp#1">ismond/xphp#1</cite>
                                    </span>
                                    <button class="btn btn-clipboard btn-transparent" data-toggle="tooltip" data-placement="left" data-container="body" data-title="Copy reference to clipboard" data-clipboard-text="ismond/xphp#1" type="button" title="Copy reference to clipboard">
                                        <i aria-hidden="true" class="fa fa-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>



<script type="text/html"  id="timeline_tpl">

    {{#timelines}}
    <li id="timeline_{{id}}" name="timeline_{{id}}" class="note note-row-{{id}} timeline-entry" data-author-id="{{uid}}" >

        <div class="timeline-entry-inner">
            <div class="timeline-icon">
                <a href="/{{user.username}}">
                    <img alt="" class="avatar s40" src="{{user.avatar}}" /></a>
            </div>
            <div class="timeline-content">
                <div class="note-header">
                    <a class="visible-xs" href="/sven">@{{user.username}}</a>
                    <a class="author_link hidden-xs " href="/sven">
                        <span class="author ">@{{user.display_name}}</span></a>
                    <div class="note-headline-light">
                        <span class="hidden-xs">@{{user.username}}</span>
                        {{#if is_issue_commented}}
                            {{{action}}}
                        {{^}}
                            <span class="system-note-message">
                                {{{content}}}
                             </span>
                        {{/if}}
                        <a href="#note_{{id}}">{{time_text}}</a>
                    </div>

                    <div id="note-actions_{{id}}" class="note-actions">
                        {{#if is_issue_commented}}
                            {{#if is_cur_user}}
                                <a id="btn-timeline-edit_{{id}}" data-id="{{id}}" title="Edit comment"
                                   class="note-action-button js-note-edit2" href="#timeline_{{id}}">
                                    <i class="fa fa-pencil link-highlight"></i>
                                </a>
                                <a id="btn-timeline-remove_{{id}}" data-id="{{id}}"
                                   class="note-action-button js-note-remove danger"
                                   data-title="Remove comment"
                                   data-confirm2="Are you sure you want to remove this comment?"
                                   data-url="<?=ROOT_URL?>issue/detail/delete_timeline/{{id}}"
                                   href="#timeline_{{id}}" >
                                    <i class="fa fa-trash-o danger-highlight"></i>
                                </a>
                            {{/if}}
                        {{/if}}

                    </div>
                </div>
                {{#if is_issue_commented}}
                    <div class="js-task-list-container note-body is-task-list-enabled">
                        <form class="edit-note common-note-form js-quick-submit gfm-form" action="<?=ROOT_URL?>issue/detail/update_timeline/{{id}}" accept-charset="UTF-8" method="post" data-remote="true">

                            <div id="timeline-text_{{id}}" class="note-text md ">
                                <p dir="auto">
                                    {{{content_html}}}
                                </p>
                            </div>

                            <div id="timeline-div-editormd_{{id}}" class="note-awards" >
                                <textarea  id="timeline-textarea_{{id}}" name="content" class="hidden js-task-list-field original-task-list"  >{{content}}</textarea>
                            </div>
                            <div id="timeline-footer-action_{{id}}" class="note-form-actions hidden clearfix">
                                <div class="settings-message note-edit-warning js-edit-warning">
                                    Finish editing this message first!
                                </div>
                                <input data-id="{{id}}"  type="button" name="comment_commit" value="Save comment" class="btn btn-nr btn-save js-comment-button btn-timeline-update">
                                <button data-id="{{id}}"  class="btn btn-nr btn-cancel note-edit-cancel" type="button">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                {{^}}
                    <div class="note-body">
                        <div class="note-text md">
                            <p dir="auto">
                                {{{content_html}}}
                            </p>
                        </div>
                        <div class="note-awards">
                            <div class="awards hidden js-awards-block" data-award-url="<?=ROOT_URL?>issue/detail/timeline/{{id}}">
                                <div class="award-menu-holder js-award-holder">

                                </div>
                            </div>
                        </div>

                    </div>
                {{/if}}
            </div>
        </div>
    </li>
    {{/timelines}}

</script>

<script type="text/html"  id="wrap_field">
    <div class=" form-group">
        <div class="col-sm-1"></div>
        <div class="col-sm-2">{{display_name}}:{{required_html}}</div>
        <div class="col-sm-8">{field_html}</div>
        <div class="col-sm-1"></div>
    </div>

</script>


<script type="text/html"  id="li_tab_tpl">
    <div role="tabpanel"  class="tab-pane " id="{{id}}">

        <div   id="create_ui_config_{{id}}" style="min-height: 200px">

        </div>

    </div>
</script>

<script type="text/html"  id="nav_tab_li_tpl">
    <li role="presentation" class="active">
        <a id="a_{{id}}" href="#{{id}}" role="tab" data-toggle="tab">
            <span id="span_{{id}}">{{title}}&nbsp;</span>
        </a>
    </li>
</script>

<script type="text/html"  id="content_tab_tpl">
    <div role="tabpanel"  class="tab-pane " id="{{id}}">
        <div class="dd-list" id="create_ui_config-{{id}}" style="min-height: 200px">

        </div>
    </div>
</script>

<script type="text/html"  id="allow_update_status_tpl">
    {{#allow_update_status}}
        <button id="btn-{{_key}}" type="button" class="btn btn-default">{{name}}</button>
    {{/allow_update_status}}
</script>
<script type="text/html"  id="fav_filter_first_tpl">
    <li class="fav_filter_li">
        <a id="state-opened" title="清除该过滤条件" href="javascript:$IssueMain.updateFavFilter('0');"><span>所有事项</span> <span class="badge">0</span>
        </a>
    </li>
    {{#first_filters}}
    <li class="fav_filter_li">
        <a id="state-opened" title="{{description}}" href="javascript:$IssueMain.updateFavFilter({{id}});"><span>{{name}}</span> <span class="badge">0</span>
        </a>
    </li>
    {{/first_filters}}

</script>
<script type="text/html"  id="fav_filter_hide_tpl">

    {{#hide_filters}}
    <li>
        <a class="update-notification fav_filter_a" data-notification-level="custom" data-notification-title="Custom"  href="javascript:$IssueMain.updateFavHideFilter({{id}});" role="button">
            <strong class="dropdown-menu-inner-title">{{name}}</strong>
            <span class="dropdown-menu-inner-content">{{description}}</span>
        </a>
    </li>
    {{/hide_filters}}

</script>
<?php include VIEW_PATH . 'gitlab/issue/form.php'; ?>
<script>

     //var notes = new Notes("/api/v4/notes.json", [111, 112, 113], 1509550115, "inline")
</script>
<script>IssuableContext.prototype.PARTICIPANTS_ROW_COUNT = 7;</script>

<script>
    gl.IssuableResource = new gl.SubbableResource('/api/v4/issue_1.json');
    new gl.IssuableTimeTracking("{\"id\":1,\"iid\":1,\"assignee_id\":15,\"author_id\":15,\"description\":\"拼写错误\",\"lock_version\":null,\"milestone_id\":null,\"position\":0,\"state\":\"closed\",\"title\":\"InWord\",\"updated_by_id\":15,\"created_at\":\"2017-10-19T10:56:27.764Z\",\"updated_at\":\"2017-10-31T08:59:27.604Z\",\"deleted_at\":null,\"time_estimate\":0,\"total_time_spent\":0,\"human_time_estimate\":null,\"human_total_time_spent\":null,\"branch_name\":null,\"confidential\":false,\"due_date\":null,\"moved_to_id\":null,\"project_id\":31,\"milestone\":null,\"labels\":[]}");
    new MilestoneSelect('{"full_path":"ismond/xphp"}');
    gl.Subscription.bindAll('.subscription');
    new IssuableContext('{\"id\":<?=$user['uid']?>,\"name\":\"<?=$user['display_name']?>\",\"username\":\"<?=$user['username']?>\"}');
    window.sidebar = new Sidebar();
</script>


<script src="<?=ROOT_URL?>dev/js/handlebars.helper.js"></script>
<script type="text/javascript">

    var _issueConfig = {
        priority:null,
        issue_types:null,
        issue_status:null,
        issue_resolve:null,
        issue_module:null,
        issue_version:null,
        issue_labels:null,
        users:null,
        projects:null
    };

    var _simplemde = {};
    var _editor_md = null;
    var _fineUploader = {};
    var _fineUploaderFile = {};
    var _issue_id = '<?=$issue_id?>';
    var _cur_project_id = '<?=$project_id?>';
    var _cur_uid = '<?=$user['uid']?>';
    var _timelineEditormd;



    var $IssueDetail = null;
    var $IssueMain = null;
    var query_str = '<?=$query_str?>';
    var urls = parseURL(window.location.href);

    _editor_md = editormd("editor_md", {
        width: "100%",
        height: 220,
        markdown : "",
        path : '<?=ROOT_URL?>dev/lib/editor.md/lib/',
        imageUpload : true,
        imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
        imageUploadURL : "<?=ROOT_URL?>issue/detail/editormd_upload",
        tocm            : true,    // Using [TOCM]
        emoji           : true,
        saveHTMLToTextarea:true

    });

    $(function () {

        $IssueDetail = new IssueDetail({});
        $IssueDetail.fetchIssue(_issue_id);

        $('#btn-edit').bind('click',function () {
            IssueMain.prototype.fetchEditUiConfig(_issue_id, 'update');
        });
        $('#btn-copy').bind('click',function () {
            IssueMain.prototype.fetchEditUiConfig(_issue_id, 'copy');
        });

        $('#btn-comment').bind('click',function () {
            IssueDetail.prototype.addTimeline('0');
        });

        $('#btn-comment-reopen').bind('click',function () {
            IssueDetail.prototype.addTimeline('1');
        });

        laydate.render({
            elem: '#small_start_date'
            ,eventElem: '#a_start_date_edit'
            ,trigger: 'click'
            ,done: function(value, date){
                alert('你选择的日期是：' + value + '\n获得的对象是' + JSON.stringify(date));
            }
        });

        laydate.render({
            elem: '#small_due_date'
            ,eventElem: '#a_due_date_edit'
            ,trigger: 'click'
            ,done: function(value, date){
                alert('你选择的日期是：' + value + '\n获得的对象是' + JSON.stringify(date));
            }
        });





    });



</script>
<style>

    .CodeMirror, .CodeMirror-scroll {
        min-height: 100px;
        max-height: 200px;
    }
</style>


</body>
</html>


</div>