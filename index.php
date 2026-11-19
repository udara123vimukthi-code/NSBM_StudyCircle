<?php
require_once __DIR__ . '/config/auth.php';

$currentUser = null;
$dashboard = 'dashboard.php';

if (!empty($_SESSION['user_id'])) {
    $currentUser = require_login();
    $dashboard = $currentUser['role'] === 'admin'
        ? 'admin_dashboard.php'
        : 'dashboard.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NSBM StudyCircle - a student space for notes, questions and group study.">
    <title>NSBM StudyCircle | Learn Together</title>
    <link rel="stylesheet" href="site.css?v=2">
    <link rel="stylesheet" href="theme.css?v=2">
    <script src="theme.js?v=2"></script>
    <link rel="stylesheet" href="branding.css?v=1">
    <link rel="stylesheet" href="nsbm-professional.css?v=1">
</head>
<body class="home-background">
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="index.php" aria-label="NSBM StudyCircle home">
            <span class="brand-mark brand-mark-logo" aria-hidden="true"><img src="assets/nsbm-logo.svg" alt="NSBM Green University Town"></span>
            <span>
                <strong>StudyCircle</strong>
                <small>NSBM GREEN UNIVERSITY</small>
            </span>
        </a>

        <nav aria-label="Main navigation">
            <a href="about.php">About</a>
            <a href="study_tips.php">Study tips</a>
            <button type="button" class="theme-toggle" aria-label="Switch to dark theme"
                    aria-pressed="false" hidden>Dark mode</button>
            <?php if ($currentUser): ?>
                <a class="profile-chip" href="profile.php" aria-label="Open your profile" title="View profile">
                    <span class="profile-avatar" aria-hidden="true"><?= escape(mb_strtoupper(mb_substr($currentUser['full_name'], 0, 1))) ?></span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/></svg>
                    <span class="profile-name">Profile</span>
                </a>

                <a class="button" href="<?= escape($dashboard) ?>">My dashboard</a>
            <?php else: ?>
                <a href="login.php">Sign in</a>
                <a class="button" href="register.php">Join StudyCircle</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main class="container home-page">
    <section class="hero">
        <div>
            <span class="badge">Student community · Batch 26.1 IFSL</span>
            <p class="eyebrow">NSBM Green University · Faculty of Computing</p>
            <h1>Study smarter.<br>Share what you know.</h1>
            <p>
                StudyCircle brings notes, academic questions and group study
                into one place for students who want to learn with others.
            </p>

            <div class="actions">
                <?php if ($currentUser): ?>
                    <a class="button" href="<?= escape($dashboard) ?>">Open dashboard</a>
                    <a class="button button-outline" href="materials.php">Browse materials</a>
                <?php else: ?>
                    <a class="button" href="register.php">Create an account</a>
                    <a class="button button-outline" href="login.php">Sign in</a>
                <?php endif; ?>
            </div>
        </div>

        <aside class="hero-panel">
            <img class="study-art" src="assets/campus-study.svg"
                 alt="Green university campus illustration with students studying">
            <h2>A useful place between lectures</h2>
            <ul>
                <li>Find approved notes by subject and category</li>
                <li>Ask classmates when a topic is unclear</li>
                <li>Share your own revision resources</li>
                <li>Arrange study groups and sessions</li>
            </ul>
        </aside>
    </section>

    <div class="section-heading">
        <div>
            <h2>What you can do here</h2>
            <p>Simple tools for the things students actually need during a semester.</p>
        </div>
    </div>

    <section class="grid" aria-label="StudyCircle features">
        <article class="card">
            <span class="feature-icon" aria-hidden="true">01</span>
            <h3>Find study materials</h3>
            <p>Search approved notes and revision resources by subject, category or title.</p>
        </article>

        <article class="card">
            <span class="feature-icon" aria-hidden="true">02</span>
            <h3>Discuss difficult topics</h3>
            <p>Post a question, read answers and leave useful comments on shared resources.</p>
        </article>

        <article class="card">
            <span class="feature-icon" aria-hidden="true">03</span>
            <h3>Study as a group</h3>
            <p>Create or join groups and keep track of upcoming study sessions with classmates.</p>
        </article>
    </section>

    <section class="home-highlight" aria-label="Getting started">
        <article class="card">
            <span class="badge">New here?</span>
            <h2>Start with one small step</h2>
            <p>
                Create an account, look through the available subjects and
                find a resource that matches what you are studying this week.
            </p>
            <?php if (!$currentUser): ?>
                <a class="button" href="register.php">Create student account</a>
            <?php else: ?>
                <a class="button" href="materials.php">Explore materials</a>
            <?php endif; ?>
        </article>

        <article class="card">
            <span class="badge">Built for our campus</span>
            <h2>Keep learning together</h2>
            <p>
                The project is designed around the Topic 4 requirements:
                resource sharing, peer discussion, study groups and admin review.
            </p>
            <a class="button button-outline" href="about.php">See how it works</a>
        </article>
    </section>
    <section class="sc-campus-band" aria-label="About the campus">
        <img src="assets/nsbm-campus.svg" alt="The globe sculpture and main building at NSBM Green University">
        <div>
            <h2>Learning on a green campus</h2>
            <p>NSBM Green University is set up for modern, sustainable learning. StudyCircle extends that culture online, so good notes and good answers reach every student.</p>
            <div class="sc-facts">
                <div><strong>Notes</strong><span>Shared and reviewed</span></div>
                <div><strong>Q&amp;A</strong><span>Peer discussion</span></div>
                <div><strong>Groups</strong><span>Study sessions</span></div>
            </div>
        </div>
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
