$(function () {
    if ($.fn.dataTable) {
        $.extend(true, $.fn.dataTable.defaults, {
            scrollX: true,
            pageLength: 25
        });
    }
});

// Sidebar collapse desktop
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');

    if (!sidebar) return;

    sidebar.classList.toggle('collapsed');

    localStorage.setItem(
        'sidebar_collapsed',
        sidebar.classList.contains('collapsed') ? '1' : '0'
    );
}

// Sidebar mobile open
function toggleMobileSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (!sidebar || !overlay) return;

    sidebar.classList.toggle('mobile-open');
    overlay.style.display = sidebar.classList.contains('mobile-open') ? 'block' : 'none';
}

// Sidebar mobile close
function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (!sidebar || !overlay) return;

    sidebar.classList.remove('mobile-open');
    overlay.style.display = 'none';
}

// Restore sidebar collapse and theme
(function () {
    const sidebar = document.getElementById('sidebar');

    if (sidebar && localStorage.getItem('sidebar_collapsed') === '1') {
        sidebar.classList.add('collapsed');
    }

    const theme = localStorage.getItem('dash_theme');

    if (theme) {
        try {
            const obj = JSON.parse(theme);

            if (obj.accent) {
                document.documentElement.style.setProperty('--accent', obj.accent.trim());
            }
        } catch (e) {
            console.warn('Theme restore failed:', e);
        }
    }
})();



/// Toggle password visibility

function togglePass(id, btn) {
    const input = document.getElementById(id);
    if (!input) return;

    const icon = btn.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        if (icon) {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    } else {
        input.type = 'password';
        if (icon) {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
}

function initPasswordStrength() {
    const password = document.getElementById('password');
    const text = document.getElementById('strength-text');
    const bars = document.querySelectorAll('.strength-bar');

    if (!password || !text || !bars.length) return;

    password.addEventListener('input', function () {
        const val = this.value;
        let score = 0;

        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const colors = ['#EF4444', '#F59E0B', '#10B981', '#4F46E5'];
        const labels = ['Weak', 'Fair', 'Good', 'Strong'];

        bars.forEach((bar, index) => {
            bar.style.background = index < score ? colors[score - 1] : '#E2E8F0';
        });

        if (val.length === 0) {
            text.textContent = '';
            text.style.color = '#94A3B8';
        } else {
            text.textContent = labels[score - 1] || 'Weak';
            text.style.color = colors[score - 1] || '#EF4444';
        }
    });
}

function initAdminMenuSearch() {
    const searchInput = document.getElementById('admin-menu-search');
    const resultsBox = document.getElementById('admin-menu-search-results');
    const sidebar = document.getElementById('sidebar');

    if (!searchInput || !resultsBox || !sidebar) return;

    const directItems = Array.from(sidebar.querySelectorAll('a.nav-link, a.sub-link'))
        .map(link => {
            const href = link.getAttribute('href') || '';
            const icon = link.querySelector('i');
            const label = link.textContent.replace(/\s+/g, ' ').trim();

            return {
                label,
                href,
                iconClass: icon ? icon.className : 'fas fa-link'
            };
        })
        .filter(item => item.label && item.href && item.href !== '#');

    const groupItems = Array.from(sidebar.querySelectorAll('button.nav-group-btn'))
        .map(button => {
            const group = button.closest('[x-data]');
            const firstLink = group ? group.querySelector('.submenu a[href]:not([href="#"])') : null;
            const icon = button.querySelector('.nav-icon');
            const label = button.textContent.replace(/\s+/g, ' ').trim();

            return {
                label,
                href: firstLink ? firstLink.getAttribute('href') : '',
                iconClass: icon ? icon.className : 'fas fa-link'
            };
        })
        .filter(item => item.label && item.href);

    const menuItems = [...directItems, ...groupItems];
    let currentMatches = [];

    function closeResults() {
        resultsBox.hidden = true;
        resultsBox.innerHTML = '';
    }

    function openMenuItem(item) {
        if (!item || !item.href) return;
        window.location.href = item.href;
    }

    function renderResults(query) {
        const normalizedQuery = query.trim().toLowerCase();

        if (!normalizedQuery) {
            closeResults();
            return;
        }

        const matches = menuItems
            .filter(item => item.label.toLowerCase().includes(normalizedQuery))
            .slice(0, 8);

        currentMatches = matches;
        resultsBox.innerHTML = '';
        resultsBox.hidden = false;

        if (!matches.length) {
            currentMatches = [];
            const empty = document.createElement('div');
            empty.className = 'admin-search-empty';
            empty.textContent = 'No menu found';
            resultsBox.appendChild(empty);
            return;
        }

        matches.forEach((item, index) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'admin-search-result';
            button.dataset.index = String(index);

            const icon = document.createElement('i');
            icon.className = item.iconClass;

            const text = document.createElement('span');
            text.textContent = item.label;

            button.append(icon, text);
            button.addEventListener('mousedown', event => {
                event.preventDefault();
                openMenuItem(item);
            });

            resultsBox.appendChild(button);
        });
    }

    searchInput.addEventListener('input', function () {
        renderResults(this.value);
    });

    searchInput.addEventListener('keydown', function (event) {
        const firstResult = resultsBox.querySelector('.admin-search-result');

        if (event.key === 'Enter' && firstResult) {
            event.preventDefault();
            openMenuItem(currentMatches[Number(firstResult.dataset.index)]);
        }

        if (event.key === 'Escape') {
            closeResults();
            searchInput.blur();
        }
    });

    searchInput.addEventListener('focus', function () {
        renderResults(this.value);
    });

    document.addEventListener('click', function (event) {
        if (!searchInput.closest('.admin-search').contains(event.target)) {
            closeResults();
        }
    });
}



document.addEventListener('DOMContentLoaded', function () {
    initPasswordStrength();
    initAdminMenuSearch();
    initAdminCheckboxes();
});
