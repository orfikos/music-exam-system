<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/flash.php';
requireAdmin();

$stmt = $pdo->query("
    SELECT q.id, q.question_text, q.image_path, c.name AS category_name
    FROM questions q
    LEFT JOIN categories c ON q.category_id = c.id
    ORDER BY q.id DESC
");
$questions = $stmt->fetchAll();
?>

<?php include __DIR__ . '/../includes/header.php'; ?>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container page">
    <div class="card">
        <h1>Manage Questions</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Category</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $q): ?>
                    <tr>
                        <td><?= $q['id'] ?></td>
                        <td><?= htmlspecialchars($q['question_text']) ?></td>
                        <td><?= htmlspecialchars($q['category_name'] ?? 'Uncategorized') ?></td>
                        <td>
                            <?php if ($q['image_path']): ?>
                                <img src="/music-exam-system/<?= htmlspecialchars($q['image_path']) ?>" class="thumb" alt="Question image">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>