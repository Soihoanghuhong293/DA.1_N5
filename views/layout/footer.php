    </div>
<footer class="border-top py-4 mt-5">
    <div class="container d-flex justify-content-between">
        <span>&copy; <?= date('Y') ?> Baby Store</span>
        <?php if (!empty($_SESSION['user']['chuc_vu_id']) && (int)$_SESSION['user']['chuc_vu_id'] === 1): ?>
            <a href="<?= BASE_URL_ADMIN ?>" class="text-decoration-none">Vào Admin</a>
        <?php endif; ?>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 