import "./bootstrap";
import "flowbite";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    const confirmButtons = document.querySelectorAll(".confirm-delete-btn");

    confirmButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault(); // Mencegah link/button jalan duluan

            const form = this.closest("form");
            const title =
                this.getAttribute("data-confirm-title") || "Are you sure?";
            const text =
                this.getAttribute("data-confirm-text") ||
                "This action cannot be undone.";
            const confirmText =
                this.getAttribute("data-confirm-button") || "PROCEED";

            Swal.fire({
                title: `<span class="text-xl font-black uppercase tracking-tighter">${title}</span>`,
                html: `<p class="text-2xs font-bold text-gray-400 uppercase tracking-widest leading-relaxed">${text}</p>`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e11d48", // rose-600
                cancelButtonColor: "#111827", // gray-900
                confirmButtonText: confirmText,
                cancelButtonText: "CANCEL",
                background: document.documentElement.classList.contains("dark")
                    ? "#030712"
                    : "#ffffff",
                color: document.documentElement.classList.contains("dark")
                    ? "#ffffff"
                    : "#111827",
                borderRadius: "2rem",
                customClass: {
                    popup: "rounded-[2.5rem] border border-gray-100 dark:border-gray-900 shadow-2xl",
                    confirmButton:
                        "px-8 py-4 text-2xs font-black uppercase tracking-widest rounded-2xl transition-all active:scale-95",
                    cancelButton:
                        "px-8 py-4 text-2xs font-black uppercase tracking-widest rounded-2xl transition-all active:scale-95",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Eksekusi submit form hanya setelah dikonfirmasi
                }
            });
        });
    });
});
