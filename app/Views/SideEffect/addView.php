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
    <h1>Adding a sideeffect to </h1>
    <form action="/SideEffect/addSubmit" method="post">
        <div class="input">
            <label for="body_part">body_part</label>
            <input type="text" name="body_part" id="body_part" value="<?= old('body_part') ?>"><br />
        </div>

        <div class="input">
            <label for="complaint">complaint</label>
            <input type="text" name="complaint" id="complaint" value="<?= old('complaint') ?>"><br />
        </div>

        <?php if (isset($error)) { ?>
            <p class="error">Error: <?= $error ?></p>
        <?php } ?>

        <input type="submit" value="Add side effect">
    </form>
</body>

</html>