</div>
<!-- core -- !-->
<script src="<?= assets_url() ?>template/js/jquery-1.12.3.min.js"></script>
<script src="<?= assets_url() ?>template/js/bootstrap.min.js"></script>

<!-- end core -- !-->
<!-- assets -- !-->
<?php if(!empty($js)): ?>
    <?php foreach($js as $href): ?>
        <script src="<?= $href ?>"></script>
    <?php endforeach ?>
<?php endif ?>
<!-- end assets -- !-->

</body>
</html>