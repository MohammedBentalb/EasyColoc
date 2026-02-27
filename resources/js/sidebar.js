export function initSidebar() {
    const openBtn = document.getElementById("open-sidebar");
    const closeBtn = document.getElementById("close-sidebar");
    const sidebarContent = document.getElementById("sidebar-content");
    const backdrop = document.getElementById("sidebar-backdrop");

    if (!openBtn || !sidebarContent || !backdrop) return;

    const toggleSidebar = (show) => {
        if (show) {
            backdrop.classList.remove("hidden");
            setTimeout(() => {
                backdrop.classList.remove("opacity-0");
                backdrop.classList.add("opacity-100");
                sidebarContent.classList.remove("-translate-x-full");
                sidebarContent.classList.add("translate-x-0");
            }, 10);
        } else {
            backdrop.classList.remove("opacity-100");
            backdrop.classList.add("opacity-0");
            sidebarContent.classList.remove("translate-x-0");
            sidebarContent.classList.add("-translate-x-full");

            setTimeout(() => {
                backdrop.classList.add("hidden");
            }, 300); // Wait for transition
        }
    };

    openBtn.addEventListener("click", () => toggleSidebar(true));
    closeBtn?.addEventListener("click", () => toggleSidebar(false));
    backdrop.addEventListener("click", () => toggleSidebar(false));
}

// Auto-init if we are on a page with a dashboard sidebar
document.addEventListener("DOMContentLoaded", initSidebar);
