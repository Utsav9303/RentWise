// Example script.js for PWA functionality

// Log a message when the page loads
console.log("Welcome to the PWA!");

// Handle install button for the PWA
let deferredPrompt;

window.addEventListener("beforeinstallprompt", (event) => {
  // Prevent the default prompt
  event.preventDefault();
  deferredPrompt = event;
  console.log("Install prompt saved for later use.");

  // Show an install button (optional)
  const installButton = document.createElement("button");
  installButton.textContent = "Install App";
  installButton.style.position = "fixed";
  installButton.style.bottom = "20px";
  installButton.style.right = "20px";
  installButton.style.padding = "10px 20px";
  installButton.style.background = "#000";
  installButton.style.color = "#fff";
  installButton.style.border = "none";
  installButton.style.borderRadius = "5px";
  installButton.style.cursor = "pointer";

  document.body.appendChild(installButton);

  // When the button is clicked, show the install prompt
  installButton.addEventListener("click", () => {
    if (deferredPrompt) {
      deferredPrompt.prompt();
      deferredPrompt.userChoice.then((choiceResult) => {
        if (choiceResult.outcome === "accepted") {
          console.log("User accepted the install prompt.");
        } else {
          console.log("User dismissed the install prompt.");
        }
        deferredPrompt = null;
        installButton.remove();
      });
    }
  });
});

// Check if the PWA is running in standalone mode
if (window.matchMedia("(display-mode: standalone)").matches) {
  console.log("App is running in standalone mode.");
} else {
  console.log("App is running in browser mode.");
}
