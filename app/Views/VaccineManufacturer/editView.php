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
    <h1>Edit Vaccine Manufacturer</h1>
    <form action="/VaccineManufacturer/editSubmit" method="post">
        <div class="input">
            <label for="-">Vaccine Manufacturer Name</label>
            <input disabled type="text" name="-" id="-" value="<?= $vaccineManufacturer->getManufacturerName() ?>"><br />
        </div>

        <div class="input">
            <label for="productionVolume">Production Volume</label>
            <input type="number" name="productionVolume" id="productionVolume" value="<?= old('productionVolume') ? old('productionVolume') : $vaccineManufacturer->getProductionVolume() ?>"><br />
        </div>

        <div class="input">
            <label for="productionRate">Production Rate</label>
            <input type="number" name="productionRate" id="productionRate" value="<?= old('productionRate') ? old('productionRate') : $vaccineManufacturer->getProductionRate() ?>"><br />
        </div>

        <input type="hidden" name="manufacturerName" id="manufacturerName" value="<?= $vaccineManufacturer->getManufacturerName() ?>">

        <?php if (isset($error)) { ?>
            <p class="error">Error: <?= $error ?></p>
        <?php } ?>

        <input type="submit" value="Edit Vaccine Manufacturer">
    </form>
</body>

</html>