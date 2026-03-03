let logo = document.getElementById('logo')

const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

if (isDarkMode) {
  logo.src = './images/logo-dark.png';
} else {
  logo.src = './images/logo-light.png';
}

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
  if (e.matches) {
    logo.src = './images/logo-dark.png';
  } else {
    logo.src = './images/logo-light.png';
  }
});

