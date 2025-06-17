<!DOCTYPE html>
<html>
<head>
    <title>URL Kısaltıcı</title>
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; font-family: sans-serif; background: #f0f0f0; }
        .box { text-align: center; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px #aaa; }
        input { padding: 10px; width: 300px; }
        button { padding: 10px 15px; margin-top: 10px; }
        .message { margin-top: 20px; color: green; }
    </style>
</head>
<body>
    <div class="box">
        <h2>URL Kısalt</h2>
        <form method="post">
            <input type="text" name="url" placeholder="https://ornek.com" required>
            <br>
            <button type="submit">Kısalt</button>
        </form>
        <?php if (!empty($data['message'])): ?>
            <div class="message"><?= $data['message'] ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
