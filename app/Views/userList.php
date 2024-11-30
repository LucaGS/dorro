<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
    <h1>Benutzerliste</h1>
    <table>
        <tr>
            <th>UserId</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>CreatedAt</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['UserId']) ?></td>
                <td><?= htmlspecialchars($user['Username']) ?></td>
                <td><?= htmlspecialchars($user['Password']) ?></td>
                <td><?= htmlspecialchars($user['Email']) ?></td>
                <td><?= htmlspecialchars($user['CreatedAt']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

