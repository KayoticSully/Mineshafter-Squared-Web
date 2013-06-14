<div class="container extra-top-padding">
    <h2>
        Do you need a Mineshafter Squared account?
    </h2>
    <p>
        Unfortunately, only certain kinds of Minecraft accounts are compatible
        with Mineshafter Squared.  You can use this sign-up page to access
        the site's services if you do not have a compatible Minecraft account.
        I do urge you to <strong>make sure</strong> your account is <strong>not compatible</strong>
        before going on to create a Mineshafter Squared account.  MS^2 accounts
        are slightly limited and will force your username to start with <strong><?php echo $prefix; ?></strong>.
        This also means you can only choose a 10 character long username.
    </p>
    <p>
        This limitation is to ensure compatability with premium Minecraft accounts.  Since
        Mineshafter Squared allows free players to play along side of premium players,
        the site needs to make sure your name is not a possible Minecraft username.  Other
        than that small inconvienience, you will have full access to all of Mineshafter Squared's
        services!
    </p>
    <br>
    <div class="row">
        <div class="span8 offset3">
            <h1>
                Create an Account
            </h1>
            <?php echo form_open('auth/login', array('class' => 'form-horizontal', 'id' => 'login_form')); ?>
                <input type="submit" class="visibility-hidden" />
                <div class="control-group">
                    <label class="control-label strong" for="username">Username</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><?php echo $prefix; ?></span>
                            <input class="span2" id="prependedInput" required="required" type="text" placeholder="Username" maxlength="10">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label strong" for="email">Email Address</label>
                    <div class="controls">
                        <input required="required" type="email" id="email" name="email" placeholder="address@example.com">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label strong" for="password">Password</label>
                    <div class="controls">
                        <input required="required" type="password" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label strong" for="confirm_password">Confirm Password</label>
                    <div class="controls">
                        <input required="required" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label strong" for="confirm_password"></label>
                    <div class="controls">
                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    
</div>