window.showLoading = function () {
  document.getElementById("loadingOverlay").classList.remove("d-none");
};

window.hideLoading = function () {
  document.getElementById("loadingOverlay").classList.add("d-none");
};

window.showAlert = function (message, type = "error", title = null) {
  const modalEl = document.getElementById("globalAlertModal");
  const titleEl = document.getElementById("globalAlertTitle");
  const msgEl = document.getElementById("globalAlertMessage");

  // set title
  titleEl.innerText =
    title ??
    (type === "success"
      ? "Berhasil"
      : type === "warning"
      ? "Peringatan"
      : "Error");

  // set message
  msgEl.innerText = message;

  // reset class
  titleEl.className = "modal-title";

  // color by type
  if (type === "success") {
    titleEl.classList.add("text-success");
  } else if (type === "warning") {
    titleEl.classList.add("text-warning");
  } else {
    titleEl.classList.add("text-danger");
  }

  const modal = new bootstrap.Modal(modalEl, {
    backdrop: "static",
    keyboard: true,
  });

  modal.show();
};
