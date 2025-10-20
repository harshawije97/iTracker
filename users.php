<?php include_once './services/auth.php'; ?>

<?php

$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <?php include_once './shared/links.php' ?>
    <?php include_once './shared/functions.php' ?>
</head>

<body>
    <section class="base">
        <?php include_once './components/header.php'; ?>
        <main class="main-content">
            <div class="container">
                <div class="px-16 w-full">
                    <div class="page-header">
                        <p class="breadcrumb">Users</p>
                        <h2 class="page-title">All Users Registered on iTracker</h2>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 40px;"><input type="checkbox"></th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>PORTFOLIO</th>
                                    <th>Created</th>
                                    <th style="width: 60px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>
                                        <div class="name-cell">
                                            <div class="avatar" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">CB</div>
                                            <div class="name-info">
                                                <strong>Christina Bersh</strong>
                                                <span class="email">christina@site.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="position-cell">
                                            <strong>Director</strong>
                                            <span class="department">Human resources</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-active">
                                            <span class="status-icon">✓</span>
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="portfolio-cell">
                                            <span class="portfolio-text">1/5</span>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 20%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="date-cell">28 Dec, 12:12</td>
                                    <td><a href="./userEdit.php?view=admin&action=approval&id=1" class="edit-link">Edit</a></td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>
                                        <div class="name-cell">
                                            <div class="avatar" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">DH</div>
                                            <div class="name-info">
                                                <strong>David Harrison</strong>
                                                <span class="email">david@site.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="position-cell">
                                            <strong>Seller</strong>
                                            <span class="department">Branding products</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-warning">
                                            <span class="status-icon">⚠</span>
                                            Warning
                                        </span>
                                    </td>
                                    <td>
                                        <div class="portfolio-cell">
                                            <span class="portfolio-text">3/5</span>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 60%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="date-cell">20 Dec, 09:27</td>
                                    <td><a href="#" class="edit-link">Edit</a></td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>
                                        <div class="name-cell">
                                            <div class="avatar" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">AR</div>
                                            <div class="name-info">
                                                <strong>Anne Richard</strong>
                                                <span class="email">anne@site.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="position-cell">
                                            <strong>Designer</strong>
                                            <span class="department">IT department</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-active">
                                            <span class="status-icon">✓</span>
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="portfolio-cell">
                                            <span class="portfolio-text">5/5</span>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 100%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="date-cell">18 Dec, 15:20</td>
                                    <td><a href="#" class="edit-link">Edit</a></td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>
                                        <div class="name-cell">
                                            <div class="avatar" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">SK</div>
                                            <div class="name-info">
                                                <strong>Samia Kartoon</strong>
                                                <span class="email">samia@site.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="position-cell">
                                            <strong>Executive director</strong>
                                            <span class="department">Marketing</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-active">
                                            <span class="status-icon">✓</span>
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="portfolio-cell">
                                            <span class="portfolio-text">0/5</span>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 0%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="date-cell">18 Dec, 15:20</td>
                                    <td><a href="#" class="edit-link">Edit</a></td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>
                                        <div class="name-cell">
                                            <div class="avatar" style="background: linear-gradient(135deg, #ff9a56 0%, #ff6a88 100%);">DH</div>
                                            <div class="name-info">
                                                <strong>David Harrison</strong>
                                                <span class="email">david@site.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="position-cell">
                                            <strong>Developer</strong>
                                            <span class="department">Mobile app</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-danger">
                                            <span class="status-icon">!</span>
                                            Danger
                                        </span>
                                    </td>
                                    <td>
                                        <div class="portfolio-cell">
                                            <span class="portfolio-text">3/5</span>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 60%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="date-cell">15 Dec, 14:41</td>
                                    <td><a href="#" class="edit-link">Edit</a></td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>
                                        <div class="name-cell">
                                            <div class="avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">BH</div>
                                            <div class="name-info">
                                                <strong>Brian Halligan</strong>
                                                <span class="email">brian@site.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="position-cell">
                                            <strong>Accountant</strong>
                                            <span class="department">Finance</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-active">
                                            <span class="status-icon">✓</span>
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="portfolio-cell">
                                            <span class="portfolio-text">2/5</span>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 40%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="date-cell">11 Dec, 18:51</td>
                                    <td><a href="#" class="edit-link">Edit</a></td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>
                                        <div class="name-cell">
                                            <div class="avatar" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">AC</div>
                                            <div class="name-info">
                                                <strong>Andy Clerk</strong>
                                                <span class="email">andy@site.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="position-cell">
                                            <strong>Director</strong>
                                            <span class="department">Human resources</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-active">
                                            <span class="status-icon">✓</span>
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="portfolio-cell">
                                            <span class="portfolio-text">1/5</span>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 20%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="date-cell">28 Dec, 12:12</td>
                                    <td><a href="#" class="edit-link">Edit</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>

</html>