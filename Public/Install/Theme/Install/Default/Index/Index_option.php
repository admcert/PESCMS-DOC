<div class="am-g am-margin-bottom">
    <div class="am-u-lg-8 am-u-md-8 am-u-sm-centered">
        <form action="<?=DOCUMENT_ROOT?>/?m=Index&a=doinstall" class="am-form am-form-horizontal" method="POST" data-am-validator>
            <input type="hidden" name="method" value="GET" />

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">程序名称:</label>
                <div class="am-u-sm-10">
                    <input type="text" name="sitetitle" placeholder="程序名称" required>
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">管理员帐号:</label>
                <div class="am-u-sm-10">
                    <input type="text" name="account" placeholder="管理员帐号" required>
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">管理员密码:</label>
                <div class="am-u-sm-10">
                    <input type="text" name="passwd" placeholder="管理员密码" required>
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">管理员邮箱:</label>
                <div class="am-u-sm-10">
                    <input type="text" name="mail" placeholder="管理员邮箱" required>
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">管理员名字:</label>
                <div class="am-u-sm-10">
                    <input type="text" name="name"  placeholder="管理员名字" required>
                </div>
            </div>

            <div class="am-form-group">
                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">开启验证码:</label>
                <div class="am-u-sm-10">
                    <div class="am-form-group">
                        <label class="am-radio-inline">
                            <input type="radio"  value="0" name="verify"> 关闭
                        </label>
                        <label class="am-radio-inline">
                            <input type="radio" value="1" name="verify"> 开启
                        </label>
                    </div>
                    <div class="am-alert am-alert-secondary" data-am-alert>
                        若程序是对外的话，建议开启本功能，可以防止程序被暴力爆破。
                    </div>
                </div>
            </div>

            <div class="am-margin-top am-fl">
                <a href="<?=DOCUMENT_ROOT?>/?m=Index&a=config" class="am-btn am-btn-default">上一步</a> 
            </div>

            <div class="am-margin-top am-fr">
                <button type="submit" id="next" class="am-btn am-btn-default">下一步</button> 
            </div>
        </form>
    </div>
</div>