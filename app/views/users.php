<h2>User Management</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo htmlspecialchars($user['username']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>
