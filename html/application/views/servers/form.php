<form action="#" method="POST" id="server-form" class="form-horizontal">
    <?php if(isset($server)): ?>
        <input type="hidden" name="id" value="<?php echo $server->id; ?>" />
    <?php endif; ?>
    <div class="control-group">
        <label class="control-label strong" for="name">Name</label>
        <div class="controls">
            <input required="required" type="text" id="name" name="name" value="<?php if(isset($server)){ echo $server->name; } ?>" placeholder="Server Name">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label strong" for="address">IP / URL</label>
        <div class="controls">
            <input required="required" type="text" id="address" name="address" value="<?php if (isset($server)){ echo $server->address . ':' . $server->port; } ?>" placeholder="server.example.com">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label strong" for="address">Description</label>
        <div class="controls">
            <textarea required="required" name="description" id="description" rows="3"><?php if (isset($server)){ echo $server->description; } ?></textarea>
        </div>
    </div>
</form>