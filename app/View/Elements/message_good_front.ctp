<?php if ($message): ?>
    <h2 class="flash">
        <small>
            <div class="alert alert-success">
                <strong>Success!</strong> <?php echo $message; ?>
            </div>
        </small>
    </h2>
<?php endif; ?>
