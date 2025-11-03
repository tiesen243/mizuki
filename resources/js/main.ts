import "../css/main.css";

const toggleThemeButton = document.getElementById("toggle-theme");
const sunIcon = toggleThemeButton?.querySelector(".lucide-sun-icon");
const moonIcon = toggleThemeButton?.querySelector(".lucide-moon-icon");

toggleThemeButton?.addEventListener("click", (e) => {
  const restoreAnimation = disableAnimation(
    e.target instanceof HTMLElement
      ? (e.target.getAttribute("nonce") ?? undefined)
      : undefined,
  );

  const isDark = document.documentElement.classList.toggle("dark");
  if (sunIcon && moonIcon) {
    if (isDark) {
      sunIcon.classList.add("hidden");
      moonIcon.classList.remove("hidden");
    } else {
      sunIcon.classList.remove("hidden");
      moonIcon.classList.add("hidden");
    }
  }
  localStorage.setItem("theme", isDark ? "dark" : "light");

  restoreAnimation();
});

document.addEventListener("DOMContentLoaded", () => {
  const nonce = crypto.randomUUID();
  toggleThemeButton?.setAttribute("nonce", nonce);

  const savedTheme = localStorage.getItem("theme");
  const restoreAnimation = disableAnimation(nonce);
  if (savedTheme === "dark") document.documentElement.classList.add("dark");
  if (sunIcon && moonIcon) {
    if (savedTheme === "dark") {
      sunIcon.classList.add("hidden");
      moonIcon.classList.remove("hidden");
    } else {
      sunIcon.classList.remove("hidden");
      moonIcon.classList.add("hidden");
    }
  }
  restoreAnimation();
});

const disableAnimation = (nonce?: string) => {
  const css = document.createElement("style");
  if (nonce) css.setAttribute("nonce", nonce);
  css.appendChild(
    document.createTextNode(
      `*,*::before,*::after{-webkit-transition:none!important;-moz-transition:none!important;-o-transition:none!important;-ms-transition:none!important;transition:none!important}`,
    ),
  );
  document.head.appendChild(css);

  return () => {
    (() => window.getComputedStyle(document.body))();
    setTimeout(() => {
      document.head.removeChild(css);
    }, 1);
  };
};

const toastMessage = document.getElementById("toast-message");
if (toastMessage) {
  toastMessage.addEventListener("click", () => {
    toastMessage.classList.add("opacity-0");
    setTimeout(() => {
      toastMessage.remove();
    }, 500);
  });

  setTimeout(() => {
    toastMessage.classList.add("opacity-0", "translate-x-100");
    setTimeout(() => {
      toastMessage.remove();
    }, 500);
  }, 3000);
}
