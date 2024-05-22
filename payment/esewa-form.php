

<!DOCTYPE html>
<html>
<head>
    <title>eSewa Payment Integration</title>
</head>
<body>
    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
        <?php foreach ($form_data as $key => $value) : ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
        <?php endforeach; ?>
    </form>
</body>
</html>
