<option value="">Select city</option>
<?php foreach ($CityByCountry as $key => $value): ?>
    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php endforeach; ?>