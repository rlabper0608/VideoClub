const aDestroys = document.querySelectorAll('.link-destroy');
const form = document.getElementById('form-delete');
const destroyModal = document.getElementById('destroyModal');
const logoutLink = document.getElementById('logout-link');

logoutLink.addEventListener('click', () => {
  // document.getElementById('logout-form').submit();
  console.log("gola")
});

destroyModal.addEventListener('show.bs.modal', function (event) {
  const button = event.relatedTarget;
  const href = button.dataset.href;
  form.action = href;
});