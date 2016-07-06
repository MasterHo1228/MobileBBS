<link rel="stylesheet" type="text/css" href="css/mobilebbs.css">
<div data-role="page" id="Topic">
    <div data-role="header" data-position="fixed">
        <a href="#" data-role="button" data-rel="back" data-icon="back">返回</a>
        <h1>话题内容</h1>
        <a href='index.html/#User' data-role='button' data-icon='user' class='ui-btn-right' data-transition='slide'>用户</a>
        <a href='index.html/#Login' data-role='button' data-icon='user' class='ui-btn-right' data-transition='slide'>登录</a>
    </div><!-- /header -->
    <div data-role="content">
        <h3 class="ui-bar ui-bar-a ui-corner-all">标题：</h3>
        <div class="ui-body ui-body-a ui-corner-all">
            <p>
                <br/><br/>
                <span class="topicInfo">作者：<br/>发布时间：</span><br/>
                <a href='index.html#editTopic' class='ui-btn ui-mini ui-btn-inline'>编辑话题</a>
                <a href='backend/deltopic.php?tID=".$tID."&isauthor=true"."' class='ui-btn ui-mini ui-btn-inline'>删除话题</a>
            </p>
        </div>
        <div class='ui-corner-all custom-corners'>
            <div class='ui-bar ui-bar-a'>
                <h3>来自:  的回复</h3>
                </div>
                <div class='ui-body ui-body-a'>
                    <p>
                        <br/>
                        <span class='topicInfo'>发送时间</span>
                        <a href='backend/delreply.php?cID=".$cID."&isreplyauthor=true"."' class='ui-btn ui-mini ui-btn-inline'>删除回复</a>
                    </p>
                </div>
        </div>
    </div><!-- /content -->
    <div data-role="footer" data-position="fixed">
        <div data-role='navbar' data-iconpos='left' id='btnFtNewReply'>
            <ul>
                <li><a href='index.html#PubReply' data-role='button' class='ui-btn' data-icon='plus' data-transition='flip'>发表评论</a></li>
            </ul>
        </div>
        <h1 class="copyRight">Copyright&copy; MasterHo 2016<br>Powered by jQuery Mobile.</h1>
    </div>
</div><!-- /page -->

