<div class="container">
    <div class="row">
        <div class="span12">
            <section>
                <?php editable_table("All of the Datas",
                                     "/datas",
                                     $datas,
                                     array(
                                           array('Key', 'key', true),
                                           array('Value', 'value', true)
                                     )
                                    );
                ?>
            </section>
        </div>
    </div>
</div>
