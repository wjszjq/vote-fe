<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>候选人详情</title>
    <link href="/Public/css/reset.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/style.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/main.css" type="text/css" rel="stylesheet">
    <link href="/Public/css/zebra.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/Public/js/layer.m.js"></script>
</head>
<body>
<div class="head">
    <div class="login-right-panel">
        <div class="login-logo"></div>
    </div>
    <div class="nav" style="height: 35px;">
    </div>
</div>
<!-- 网页内容  -->
<div class="content pageVote">
    <div id="container">

        <table class="zebra">

            <thead>
            <tr>
                <th colspan="2" style="font-size:20px;
	font-weight:normal;"><?php echo ($selectDepartments[0]["name"]); ?>候选人<?php echo ($selectEmployee[0]["name"]); ?>详细信息</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td>姓名</td>
                <td><?php echo ($selectEmployee[0]["name"]); ?></td>
            </tr>
            <tr>
                <td>照片</td>
                <td><img src="<?php echo ($avatarUrlPrefix); echo ($selectEmployee[0]["avatar"]); ?>" width="100px" height="100px" title="<?php echo ($selectEmployee[0]["name"]); ?>"></td>
            </tr>
            <tr>
                <td>性别</td>
                <?php if($selectEmployee[0].gender==1){ ?>
                <td>男</td>
                <?php }else{ ?>
                <td>女</td>
                <?php } ?>
            </tr>
            <tr>
                <td>职位</td>
                <td><?php echo ($selectEmployee[0]["position"]); ?></td>
            </tr>
            <tr>
                <td>个人介绍</td>
                <td><?php echo ($selectEmployee[0]["description"]); ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="voteButton">
                        <span employeeId="<?php echo ($selectEmployee[0]["id"]); ?>" class="weiboVote"></span>
                        <span class="voteNumber"><?php echo ($selectEmployee[0]["votes"]); ?></span>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
<script type="text/javascript">
        $('.weiboVote').click(function(){
            var voteObj = $(this);
            var departmentId = "<?php echo ($departmentId); ?>";
            var employeeId = $(this).attr('employeeId');
            var toURL = "<?php echo U('home/index/vote');?>";
            var sendContent = {departmentId:departmentId,employeeId:employeeId};
            $.ajax({
                url:toURL,
                type:'post',
                data:sendContent,
                dataType:'json',
                success:function(e){
                    console.log(e);
                    if(e.flag == 'success') {
                        var vote = parseInt(voteObj.siblings('.voteNumber').text());
                        vote += 1;
                        voteObj.siblings('.voteNumber').text(vote);
                        layer.open({content: e.msg, time:2});
                    }
                    if(e.flag == 'fail') {
                        layer.open({content: e.msg, time:2});
                    }
                }

            });
        });
 </script>
</html>