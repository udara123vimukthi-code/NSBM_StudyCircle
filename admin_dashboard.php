<?php
require_once __DIR__ . '/config/auth.php';
$user = require_admin();

$stats = $pdo->query(
    "SELECT
        (SELECT COUNT(*) FROM users
         WHERE role = 'student') AS students,
        (SELECT COUNT(*) FROM materials
         WHERE status = 'pending') AS pending,
        (SELECT COUNT(*) FROM materials
         WHERE status = 'approved') AS approved"
)->fetch();

$links = [
    [
        'admin_users.php',
        'Student accounts',
        'Search students and block or restore account access.',
        'Manage students'
    ],
    [
        'admin_materials.php',
        'Material reviews',
        'Download submissions for review, then approve or reject them.',
        'Review materials'
    ],
    [
        'admin_subjects.php',
        'Subjects',
        'Create, edit, and organise university subjects.',
        'Manage subjects'
    ],
    [
        'admin_categories.php',
        'Resource categories',
        'Manage material types such as lecture notes and past papers.',
        'Manage categories'
    ],
    [
        'forum.php',
        'Discussion moderation',
        'Review questions and open discussions to moderate answers.',
        'Moderate discussions'
    ],
    [
        'materials.php',
        'Resource comments',
        'Open an approved resource’s details to review or remove comments.',
        'Browse resource discussions'
    ],
    [
        'admin_reports.php',
        'Usage and engagement',
        'Review download activity, ratings, and community participation.',
        'View reports'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | NSBM StudyCircle</title>
    <link rel="stylesheet" href="site.css">
    <link rel="stylesheet" href="theme.css?v=1">
    <script src="theme.js?v=1"></script>
    <link rel="stylesheet" href="branding.css?v=1">
    <link rel="stylesheet" href="nsbm-professional.css?v=1">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="admin_dashboard.php">
            <span class="brand-mark brand-mark-logo" aria-hidden="true"><img src="assets/nsbm-logo.svg" alt="NSBM Green University Town"></span>
            <span>
                <strong>StudyCircle</strong>
                <small>ADMINISTRATION</small>
            </span>
        </a>

        <nav aria-label="Admin navigation">
            <button type="button" class="theme-toggle" aria-label="Switch to dark theme" aria-pressed="false" hidden>Dark mode</button>
<a class="profile-chip" href="profile.php" aria-label="Open your profile" title="View profile">
    <span class="profile-avatar" aria-hidden="true"><?= escape(mb_strtoupper(mb_substr($user['full_name'], 0, 1))) ?></span>
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/></svg>
    <span class="profile-name">Profile</span>
</a>
            <a href="index.php">Home</a>
            <a href="admin_reports.php">Reports</a>

            <form method="post" action="logout.php">
                <input type="hidden" name="csrf_token"
                       value="<?= escape(csrf_token()) ?>">
                <button class="button button-outline" type="submit">
                    Log out
                </button>
            </form>
        </nav>
    </div>
</header>

<main class="container">
    <section class="welcome">
        <p class="eyebrow">NSBM Green University · Administration</p>
        <h1>Hello, <?= escape($user['full_name']) ?>!</h1>
        <p>Keep the community organised and help useful resources reach students.</p>
    <div class="actions dashboard-actions"><a class="button button-outline" href="admin_materials.php">Review submissions &rarr;</a><a class="button button-outline" href="admin_reports.php">View reports &rarr;</a></div>
    </section>

    <section class="stats" aria-label="Community overview">
        <article class="card">
            <h2 class="stat-label">Student accounts</h2>
            <p class="stat-number"><?= (int) $stats['students'] ?></p>
        </article>
        <article class="card">
            <h2 class="stat-label">Awaiting review</h2>
            <p class="stat-number"><?= (int) $stats['pending'] ?></p>
        </article>
        <article class="card">
            <h2 class="stat-label">Approved resources</h2>
            <p class="stat-number"><?= (int) $stats['approved'] ?></p>
        </article>
    </section>

    <div class="section-heading">
        <h2>Administration tools</h2>
        <p>Manage content, student access, and community activity.</p>
    </div>

    <section class="grid" aria-label="Admin tools">
        <?php foreach ($links as [$url, $title, $description, $label]): ?>
            <a class="card card-link" href="<?= escape($url) ?>">
                <h3><?= escape($title) ?></h3>
                <p><?= escape($description) ?></p>
                <span class="link-label"><?= escape($label) ?> &rarr;</span>
            </a>
        <?php endforeach; ?>
    </section>
</main>

<footer class="site-footer">
    <div class="container">
        <div class="sc-footer-grid">
            <div class="sc-footer-brand">
                <img src="assets/nsbm-logo.svg" alt="NSBM Green University Town">
                <p>StudyCircle is a student community for sharing notes, asking questions and organising group study at NSBM Green University.</p>
            </div>
            <div>
                <h4>StudyCircle</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About the project</a></li>
                    <li><a href="study_tips.php">Study tips</a></li>
                    <li><a href="faq.php">Help and FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4>NSBM Green University</h4>
                <ul>
                    <li>Faculty of Computing</li>
                    <li>Batch 26.1 IFSL</li>
                    <li><a href="https://www.nsbm.ac.lk" target="_blank" rel="noopener">nsbm.ac.lk</a></li>
                </ul>
            </div>
        </div>
        <div class="sc-footer-bottom">&copy; 2026 NSBM StudyCircle &middot; Student coursework project</div>
    </div>
</footer>
</body>
</html>