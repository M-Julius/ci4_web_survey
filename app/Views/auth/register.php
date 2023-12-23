<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.0/dist/css/coreui.min.css">

    <!-- Bootstrap CSS (CoreUI requires Bootstrap) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Custom Styles (Optional) -->
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .register-form {
            max-width: 400px;
            width: 100%;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="register-form">
        <h2 class="text-center mb-4">Register</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required maxlength="50"
                    minLength="5">
            </div>
            <div class="form-group">
                <label for="name">Marketing</label>
                <select class="form-control" id="marketing_id" name="marketing_id" required>
                    <?php foreach ($marketings as $marketing): ?>
                        <option value="<?= $marketing['marketing_id'] ?>">
                            <?= $marketing['nama_marketing'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required maxlength="100"
                    minlength="5">
            </div>
            <div class="form-group">
                <label for="confPassword">Konfirmasi Password</label>
                <input type="password" class="form-control" id="confPassword" name="confPassword" required
                    maxlength="100" minLength="5" oninput="checkPassword(this)">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>

    <script>
        function checkPassword(input) {
            if (input.value !== document.getElementById('password').value) {
                input.setCustomValidity('Passwords do not match');
            } else {
                input.setCustomValidity('');
            }
        }
    </script>

    <!-- CoreUI JavaScript (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.0/dist/js/coreui.bundle.min.js"></script>

    <!-- Bootstrap JavaScript (CoreUI requires Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>