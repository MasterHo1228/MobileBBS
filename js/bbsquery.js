/**
 * Created by Administrator on 2016/6/2.
 */
var loginStatus = false;
function reflashForumList() {//刷新论坛页列表
    $("#ForumList").empty();
    $.ajax({
        url: 'backend/loadtitles.php', dataType: 'xml', success: function (data) {
            $(data).find("topic").each(function () {
                var tID = $(this).find("tID").text();
                var tLink = $(this).find("tLink").text();
                var tTitle = $(this).find("tTitle").text();
                var tContent = $(this).find("tContent").text();
                var tCreatedDate = $(this).find("tCreatedDate").text();
                var tCreatedTime = $(this).find("tCreatedTime").text();
                var Author = $(this).find("Author").text();
                var tClickCount = $(this).find("tClickCount").text();

                var titleRow =
                    "<li data-role='list-divider'>" + tCreatedDate + "&nbsp;" + tCreatedTime + "<span class='ui-li-count'>" + tClickCount + "</span>" + "</li>" +
                    "<li>" + "<a href='" + tLink + "' data-transition='slide'>" +
                    "<h2>" + tTitle + "</h2>" +
                    "<p>" + tContent + "</p>" +
                    "<p class='ui-li-aside'>" + "<strong>" + Author + "</strong>" + "</p>" +
                    "</a>" + "</li>";
                $("#ForumList").append(titleRow);
            });
            $("#ForumList").listview('refresh');//刷新listview
        },
        error: function () {
            alert("加载失败！");
        }
    })
}
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function getUrlVar(name) {
    return getUrlVars()[name];
}
$(document).on("pagebeforeshow", "#Forum", function () {
    $.ajax({
        url: "backend/loginstatus.php", success: function (status) {
            if (status == "login") {
                loginStatus = true;
                $(".btnUser").attr("href", "#User").text("用户");
                $("#btnFtNewReply").show();
            }
        }
    });
    reflashForumList();
});
$(document).on("pagebeforeshow", "#PubReply", function () {
    $.ajax({
        url: "backend/findtopictitle.php", success: function (data) {
            $("#reTopicTitle").attr("value", data);
            $("#ReplyContent").text("");
        }
    });
});
$(document).on("pageinit", "#PubReply", function () {
    $("#btnPubReply").on("tap", function () {
        $.post("backend/publishreply.php", $("#formReply").serialize(), function (data) {
            $("#replyPageEvent").html(data);
        });
    })
});
$(document).on("pagehide", "#PubReply", function () {
    if ($("#ReplyContent").text("") != "") {//离开发送回复页面时清空输入域的文字
        $("#ReplyContent").text("");
    }
});
$(document).on("pagebeforeshow", "#Login", function () {
    if (loginStatus == true) {//如果检测到已经登录网站了，就直接跳转到user页
        location.href("#User");
    }
});
$(document).on("pageinit", "#Login", function () {
    $("#btnLogin").on("tap", function () {
        if ($("#usrName").val() != "" && $("#usrPW").val() != "") {//检测是否已经输入用户名和密码
            //通过ajax的post方法将数据静默传到后台
            $.post("backend/logincheck.php", $("#formLogin").serialize(), function (data) {
                $("#loginStatus").html(data);
            })
        }
        else if ($("#usrName").val() != "" && $("#usrPW").val() == "") {//输入了用户名但是没输入密码的情况
            alert("请输入密码！！");
        }
        else if ($("#usrName").val() == "" && $("#usrPW").val() == "") {
            alert("亲，输入了用户名和密码再按登录吧~~\n_(:з」∠)_");
        }
    })
});
$(document).on("pagebeforeshow", "#User", function () {
    $.ajax({
        url: "backend/showusertopics.php", dataType: 'xml', success: function (data) {//ajax拉取该用户的话题概览信息
            $("#userTopicList").empty();
            $(data).find("topic").each(function () {
                var tTitle = $(this).find("tTitle").text();
                var tLink = $(this).find("tLink").html();
                var tCreatedDate = $(this).find("tCreatedDate").text();
                var tCreatedTime = $(this).find("tCreatedTime").text();
                var tContent = $(this).find("tContent").text();

                var titleRow =
                    "<li data-role='list-divider'>" + tCreatedDate + "&nbsp;" + tCreatedTime + "</li>" +
                    "<li>" + "<a href='" + tLink + "'>" +
                    "<h2>" + tTitle + "</h2>" +
                    "<p>" + tContent + "</p>" +
                    "</a>" + "</li>";
                $("#userTopicList").append(titleRow);
            });
            $("#userTopicList").listview('refresh');//刷新listview
        },
        error: function () {
            alert("加载失败！");
        }
    });
});
$(document).on("pageinit", "#User", function () {
    $("#UserInfo").load("backend/showuserinfo.php");//加载用户信息
    $(".btnLogout").on("tap", function () {
        $.ajax({
            url: "backend/logout.php", success: function (data) {
                $("#userJSEvent").html(data);
            }
        });
    });
    $(".btnBack").on("tap", function () {
        history.go(-1);
    })
});
$(document).on("pageinit", "#Register", function () {//注册页面
    $("#btnReg").on("tap", function () {
        if ($("#regUsrName").val() != "" && $("#regUsrPW").val() != "") {
            if ($("#regUsrPW").val() != $("#regUsrPWC").val()) {//检测密码是否一致
                alert("亲，先后输入的密码不一致喔~~");
            }
            else {
                $.post("backend/register.php", $("#formReg").serialize(), function (data) {
                    $("#RegStatus").html(data);
                });
            }
        }
        else {
            alert("请输入用户名和密码！！");
        }
    })
});
$(document).on("pageinit", "#Forum", function () {
    $("#ForumRefresh").on("tap", function () {//论坛页内的刷新按钮
        reflashForumList();
    });
    $(".btnUser").on("tap", function () {
        if (loginStatus == true) {
            location.href = "#User";
        }
    });
});
$(document).on("pagebeforeshow", "#Topic", function () {
    var tIDVal = getUrlVar('tID');
    var tID = decodeURI(tIDVal);
    var uID;//记录用户ID
    $.ajax({//检测登录状态并验证是否为话题或评论作者
        url: "backend/loginstatus.php", success: function (status) {
            if (status == "login") {
                loginStatus = true;
                $(".btnUser").attr("href", "#User").text("用户");
                $("#btnFtNewTopic").show();
            }
        },complete:function () {
            if(loginStatus==true){
                $.ajax({
                    url: "backend/showuserid.php",dataType:'xml',success: function (data) {
                        uID = $(data).find("UserID").text();
                    }
                });
            }
            $.ajax({
                url: "backend/loadtopicmain.php", data: {tID: tID}, dataType: 'xml', success: function (data) {
                    $(data).find("topic").each(function () {
                        var topicTitle = $(this).find("title").text();
                        var topicContent = $(this).find("content").text();
                        var topicAuthor = $(this).find("author").text();
                        var AuthorID = parseInt($(this).find("authorID").text());
                        var topicTime = $(this).find("time").text();

                        $("#topicTitle").append(topicTitle);
                        $("#topicContent").append(topicContent);
                        $("#topicAuthor").append(topicAuthor);
                        $("#topicTime").append(topicTime);
                        if (uID == AuthorID) {
                            $("#btnTopicEdit").css("display","inline-block").attr("href", "edittopic.html?tID=" + tID);
                            $("#btnDelTopic").css("display","inline-block").attr("href", "confirmdeltopic.html?tID=" + tID);
                        }

                        $(this).find("reply").each(function () {
                            var replyID = $(this).find("replyID").text();
                            var replyerUID = $(this).find("replyerUID").text();
                            var replyerName = $(this).find("replyerName").text();
                            var replyContent = $(this).find("replyContent").text();
                            var replySendTime = $(this).find("replySendTime").text();

                            if (replyerUID == uID) {
                                var replyRow =
                                    "<div class='ui-corner-all custom-corners'>" +
                                    "<div class='ui-bar ui-bar-a'>" +
                                    "<h3>来自:" + replyerName + "的回复</h3>" +
                                    "</div>" +
                                    "<div class='ui-body ui-body-a'>" +
                                    "<p>" +
                                    replyContent + "<br>" +
                                    "<span class='topicInfo'>发送时间：" + replySendTime + "</span>" +
                                    "<a href='" + "confirmDelReply.html?tID=" + tID + "&replyID=" + replyID + "' class='ui-btn ui-mini ui-btn-inline'>删除回复</a>" +
                                    "</p>" +
                                    "</div>" +
                                    "</div>";
                            } else {
                                var replyRow =
                                    "<div class='ui-corner-all custom-corners'>" +
                                    "<div class='ui-bar ui-bar-a'>" +
                                    "<h3>来自:" + replyerName + "的回复</h3>" +
                                    "</div>" +
                                    "<div class='ui-body ui-body-a'>" +
                                    "<p>" +
                                    replyContent + "<br>" +
                                    "<span class='topicInfo'>发送时间：" + replySendTime + "</span>" +
                                    "</p>" +
                                    "</div>" +
                                    "</div>";
                            }
                            $("#divTopicReplies").append(replyRow);
                        })
                    })
                },complete:function () {
                    $.post("backend/addtopiccount.php",{tID:tID});
                }
            })
        }
    });
});

