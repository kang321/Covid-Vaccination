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
    <h1>Adding a healthworker</h1>
    <form action="/HealthWorker/addSubmit" method="post">
        <div class="input">
            <label for="phn">phn</label>
            <input type="number" name="phn" id="phn" value="<?= old('phn') ?>"><br />
        </div>

        <div class="input">
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="<?= old('name') ?>"><br />
        </div>

        <div class="input">
            <label for="email">email</label>
            <input type="text" name="email" id="email" value="<?= old('email') ?>"><br />
        </div>
        
        <?php if (isset($error)) { ?>
            <p class="error">Error: <?= $error ?></p>
        <?php } ?>

        <input type="submit" value="Add health worker">
    </form>
</body>

</html>