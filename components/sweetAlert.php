<?php
if (isset($_SESSION['error_message'])): ?>
    <div>
        <?php isset($successAndRedirect); ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?php echo htmlspecialchars($_SESSION['error_message']); ?>',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = './dashboard.php';
            });
            <?php unset($_SESSION['success_message']); ?>
        </script>
        <?php unset($_SESSION['error_message']); ?>
    </div>
<?php endif;

if (isset($_SESSION['success_message'])): ?>
    <div>
        <?php isset($successAndRedirect); ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?php echo htmlspecialchars($_SESSION['success_message']); ?>',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = './dashboard.php';
            });
        </script>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif;
    ?>