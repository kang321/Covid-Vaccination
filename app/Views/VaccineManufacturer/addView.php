<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPSC 304 | Vaccination Center</title>
    <style>
        .input {
            margin-bottom: 1rem;
        }

        .error {
            color: red; 
            margin-bottom: 1rem; 
            font-weight: bold; 
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <h1>Adding a vaccine manufacturer</h1>
    <form action="/VaccineManufacturer/addSubmit" method="post">
        <div class="input">
            <label for="manufacturerName">Vaccine Manufacturer Name</label>
            <input type="text" name="manufacturerName" id="manufacturerName" value="<?= old('manufacturerName') ?>"><br />
        </div>

        <div class="input">
            <label for="productionVolume">Production Volume</label>
            <input type="number" name="productionVolume" id="productionVolume" value="<?= old('productionVolume') ?>"><br />
        </div>

        <div class="input">
            <label for="productionRate">Production Rate</label>
            <input type="number" name="productionRate" id="productionRate" value="<?= old('productionRate') ?>"><br />
        </div>

        <?php if (isset($error)) { ?>
            <p class="error">Error: <?= $error ?></p>
        <?php } ?>

        <input type="submit" value="Add Vaccine Manufacturer">
    </form>
</body>

</html>