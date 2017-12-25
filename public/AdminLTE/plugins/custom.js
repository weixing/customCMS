$(document).ready(function(){

    $("button[id^='editAuthStatus_']").click(	//修改权限属性的status状态
		function()
		{
			var elementId = $(this).attr('id');
            var authId = elementId.replace('editAuthStatus_', '');
            var elementObj = $(this);
            var iconObj = $('#authStatusIcon_'+authId);

            var authStatus = 1;
            if ($(this).hasClass('btn-danger')) {
                authStatus = 0;
            }

            var ajax_url = '/auth/editStatus/?aid='+authId+'&status='+authStatus
            $.ajax({
                url: ajax_url,
                type: 'GET',
                error: function()
                {
                    alert('Error loading XML document');
                },
                success: function(xml)
                {
                    if (authStatus == 0) {
                        elementObj.removeClass('btn-danger');
                        elementObj.addClass('btn-success');
                        elementObj.html('恢复');
                        iconObj.removeClass('glyphicon-ok');
                        iconObj.addClass('glyphicon-remove');

                    } else {
                        elementObj.removeClass('btn-success');
                        elementObj.addClass('btn-danger');
                        elementObj.html('删除');
                        iconObj.removeClass('glyphicon-remove');
                        iconObj.addClass('glyphicon-ok');
                    }
                }
            });
		});


    $("button[id^='editUserStatus_']").click(	//修改用户的status状态
		function()
		{
			var elementId = $(this).attr('id');
            var userId = elementId.replace('editUserStatus_', '');
            var elementObj = $(this);
            var iconObj = $('#userStatusIcon_'+userId);

            var userStatus = 1;
            if ($(this).hasClass('btn-danger')) {
                userStatus = 0;
            }

            var ajax_url = '/user/editStatus/?uid='+userId+'&status='+userStatus
            $.ajax({
                url: ajax_url,
                type: 'GET',
                error: function()
                {
                    alert('Error loading XML document');
                },
                success: function(xml)
                {
                    if (userStatus == 0) {
                        elementObj.removeClass('btn-danger');
                        elementObj.addClass('btn-success');
                        elementObj.html('恢复');
                        iconObj.removeClass('glyphicon-ok');
                        iconObj.addClass('glyphicon-remove');

                    } else {
                        elementObj.removeClass('btn-success');
                        elementObj.addClass('btn-danger');
                        elementObj.html('删除');
                        iconObj.removeClass('glyphicon-remove');
                        iconObj.addClass('glyphicon-ok');
                    }
                }
            });
		});

    $("button[id^='editRoleStatus_']").click(	//修改角色的status状态
		function()
		{
			var elementId = $(this).attr('id');
            var roleId = elementId.replace('editRoleStatus_', '');
            var elementObj = $(this);
            var iconObj = $('#roleStatusIcon_'+roleId);

            var roleStatus = 1;
            if ($(this).hasClass('btn-danger')) {
                roleStatus = 0;
            }

            var ajax_url = '/role/editStatus/?rid='+roleId+'&status='+roleStatus
            $.ajax({
                url: ajax_url,
                type: 'GET',
                error: function()
                {
                    alert('Error loading XML document');
                },
                success: function(xml)
                {
                    if (roleStatus == 0) {
                        elementObj.removeClass('btn-danger');
                        elementObj.addClass('btn-success');
                        elementObj.html('恢复');
                        iconObj.removeClass('glyphicon-ok');
                        iconObj.addClass('glyphicon-remove');

                    } else {
                        elementObj.removeClass('btn-success');
                        elementObj.addClass('btn-danger');
                        elementObj.html('删除');
                        iconObj.removeClass('glyphicon-remove');
                        iconObj.addClass('glyphicon-ok');
                    }
                }
            });
		});

    $("button[id^='editSiteStatus_']").click(	//修改发布点的status状态
		function()
		{
			var elementId = $(this).attr('id');
            var siteId = elementId.replace('editSiteStatus_', '');
            var elementObj = $(this);
            var iconObj = $('#siteStatusIcon_'+siteId);

            var siteStatus = 1;
            if ($(this).hasClass('btn-danger')) {
                siteStatus = 0;
            }

            var ajax_url = '/site/editStatus/?sid='+siteId+'&status='+siteStatus
            $.ajax({
                url: ajax_url,
                type: 'GET',
                error: function()
                {
                    alert('Error loading XML document');
                },
                success: function(xml)
                {
                    if (siteStatus == 0) {
                        elementObj.removeClass('btn-danger');
                        elementObj.addClass('btn-success');
                        elementObj.html('恢复');
                        iconObj.removeClass('glyphicon-ok');
                        iconObj.addClass('glyphicon-remove');

                    } else {
                        elementObj.removeClass('btn-success');
                        elementObj.addClass('btn-danger');
                        elementObj.html('删除');
                        iconObj.removeClass('glyphicon-remove');
                        iconObj.addClass('glyphicon-ok');
                    }
                }
            });
		});

    $("button[id^='editWebpageStatus_']").click(	//修改发布点的status状态
		function()
		{
			var elementId = $(this).attr('id');
            var webpageId = elementId.replace('editWebpageStatus_', '');
            var elementObj = $(this);
            var iconObj = $('#webpageStatusIcon_'+webpageId);

            var webpageStatus = 1;
            if ($(this).hasClass('btn-danger')) {
                webpageStatus = 0;
            }

            var ajax_url = '/webpage/editStatus/?wpid='+webpageId+'&status='+webpageStatus
            $.ajax({
                url: ajax_url,
                type: 'GET',
                error: function()
                {
                    alert('Error loading XML document');
                },
                success: function(xml)
                {
                    if (webpageStatus == 0) {
                        elementObj.removeClass('btn-danger');
                        elementObj.addClass('btn-success');
                        elementObj.html('恢复');
                        iconObj.removeClass('glyphicon-ok');
                        iconObj.addClass('glyphicon-remove');

                    } else {
                        elementObj.removeClass('btn-success');
                        elementObj.addClass('btn-danger');
                        elementObj.html('删除');
                        iconObj.removeClass('glyphicon-remove');
                        iconObj.addClass('glyphicon-ok');
                    }
                }
            });
		});

    $("button[id^='editBlockStatus_']").click(	//修改发布点的status状态
		function()
		{
			var elementId = $(this).attr('id');
            var blockId = elementId.replace('editBlockStatus_', '');
            var elementObj = $(this);
            var iconObj = $('#blockStatusIcon_'+blockId);

            var blockStatus = 1;
            if ($(this).hasClass('btn-danger')) {
                blockStatus = 0;
            }

            var ajax_url = '/block/editStatus/?bid='+blockId+'&status='+blockStatus
            $.ajax({
                url: ajax_url,
                type: 'GET',
                error: function()
                {
                    alert('Error loading XML document');
                },
                success: function(xml)
                {
                    if (blockStatus == 0) {
                        elementObj.removeClass('btn-danger');
                        elementObj.addClass('btn-success');
                        elementObj.html('恢复');
                        iconObj.removeClass('glyphicon-ok');
                        iconObj.addClass('glyphicon-remove');

                    } else {
                        elementObj.removeClass('btn-success');
                        elementObj.addClass('btn-danger');
                        elementObj.html('删除');
                        iconObj.removeClass('glyphicon-remove');
                        iconObj.addClass('glyphicon-ok');
                    }
                }
            });
		});

    $("button[id^='editCategoryStatus_']").click(	//修改发布点的status状态
		function()
		{
			var elementId = $(this).attr('id');
            var categoryId = elementId.replace('editCategoryStatus_', '');
            var elementObj = $(this);
            var iconObj = $('#categoryStatusIcon_'+categoryId);

            var categoryStatus = 1;
            if ($(this).hasClass('btn-danger')) {
                categoryStatus = 0;
            }

            var ajax_url = '/category/editStatus/?cid='+categoryId+'&status='+categoryStatus
            $.ajax({
                url: ajax_url,
                type: 'GET',
                error: function()
                {
                    alert('Error loading XML document');
                },
                success: function(xml)
                {
                    if (categoryStatus == 0) {
                        elementObj.removeClass('btn-danger');
                        elementObj.addClass('btn-success');
                        elementObj.html('恢复');
                        iconObj.removeClass('glyphicon-ok');
                        iconObj.addClass('glyphicon-remove');

                    } else {
                        elementObj.removeClass('btn-success');
                        elementObj.addClass('btn-danger');
                        elementObj.html('删除');
                        iconObj.removeClass('glyphicon-remove');
                        iconObj.addClass('glyphicon-ok');
                    }
                }
            });
		});
});
