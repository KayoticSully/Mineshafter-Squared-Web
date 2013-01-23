<form action="/auth/login" method="POST" id="login_form" class="form-horizontal">
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
    </div>
</form>
<script>
    $('#login_form').on('submit', user_login);
</script>