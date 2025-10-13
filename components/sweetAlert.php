<?php
if (isset($_SESSION['error_message'])): ?>
    <div>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?php echo htmlspecialchars($_SESSION['error_message']); ?>',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
        <?php unset($_SESSION['error_message']); ?>
    </div>
<?php endif;
if (isset($_SESSION['success_message'])): ?>
    <div>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?php echo htmlspecialchars($_SESSION['success_message']); ?>',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif;
?>