$(document).on("pageinit", "#NewTopic", function () {
    $("#btnNewTopic").on("tap", function () {
        if ($("#nTopicTitle").val() != "" && $("#nTopicContent").val() != "") {
            $.post("backend/publishtopic.php", $("#formNewTopic").serialize(), function (data) {
                $("#divNewTopicEvent").html(data);
            })
        }
        else if ($("#nTopicTitle").val() == "" || $("#nTopicContent").val() == "") {
            alert("别胡乱调戏按钮啦，标题内容输入完整才能发布的呦~~");
        }
    });
});
$(document).on("pagebeforeshow", "#editTopic", function () {
    $.ajax({
        url: "backend/loadedittopic.php", dataType: 'xml', success: function (data) {
            $(data).find("topic").each(function () {
                var tTitle = $(this).find("tTitle").text();
                var tContent = $(this).find("tContent").text();

                $("#edTopicTitle").attr("value", tTitle);
                $("#edTopicContent").text(tContent);
            })
        },
        error: function () {
            alert("加载失败！");
        }
    })
});
$(document).on("pageinit", "#editTopic", function () {
    $("#btnEditTopic").on("tap", function () {
        $.post("backend/updatetopic.php", $("#formEditTopic").serialize(), function (data) {
            $("#divEditTopicEvent").html(data);
        })
    })
});
