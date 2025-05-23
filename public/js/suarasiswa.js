document.addEventListener('DOMContentLoaded', function() {
    // Referensi elemen-elemen
    const hamburgerButton = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const lightButton = document.getElementById('lightTheme');
    const darkButton = document.getElementById('darkTheme');

    // Toggle sidebar
    if (hamburgerButton) {
        hamburgerButton.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('shifted');

            // Tambahan untuk mobile view
            if (window.innerWidth < 992) {
                sidebar.classList.toggle('mobile-show');
            }
        });
    }

    // Fungsi tema
    function setTheme(theme) {
        if (theme === 'dark') {
            document.body.classList.add('dark-theme');
            if (darkButton) darkButton.classList.add('active');
            if (lightButton) lightButton.classList.remove('active');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-theme');
            if (lightButton) lightButton.classList.add('active');
            if (darkButton) darkButton.classList.remove('active');
            localStorage.setItem('theme', 'light');
        }
    }

    // Event listener untuk tombol tema
    if (lightButton) {
        lightButton.addEventListener('click', function() {
            setTheme('light');
        });
    }

    if (darkButton) {
        darkButton.addEventListener('click', function() {
            setTheme('dark');
        });
    }

    // Check tema
    const savedTheme = localStorage.getItem('theme') || 'light';
    setTheme(savedTheme);

    // Responsive sidebar 
    function handleResize() {
        if (window.innerWidth < 992) {
            sidebar.classList.add('collapsed');
            content.classList.add('shifted');
        } else {
            // Hanya kembalikan ke default jika tidak dalam keadaan tersembunyi secara manual
            if (!sidebar.classList.contains('manually-collapsed')) {
                sidebar.classList.remove('collapsed');
                content.classList.remove('shifted');
            }
        }
    }

    // Tambahkan listener untuk resize window
    window.addEventListener('resize', handleResize);

    // Panggil fungsi saat halaman dimuat
    handleResize();

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const commentCards = document.querySelectorAll('.comment-card');

            commentCards.forEach(card => {
                const userName = card.querySelector('.card-title').textContent.toLowerCase();
                const userEmail = card.querySelector('.text-muted').textContent.toLowerCase();
                const commentText = card.querySelector('.card-text').textContent.toLowerCase();

                if (userName.includes(searchTerm) ||
                    userEmail.includes(searchTerm) ||
                    commentText.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});
