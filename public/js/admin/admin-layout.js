document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('adminSidebar');
        const mainContentWrapper = document.getElementById('mainContentWrapper');
        const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');

        // --- Sidebar Toggle ---
        if (sidebarToggleBtn && sidebar && mainContentWrapper) {
            sidebarToggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContentWrapper.classList.toggle('collapsed');
                if (sidebar.classList.contains('collapsed')) {
                    localStorage.setItem('adminSidebarCollapsed', 'true');
                } else {
                    localStorage.removeItem('adminSidebarCollapsed');
                }
            });
        }
        if (localStorage.getItem('adminSidebarCollapsed') === 'true' && sidebar && mainContentWrapper) {
            sidebar.classList.add('collapsed');
            mainContentWrapper.classList.add('collapsed');
        }
        function checkScreenWidth() {
            if (sidebar && mainContentWrapper) {
                if (window.innerWidth < 992) {
                    if (!sidebar.classList.contains('collapsed')) {
                        sidebar.classList.add('collapsed');
                        mainContentWrapper.classList.add('collapsed');
                    }
                } else {
                    if (localStorage.getItem('adminSidebarCollapsed') !== 'true') {
                         sidebar.classList.remove('collapsed');
                         mainContentWrapper.classList.remove('collapsed');
                    }
                }
            }
        }
        checkScreenWidth();
        window.addEventListener('resize', checkScreenWidth);

        const lightThemeAdminBtn = document.getElementById('lightThemeAdmin');
        const darkThemeAdminBtn = document.getElementById('darkThemeAdmin');
        const bodyElement = document.body;


        window.adminActiveCharts = {};

        // Fungsi palet warna chart berdasarkan tema
        function getChartThemeColors(theme) {
            const isAdminPrimaryColor = getComputedStyle(document.documentElement).getPropertyValue('--admin-primary-color').trim() || '#5887B2';
            const isAdminPrimaryLightColor = getComputedStyle(document.documentElement).getPropertyValue('--ss-primary-light').trim() || '#7ba7d0'; // Dari variabel Suara Siswa Anda

            if (theme === 'dark') {
                return {
                    gridColor: 'rgba(255, 255, 255, 0.15)',
                    ticksColor: '#adb5bd',
                    legendColor: '#e0e0e0',
                    datasetLineBorderColor: isAdminPrimaryLightColor,
                    datasetLineBackgroundColor: `rgba(${hexToRgb(isAdminPrimaryLightColor)}, 0.2)`,
                    datasetBarBackgroundColor: `rgba(${hexToRgb(isAdminPrimaryLightColor)}, 0.6)`,
                    datasetBarBorderColor: isAdminPrimaryLightColor,
                    pointBorderColor: '#fff',
                    pointBackgroundColor: isAdminPrimaryLightColor
                };
            } else {
                return {
                    gridColor: 'rgba(0, 0, 0, 0.1)',
                    ticksColor: '#6c757d',
                    legendColor: '#333',
                    datasetLineBorderColor: isAdminPrimaryColor,
                    datasetLineBackgroundColor: `rgba(${hexToRgb(isAdminPrimaryColor)}, 0.1)`,
                    datasetBarBackgroundColor: `rgba(${hexToRgb(isAdminPrimaryColor)}, 0.7)`,
                    datasetBarBorderColor: isAdminPrimaryColor,
                    pointBorderColor: '#fff',
                    pointBackgroundColor: isAdminPrimaryColor
                };
            }
        }
        function hexToRgb(hex) {
            let r = 0, g = 0, b = 0;
            if (hex.length == 4) { // #RGB
                r = "0x" + hex[1] + hex[1];
                g = "0x" + hex[2] + hex[2];
                b = "0x" + hex[3] + hex[3];
            } else if (hex.length == 7) {
                r = "0x" + hex[1] + hex[2];
                g = "0x" + hex[3] + hex[4];
                b = "0x" + hex[5] + hex[6];
            }
            return `${+r},${+g},${+b}`;
        }


        // Fungsi warna pada semua chart yang aktif
        function updateAllChartThemes(theme) {
            const newColors = getChartThemeColors(theme);

            for (const chartKey in window.adminActiveCharts) {
                if (Object.hasOwnProperty.call(window.adminActiveCharts, chartKey)) {
                    const chartInstance = window.adminActiveCharts[chartKey];
                    if (chartInstance && chartInstance.options && chartInstance.data) {
                        // Update scales (axes)
                        ['x', 'y', 'r'].forEach(axis => {
                            if (chartInstance.options.scales && chartInstance.options.scales[axis]) {
                                if(chartInstance.options.scales[axis].ticks) chartInstance.options.scales[axis].ticks.color = newColors.ticksColor;
                                if(chartInstance.options.scales[axis].grid) chartInstance.options.scales[axis].grid.color = newColors.gridColor;
                                if(chartInstance.options.scales[axis].grid) chartInstance.options.scales[axis].grid.borderColor = newColors.gridColor; // Untuk beberapa versi Chart.js
                            }
                        });

                        // Update legend
                        if (chartInstance.options.plugins && chartInstance.options.plugins.legend && chartInstance.options.plugins.legend.labels) {
                            chartInstance.options.plugins.legend.labels.color = newColors.legendColor;
                        }

                        // Update dataset colors
                        chartInstance.data.datasets.forEach(dataset => {
                            if (chartInstance.config.type === 'line') {
                                dataset.borderColor = newColors.datasetLineBorderColor;
                                dataset.backgroundColor = newColors.datasetLineBackgroundColor;
                                dataset.pointBackgroundColor = newColors.pointBackgroundColor;
                                dataset.pointBorderColor = newColors.pointBorderColor;
                            } else if (chartInstance.config.type === 'bar') {
                                dataset.backgroundColor = newColors.datasetBarBackgroundColor;
                                dataset.borderColor = newColors.datasetBarBorderColor;
                            }
                        });
                        chartInstance.update();
                    }
                }
            }
        }
        // Fungsi untuk menerapkan tema utama dan memperbarui chart
        function applyTheme(theme) {
            if (theme === 'dark') {
                bodyElement.classList.add('dark-theme-admin');
                if(lightThemeAdminBtn) lightThemeAdminBtn.classList.remove('active');
                if(darkThemeAdminBtn) darkThemeAdminBtn.classList.add('active');
                localStorage.setItem('adminPreferredTheme', 'dark');
            } else {
                bodyElement.classList.remove('dark-theme-admin');
                if(darkThemeAdminBtn) darkThemeAdminBtn.classList.remove('active');
                if(lightThemeAdminBtn) lightThemeAdminBtn.classList.add('active');
                localStorage.setItem('adminPreferredTheme', 'light');
            }
            updateAllChartThemes(theme);
            console.log(`Admin ${theme} theme applied`);
        }

        // Terapkan tema
        const currentTheme = localStorage.getItem('adminPreferredTheme') || 'light';
        applyTheme(currentTheme); // Ini akan otomatis mengupdate chart saat load awal

        // Event listener untuk tombol tema
        if (lightThemeAdminBtn) {
            lightThemeAdminBtn.addEventListener('click', function(e) { e.preventDefault(); applyTheme('light'); });
        }
        if (darkThemeAdminBtn) {
            darkThemeAdminBtn.addEventListener('click', function(e) { e.preventDefault(); applyTheme('dark'); });
        }
    });
