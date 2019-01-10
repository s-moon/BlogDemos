<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Currency Converter</title>
</head>
<body>
    <form action="convert.php" method="post">
        <label for="amount">Amount</label>
        <input type="text" name="amount">

        <select name="ccy1" id="ccy1">
            <option value="AUD">AUD</option>
            <option value="GBP">GBP</option>
            <option value="USD">USD</option>
        </select>
        <select name="ccy2" id="ccy2">
            <option value="AUD">AUD</option>
            <option value="GBP">GBP</option>
            <option value="USD">USD</option>
        </select>
        <input type="date" name="date" value="<?=date('Y-m-d')?>">
        <input type="submit" value="Convert">
    </form>
</body>
</html>
