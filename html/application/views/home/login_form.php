<?php echo form_open('auth/login', array('class' => 'form-horizontal', 'id' => 'login_form')); ?>
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
<?php echo form_close(); ?>
<script>
    $('#login_form').on('submit', user_login);
</script>