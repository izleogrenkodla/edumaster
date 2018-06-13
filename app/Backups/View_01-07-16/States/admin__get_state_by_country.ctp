<option value="0">Select State</option>
<?php foreach ($StateByCountry as $key => $value): ?>
    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php endforeach; ?>