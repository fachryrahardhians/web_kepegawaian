document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const form = e.target;
  const data = new FormData(form);

  showLoading();

  fetch("/api/auth/user/login", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((res) => {
      hideLoading();

      if (!res.status) {
        showError(res.message);
        return;
      }

      localStorage.setItem("token", res.token);
      window.location.href = "/desbor";
    })
    .catch(() => {
      hideLoading();
      showError("Server error");
    });
});

function showError(msg) {
  showAlert(msg);
}
