<?=form_open("auth/login", array("class" => "form-horizontal", "id" => "login_form));?>
    <input type="submit" class="visibility-hidden" />
    <div class="control-group">
        <label class="control-label strong" for="username">Username</label>
        <div class="controls">
            <input required="required" type="text" id="username" name="username" placeholder="Username">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label strong" for="password">Password</label>
        <div class="controls">
            <input required="required" type="password" id="password" name="password" placeholder="Password">
        </div>
        <div class="controls">
            <label class="checkbox">
                <input type="checkbox" name="rememberme"> <a href="#" data-toggle="tooltip" title="Stay logged in for 30 days" data-placement="right">Remember me</a>
            </label>
        </div>
    </div>
<?=form_close();?>
<script>
    $("form#login_form").on('submit', user_login);
    $('[data-toggle=tooltip]').tooltip();
</script>
