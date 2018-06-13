<option value="">Select state</option>
<?php foreach ($StateByCountry as $key => $value): ?>
    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php endforeach; ?>